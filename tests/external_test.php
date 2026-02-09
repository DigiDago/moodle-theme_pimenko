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
 * Unit tests for the external classes.
 *
 * @package    theme_pimenko
 * @copyright  Pimenko 2024
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Unit tests for theme_pimenko external classes.
 *
 * @package    theme_pimenko
 * @copyright  Pimenko 2024
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class theme_pimenko_external_testcase extends advanced_testcase {

    /**
     * Set up before each test.
     */
    public function setUp(): void {
        global $CFG;
        require_once($CFG->dirroot . '/course/externallib.php');
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
        $course1 = $this->getDataGenerator()->create_course(['fullname' => 'Course 1', 'category' => $category->id, 'summary' => 'Summary 1']);
        $course2 = $this->getDataGenerator()->create_course(['fullname' => 'Course 2', 'category' => $category->id, 'summary' => 'Summary 2']);
        $course3 = $this->getDataGenerator()->create_course(['fullname' => 'Other', 'category' => $category->id, 'summary' => 'Summary 3']);

        // Search by name.
        $result = theme_pimenko\external\search_courses::execute('search', 'Course 1');
        $result = core_external\external_api::clean_returnvalue(theme_pimenko\external\search_courses::execute_returns(), $result);

        $this->assertEquals(1, $result['total']);
        $this->assertCount(1, $result['courses']);

        // Search by category.
        $result = theme_pimenko\external\search_courses::execute('search', 'Course', 0, 0, $category->id);
        $result = core_external\external_api::clean_returnvalue(theme_pimenko\external\search_courses::execute_returns(), $result);
        $this->assertEquals(2, $result['total']);

        // Search by category name.
        $result = theme_pimenko\external\search_courses::execute('categoryname', $category->name);
        $result = core_external\external_api::clean_returnvalue(theme_pimenko\external\search_courses::execute_returns(), $result);
        $this->assertEquals(3, $result['total']);

        // Search with no results.
        $result = theme_pimenko\external\search_courses::execute('search', 'NonExistent');
        $result = core_external\external_api::clean_returnvalue(theme_pimenko\external\search_courses::execute_returns(), $result);
        $this->assertEquals(0, $result['total']);
    }

    /**
     * Test save_cover_file.
     */
    public function test_save_cover_file() {
        $this->setAdminUser();

        $course = $this->getDataGenerator()->create_course();
        $context = context_course::instance($course->id);

        // Simple transparent 1x1 pixel gif in base64.
        $imagedata = 'R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
        $filename = 'test.gif';

        $result = theme_pimenko\external\save_cover_file::execute($imagedata, $course->id, $filename, false);
        $result = core_external\external_api::clean_returnvalue(theme_pimenko\external\save_cover_file::execute_returns(), $result);

        $this->assertTrue($result['success']);

        // Check if file exists in storage.
        $fs = get_file_storage();
        $files = $fs->get_area_files($context->id, 'theme_pimenko', 'coverimage', 0, 'itemid, filepath, filename', false);
        $this->assertCount(1, $files);
        $file = reset($files);
        $this->assertEquals('cover_image_' . $course->id . '.gif', $file->get_filename());

        // Test deletion.
        $result = theme_pimenko\external\save_cover_file::execute('', $course->id, $filename, true);
        $this->assertTrue($result['success']);

        $files = $fs->get_area_files($context->id, 'theme_pimenko', 'coverimage', 0, 'itemid, filepath, filename', false);
        $this->assertCount(0, $files);
    }
}
