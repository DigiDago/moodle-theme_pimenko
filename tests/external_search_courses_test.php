<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Unit tests for the search_courses external class.
 *
 * @package    theme_pimenko
 * @copyright  Pimenko 2024
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Unit tests for theme_pimenko search_courses external class.
 *
 * @package    theme_pimenko
 * @copyright  Pimenko 2024
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class theme_pimenko_external_search_courses_testcase extends advanced_testcase {

    /**
     * Set up before each test.
     */
    public function setUp(): void {
        parent::setUp();
        $this->resetAfterTest();
    }

    /**
     * Test search_courses.
     */
    public function test_search_courses() {
        global $USER;

        $this->setAdminUser();
        $USER->sesskey = sesskey();
        $_POST['sesskey'] = $USER->sesskey; // Needed for confirm_sesskey()

        $category = $this->getDataGenerator()->create_category();
        $course1 = $this->getDataGenerator()->create_course([
            'fullname' => 'Course 1',
            'category' => $category->id,
            'summary' => '<p>Summary 1</p>',
            'summaryformat' => FORMAT_HTML,
        ]);
        $course2 = $this->getDataGenerator()->create_course([
            'fullname' => 'Course 2',
            'category' => $category->id,
            'summary' => '<a href="https://example.com">Go</a>',
            'summaryformat' => FORMAT_HTML,
        ]);
        $course3 = $this->getDataGenerator()->create_course([
            'fullname' => 'Other',
            'category' => $category->id,
            'summary' => 'Summary 3',
        ]);

        // Search by name.
        $result = theme_pimenko\external\search_courses::execute('search', 'Course 1');
        $result = core_external\external_api::clean_returnvalue(theme_pimenko\external\search_courses::execute_returns(), $result);

        $this->assertEquals(1, $result['total']);
        $this->assertCount(1, $result['courses']);

        // Ensure formatted summary is returned (requires filterlib/util::format_text path).
        $course = reset($result['courses']);
        $this->assertArrayHasKey('summary', $course);
        $this->assertArrayHasKey('summaryformat', $course);
        $this->assertEquals(FORMAT_HTML, $course['summaryformat']);
        $this->assertStringContainsString('<p>Summary 1</p>', $course['summary']);

        // Search by category.
        $result = theme_pimenko\external\search_courses::execute('search', 'Course', 0, 0, $category->id);
        $result = core_external\external_api::clean_returnvalue(theme_pimenko\external\search_courses::execute_returns(), $result);
        $this->assertEquals(2, $result['total']);

        // Search by category name.
        $result = theme_pimenko\external\search_courses::execute('categoryname', $category->name);
        $result = core_external\external_api::clean_returnvalue(theme_pimenko\external\search_courses::execute_returns(), $result);
        $this->assertEquals(3, $result['total']);

        // Determine expected order of the first two courses for this search within the category.
        $firstpage = theme_pimenko\external\search_courses::execute('search', 'Course', 0, 2, $category->id);
        $firstpage = core_external\external_api::clean_returnvalue(theme_pimenko\external\search_courses::execute_returns(), $firstpage);
        $this->assertCount(2, $firstpage['courses']);
        $expectedsecondid = $firstpage['courses'][1]['id'];

        // Pagination: perpage=1, page=1 should return the second matching course within the category (based on API ordering).
        $result = theme_pimenko\external\search_courses::execute('search', 'Course', 1, 1, $category->id);
        $result = core_external\external_api::clean_returnvalue(theme_pimenko\external\search_courses::execute_returns(), $result);
        $this->assertCount(1, $result['courses']);
        $this->assertEquals($expectedsecondid, $result['courses'][0]['id']);

        // Ensure HTML in summary is preserved/formatted (exercises format_text path).
        $this->assertEquals(FORMAT_HTML, $result['courses'][0]['summaryformat']);

        // Search with no results.
        $result = theme_pimenko\external\search_courses::execute('search', 'NonExistent');
        $result = core_external\external_api::clean_returnvalue(theme_pimenko\external\search_courses::execute_returns(), $result);
        $this->assertEquals(0, $result['total']);
    }

    /**
     * Test search_courses with subcategories.
     */
    public function test_search_courses_with_subcategories() {
        global $USER;

        $this->setAdminUser();
        $USER->sesskey = sesskey();
        $_POST['sesskey'] = $USER->sesskey;

        $parentcat = $this->getDataGenerator()->create_category(['name' => 'Parent']);
        $childcat = $this->getDataGenerator()->create_category(['parent' => $parentcat->id, 'name' => 'Child']);

        $courseparent = $this->getDataGenerator()->create_course([
            'fullname' => 'Parent Course',
            'category' => $parentcat->id,
        ]);
        $coursechild = $this->getDataGenerator()->create_course([
            'fullname' => 'Child Course',
            'category' => $childcat->id,
        ]);

        // Search in parent category. Should find both courses.
        $result = theme_pimenko\external\search_courses::execute('search', 'Course', 0, 0, $parentcat->id);
        $result = core_external\external_api::clean_returnvalue(theme_pimenko\external\search_courses::execute_returns(), $result);

        $this->assertEquals(2, $result['total'], 'Should find courses in both parent and child categories');
        $courseids = array_column($result['courses'], 'id');
        $this->assertContains((int)$courseparent->id, $courseids);
        $this->assertContains((int)$coursechild->id, $courseids);

        // Search in child category. Should find only child course.
        $result = theme_pimenko\external\search_courses::execute('search', 'Course', 0, 0, $childcat->id);
        $result = core_external\external_api::clean_returnvalue(theme_pimenko\external\search_courses::execute_returns(), $result);

        $this->assertEquals(1, $result['total']);
        $this->assertEquals($coursechild->id, $result['courses'][0]['id']);
    }

    /**
     * Test search_courses with subcategories and empty search string.
     * Ensures category filtering (including children) applies even when no keyword is provided.
     */
    public function test_search_courses_with_subcategories_empty_search() {
        global $USER;

        $this->setAdminUser();
        $USER->sesskey = sesskey();
        $_POST['sesskey'] = $USER->sesskey;

        $parentcat = $this->getDataGenerator()->create_category(['name' => 'Parent2']);
        $childcat = $this->getDataGenerator()->create_category(['parent' => $parentcat->id, 'name' => 'Child2']);

        $courseparent = $this->getDataGenerator()->create_course([
            'fullname' => 'Parent2 Course A',
            'category' => $parentcat->id,
        ]);
        $coursechild = $this->getDataGenerator()->create_course([
            'fullname' => 'Child2 Course B',
            'category' => $childcat->id,
        ]);

        // Empty search should still return both courses when filtering by parent category.
        $result = theme_pimenko\external\search_courses::execute('search', '', 0, 0, $parentcat->id);
        $result = core_external\external_api::clean_returnvalue(theme_pimenko\external\search_courses::execute_returns(), $result);

        $this->assertEquals(2, $result['total']);
        $courseids = array_column($result['courses'], 'id');
        $this->assertContains((int)$courseparent->id, $courseids);
        $this->assertContains((int)$coursechild->id, $courseids);
    }
}
