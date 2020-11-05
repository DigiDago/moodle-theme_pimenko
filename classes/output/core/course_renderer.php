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
 * Course renderer.
 * @package    theme_telaformation
 * @copyright  Pimenko 2019
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_telaformation\output\core;

use stdClass;
use html_writer;
use completion_info;
use cm_info;
use image_url;
use pix_url;
use heading;

defined('MOODLE_INTERNAL') || die();

require_once( $CFG->dirroot . '/course/renderer.php' );

/**
 * Course renderer class.
 * @package    theme_telaformation
 * @copyright  Pimenko 2019
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_renderer extends \core_course_renderer {

    /**
     * Renders html for completion box on course page
     * If completion is disabled, returns empty string
     * If completion is automatic, returns an icon of the current completion state
     * If completion is manual, returns a form (with an icon inside) that allows user to
     * toggle completion
     *
     * @param stdClass        $course         course object
     * @param completion_info $completioninfo completion info for the course, it is recommended
     *                                        to fetch once for all modules in course/section for performance
     * @param cm_info         $mod            module to show completion for
     * @param array           $displayoptions display options, not used in core
     *
     * @return string
     * @throws \coding_exception
     */
    public function course_section_cm_completion($course, &$completioninfo, cm_info $mod, $displayoptions = []) {
        global $OUTPUT;
        $output = '';
        if (!empty($displayoptions['hidecompletion']) || !isloggedin() || isguestuser() || !$mod->uservisible) {
            return $output;
        }
        if ($completioninfo === null) {
            $completioninfo = new completion_info($course);
        }
        $completion = $completioninfo->is_enabled($mod);
        if ($completion == COMPLETION_TRACKING_NONE) {
            if ($this->page->user_is_editing()) {
                $output .= html_writer::span(
                        '&nbsp;',
                        'filler'
                );
            }
            return $output;
        }

        $completiondata   = $completioninfo->get_data(
                $mod,
                true
        );
        $completionicon   = '';
        $completioniconop = '';

        if ($this->page->user_is_editing()) {
            switch ($completion) {
                case COMPLETION_TRACKING_MANUAL :
                    $completionicon = 'manual-enabled';
                    break;
                case COMPLETION_TRACKING_AUTOMATIC :
                    $completionicon = 'auto-enabled';
                    break;
            }
        } else if ($completion == COMPLETION_TRACKING_MANUAL) {
            switch ($completiondata->completionstate) {
                case COMPLETION_INCOMPLETE:
                    $completionicon   = 'manual-n';
                    $completioniconop = 'manual-y';
                    break;
                case COMPLETION_COMPLETE:
                    $completionicon   = 'manual-y';
                    $completioniconop = 'manual-n';
                    break;
            }
        } else { // Automatic
            switch ($completiondata->completionstate) {
                case COMPLETION_INCOMPLETE:
                    $completionicon = 'auto-n';
                    break;
                case COMPLETION_COMPLETE:
                    $completionicon = 'auto-y';
                    break;
                case COMPLETION_COMPLETE_PASS:
                    $completionicon = 'auto-pass';
                    break;
                case COMPLETION_COMPLETE_FAIL:
                    $completionicon = 'auto-fail';
                    break;
            }
        }

        $modtemplate = new stdClass();

        if ($completionicon) {
            $modtemplate->completionicon = $completionicon;
            $modtemplate->modid          = $mod->id;
            $modtemplate->modname        = format_string($mod->name);
            $modtemplate->status         = null;
            if($this->page->pagelayout == 'incourse') {
                $modtemplate->displayicon = true;
            }

            $formattedname = $mod->get_formatted_name();

            if (!empty($displayoptions['showcompletiontext'])) {
                $modtemplate->completetext = format_string(
                        get_string(
                                'completion-alt-' . $completionicon,
                                'theme_telaformation',
                                $formattedname
                        )
                );
                $modtemplate->tooltiptext  = format_string(
                        get_string(
                                'completion-tooltip-' . $completionicon,
                                'theme_telaformation'
                        )
                );
                if (!empty($completioniconop)) {
                    $modtemplate->changetext = get_string(
                            'completion-alt-' . $completioniconop,
                            'completion',
                            $formattedname
                    );
                }
            }

            if ($this->page->user_is_editing()) {
                $modtemplate->useredit = 1;
                $modtemplate->state    = 1;
                if ($completiondata->completionstate == COMPLETION_COMPLETE) {
                    $modtemplate->status = 'checked';
                    $modtemplate->state  = 0;
                }
                $modtemplate->class = 'completioncheck';
                $output             .= $OUTPUT->render_from_template(
                        'theme_telaformation/completioncheck',
                        $modtemplate
                );
            } else if ($completion == COMPLETION_TRACKING_MANUAL) {

                $modtemplate->state = 1;
                if ($completiondata->completionstate == COMPLETION_COMPLETE) {
                    $modtemplate->status = 'checked';
                    $modtemplate->state  = 0;
                }
                $modtemplate->class = 'completioncheck';
                $output             .= $OUTPUT->render_from_template(
                        'theme_telaformation/completioncheck',
                        $modtemplate
                );

            } else {
                // In auto mode, the icon is just an image.
                if ($completionicon == 'auto-y' || $completionicon == 'auto-pass') {

                    $modtemplate->status = 'checked disabled';
                    $modtemplate->class  = 'autocompletioncheck';

                    $output .= $OUTPUT->render_from_template(
                            'theme_telaformation/completioncheck',
                            $modtemplate
                    );

                } else {
                    $modtemplate->status = 'disabled';
                    $modtemplate->class  = 'autocompletioncheck';
                    $output              .= $OUTPUT->render_from_template(
                            'theme_telaformation/completioncheck',
                            $modtemplate
                    );
                }
            }
        }
        return $output;
    }
}
