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
 * Unit tests for the form classes.
 *
 * @package    theme_pimenko
 * @copyright  Pimenko 2024
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use theme_pimenko\form\date_form;

/**
 * Unit tests for theme_pimenko form classes.
 *
 * @package    theme_pimenko
 * @copyright  Pimenko 2024
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class theme_pimenko_form_testcase extends advanced_testcase {

    /**
     * Test date_form definition.
     */
    public function test_date_form_definition() {
        $this->resetAfterTest();
        
        $url = new moodle_url('/');
        $customdata = [
            'name' => 'Test Date',
            'urlselectedvalue' => time()
        ];
        
        // We can't easily test the output of the form in a unit test without a lot of mocking,
        // but we can at least check if the class can be instantiated.
        $form = new date_form($url, (object)$customdata);
        $this->assertInstanceOf(date_form::class, $form);
    }
}
