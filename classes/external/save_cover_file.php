<?php
// This file is part of the pimenko theme for Moodle
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
 * Theme pimenko save cover external file.
 *
 * @package    theme_pimenko
 * @copyright  Pimenko 2022
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_pimenko\external;

require_once($CFG->libdir . "/externallib.php");
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->libdir . '/filterlib.php');

use context_course;
use core_external\external_api;
use core_external\external_function_parameters;
use core_external\external_single_structure;
use core_external\external_value;
use stored_file;
use theme_config;

/**
 * external function for pimenko
 */
class save_cover_file extends external_api {
    /**
     * Executes the action to manage cover images for a course.
     *
     * @param string $imagedata The base64 encoded image data to be uploaded as a cover image.
     * @param int    $id The course ID for which the cover image is being set.
     * @param string $filename The name of the file to be stored.
     * @param bool   $filedelete A flag indicating whether to delete the existing cover image.
     * @return array An associative array containing:
     *               - 'success' (bool): Status of the operation, true if successful.
     *               - 'bannerontheright' (bool): Indicates if the banner is displayed on the right.
     *               - 'fileurl' (string): URL/path of the stored file or empty if no file exists.
     */
    public static function execute($imagedata, $id, $filename, bool $filedelete): array {
        $context = context_course::instance($id);
        self::validate_context($context);

        $theme = theme_config::load('pimenko');
        $bannerontheright = $theme->settings->displayasthumbnail ?? false;
        $success = false;

        if ($context) {
            $fs = get_file_storage();
            $ext = strtolower(
                pathinfo(
                    $filename,
                    PATHINFO_EXTENSION,
                ),
            );
            // Rename to cover_image_courseid.
            $filename = 'cover_image_' . $id . '.' . $ext;

            // Check size.
            $binary = base64_decode($imagedata);

            $fileinfo = [
                'contextid' => $context->id,
                'component' => 'theme_pimenko',
                'filearea' => 'coverimage',
                'itemid' => 0,
                'filepath' => '/',
                'filename' => $filename,
            ];

            // 1st we delete existing bg.
            $fs->delete_area_files(
                $context->id,
                $fileinfo['component'],
                $fileinfo['filearea'],
            );

            if ($filedelete) {
                return [
                    'success' => true,
                    'bannerontheright' => $bannerontheright,
                    'fileurl' => '',
                ];
            }

            // Create new one.
            $storedfile = $fs->create_file_from_string(
                $fileinfo,
                $binary,
            );
            if ($storedfile instanceof stored_file) {
                $success = true;
            }
        }

        return [
            'success' => $success,
            'bannerontheright' => $bannerontheright,
            'fileurl' => (isset($storedfile)) ? $storedfile->get_filepath() : '',
        ];
    }

    /**
     * Defines the parameters accepted by the execute function.
     *
     * @return external_function_parameters The parameter structure includes:
     *         - imagedata: Text containing the image data (optional).
     *         - courseid: Integer representing the course ID.
     *         - filename: Text specifying the image filename.
     *         - filedelete: Boolean indicating whether the file should be deleted.
     */
    public static function execute_parameters(): external_function_parameters {
        $parameters = [
            'imagedata' => new external_value(
                PARAM_TEXT,
                'Image data',
                null,
            ),
            'courseid' => new external_value(
                PARAM_INT,
                'Image data',
                VALUE_REQUIRED,
            ),
            'filename' => new external_value(
                PARAM_TEXT,
                'Image filename',
                VALUE_REQUIRED,
            ),
            'filedelete' => new external_value(
                PARAM_BOOL,
                'Bool delete TRUE or FALSE',
                VALUE_REQUIRED,
            ),
        ];
        return new external_function_parameters($parameters);
    }

    /**
     * Defines the structure of the data returned by the execute function.
     *
     * @return external_single_structure The structure includes:
     *         - success: Boolean indicating whether the operation was successful.
     *         - bannerontheright: Boolean specifying if the banner is on the right.
     *         - fileurl: Text containing the banner URL.
     */
    public static function execute_returns(): external_single_structure {
        $keys = [
            'success' => new external_value(
                PARAM_BOOL,
                'Was the cover image successfully changed',
                VALUE_REQUIRED,
            ),
            'bannerontheright' => new external_value(
                PARAM_BOOL,
                'banner on the right true or false',
                VALUE_REQUIRED,
            ),
            'fileurl' => new external_value(
                PARAM_TEXT,
                'banner url',
                VALUE_REQUIRED,
            ),
        ];

        return new external_single_structure(
            $keys,
            'coverimage',
        );
    }
}
