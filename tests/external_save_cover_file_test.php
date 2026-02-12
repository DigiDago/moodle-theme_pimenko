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
 * Unit tests for the save_cover_file external class.
 *
 * @package    theme_pimenko
 * @copyright  Pimenko 2024
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Unit tests for theme_pimenko save_cover_file external class.
 *
 * @package    theme_pimenko
 * @copyright  Pimenko 2024
 * @runTestsInSeparateProcesses
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class theme_pimenko_external_save_cover_file_testcase extends advanced_testcase {

    /**
     * Set up before each test.
     */
    public function setUp(): void {
        parent::setUp();
        $this->resetAfterTest();
    }

    /**
     * Test save_cover_file.
     */
    public function test_save_cover_file() {
        $this->setAdminUser();

        $course = $this->getDataGenerator()->create_course();
        $context = context_course::instance($course->id);

        // Active un réglage de thème qui est lu par l'API (couvre theme_config::load).
        set_config('displayasthumbnail', 1, 'theme_pimenko');

        // Simple transparent 1x1 pixel gif en base64.
        $imagedata = 'R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
        $filename = 'test.gif';

        // Upload du fichier de couverture.
        $result = theme_pimenko\external\save_cover_file::execute($imagedata, $course->id, $filename, false);
        $result = core_external\external_api::clean_returnvalue(theme_pimenko\external\save_cover_file::execute_returns(), $result);

        // Chemin via externallib/structures + filterlib incluses par la classe.
        $this->assertTrue($result['success']);
        $this->assertTrue($result['bannerontheright']);
        $this->assertSame('/', $result['fileurl']);

        // Vérifie la présence du fichier en stockage (API files/lib).
        $fs = get_file_storage();
        $files = $fs->get_area_files($context->id, 'theme_pimenko', 'coverimage', 0, 'itemid, filepath, filename', false);
        $this->assertCount(1, $files);
        $file = reset($files);
        $this->assertEquals('cover_image_' . $course->id . '.gif', $file->get_filename());
        $this->assertEquals('image/gif', $file->get_mimetype());
        $this->assertGreaterThan(0, $file->get_filesize());

        // Suppression (couvre la branche $filedelete et le nettoyage de l'area files).
        $deleteresult = theme_pimenko\external\save_cover_file::execute('', $course->id, $filename, true);
        $deleteresult = core_external\external_api::clean_returnvalue(theme_pimenko\external\save_cover_file::execute_returns(), $deleteresult);
        $this->assertTrue($deleteresult['success']);
        $this->assertTrue($deleteresult['bannerontheright']);
        $this->assertSame('', $deleteresult['fileurl']);

        $files = $fs->get_area_files($context->id, 'theme_pimenko', 'coverimage', 0, 'itemid, filepath, filename', false);
        $this->assertCount(0, $files);
    }
}
