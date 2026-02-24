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

namespace theme_pimenko;

use context_system;
use theme_pimenko\output\core\course_renderer;

/**
 * Tests for theme_pimenko output core course_renderer.
 *
 * @package   theme_pimenko
 * @copyright Sylvain Revenu - Pimenko 2025 <contact@pimenko.com> <pimenko.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @covers \theme_pimenko\output\core\course_renderer
 */
final class course_renderer_test extends \advanced_testcase {
    protected function setUp(): void {
        parent::setUp();
        $this->resetAfterTest(true);
        global $PAGE;
        $PAGE->set_context(context_system::instance());
        $PAGE->set_url('/');
    }

    /**
     * Test course_category method.
     */
    public function test_course_category(): void {
        global $PAGE;

        // Create a simple category.
        $cat = $this->getDataGenerator()->create_category(['name' => 'Test Category']);

        // Instantiate the theme renderer.
        $renderer = new course_renderer(
            $PAGE,
            null,
        );

        // Test with category ID (integer).
        $html = $renderer->course_category($cat->id);
        $this->assertIsString($html);
        $this->assertStringContainsString(
            'Test Category',
            $html,
        );

        // Test with category object (core_course_category).
        $catobj = \core_course_category::get($cat->id);
        $html = $renderer->course_category($catobj);
        $this->assertIsString($html);
        $this->assertStringContainsString(
            'Test Category',
            $html,
        );
    }
}
