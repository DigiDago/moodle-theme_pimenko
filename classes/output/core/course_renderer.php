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
 *
 * @package    theme_telaformation
 * @copyright  Pimenko 2019
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_telaformation\output\core;

use core_completion\progress;
use stdClass;
use html_writer;
use completion_info;
use cm_info;
use coursecat_helper;
use moodle_url;
use lang_string;
use context_system;
use core_course_list_element;
use core_course_category;
use theme_config;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/course/renderer.php');

/**
 * Course renderer class.
 *
 * @package    theme_telaformation
 * @copyright  Pimenko 2019
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_renderer extends \core_course_renderer {
    private $collapsecontainerid;

    /**
     * Renders html for completion box on course page
     * If completion is disabled, returns empty string
     * If completion is automatic, returns an icon of the current completion state
     * If completion is manual, returns a form (with an icon inside) that allows user to
     * toggle completion
     *
     * @param stdClass $course course object
     * @param completion_info $completioninfo completion info for the course, it is recommended
     *                                        to fetch once for all modules in course/section for performance
     * @param cm_info $mod module to show completion for
     * @param array $displayoptions display options, not used in core
     *
     * @return string
     */
    public function course_section_cm_completion($course, &$completioninfo, cm_info $mod, $displayoptions = []) {
        $content = '';
        if (!empty($displayoptions['hidecompletion']) || !isloggedin() || isguestuser() || !$mod->uservisible) {
            return $content;
        }
        if ($completioninfo === null) {
            $completioninfo = new completion_info($course);
        }
        $completion = $completioninfo->is_enabled($mod);
        if ($completion == COMPLETION_TRACKING_NONE) {
            if ($this->page->user_is_editing()) {
                $content .= html_writer::span(
                        '&nbsp;',
                        'filler'
                );
            }
            return $content;
        }

        $completiondata = $completioninfo->get_data(
                $mod,
                true
        );
        $completionicon = '';
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
                    $completionicon = 'manual-n';
                    $completioniconop = 'manual-y';
                    break;
                case COMPLETION_COMPLETE:
                    $completionicon = 'manual-y';
                    $completioniconop = 'manual-n';
                    break;
            }
        } else {
            // Automatic.
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
            $modtemplate->modid = $mod->id;
            $modtemplate->modname = format_string($mod->name);
            $modtemplate->status = null;
            if ($this->page->pagelayout == 'incourse') {
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
                $modtemplate->tooltiptext = format_string(
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
                $modtemplate->state = 1;
                if ($completiondata->completionstate == COMPLETION_COMPLETE) {
                    $modtemplate->status = 'checked';
                    $modtemplate->state = 0;
                }
                $modtemplate->class = 'completioncheck';
                $content .= $this->output->render_from_template(
                        'theme_telaformation/completioncheck',
                        $modtemplate
                );
            } else if ($completion == COMPLETION_TRACKING_MANUAL) {

                $modtemplate->state = 1;
                if ($completiondata->completionstate == COMPLETION_COMPLETE) {
                    $modtemplate->status = 'checked';
                    $modtemplate->state = 0;
                }
                $modtemplate->class = 'completioncheck';
                $content .= $this->output->render_from_template(
                        'theme_telaformation/completioncheck',
                        $modtemplate
                );

            } else {
                // In auto mode, the icon is just an image.
                if ($completionicon == 'auto-y' || $completionicon == 'auto-pass') {

                    $modtemplate->status = 'checked disabled';
                    $modtemplate->class = 'autocompletioncheck';

                    $content .= $this->output->render_from_template(
                            'theme_telaformation/completioncheck',
                            $modtemplate
                    );

                } else {
                    $modtemplate->status = 'disabled';
                    $modtemplate->class = 'autocompletioncheck';
                    $content .= $this->output->render_from_template(
                            'theme_telaformation/completioncheck',
                            $modtemplate
                    );
                }
            }
        }
        return $content;
    }

    /**
     * Returns HTML to print list of available courses for the frontpage
     *
     * @return string
     */
    public function frontpage_available_courses() {
        global $CFG;

        $chelper = new coursecat_helper();
        $chelper->set_show_courses(self::COURSECAT_SHOW_COURSES_EXPANDED)->set_courses_display_options(
                [
                        'recursive' => true,
                        'limit' => $CFG->frontpagecourselimit,
                        'viewmoreurl' => new moodle_url('/course/index.php'),
                        'viewmoretext' => new lang_string('fulllistofcourses')
                ]
        );
        $chelper->set_attributes(['class' => 'frontpage-course-list-all']);
        $courses = get_courses();

        if (!$courses && !$this->page->user_is_editing() && has_capability(
                        'moodle/course:create',
                        context_system::instance()
                )) {
            // Print link to create a new course, for the 1st available category.
            return $this->add_new_course_button();
        }

        return $this->frontpage_courseboxes(
                $chelper,
                $courses
        );
    }

    /**
     * Review frontpage coursebox renderer.
     *
     * @param coursecat_helper $chelper
     * @param                  $courses
     *
     * @return string
     */
    public function frontpage_courseboxes(coursecat_helper $chelper, $courses) {
        $content = '';
        $template = $this->get_courses_template(
                $chelper,
                $courses
        );

        $content .= $this->output->render_from_template(
                'theme_telaformation/course_card',
                $template
        );

        return $content;
    }

    public function get_courses_template($chelper, $courses) {
        global $CFG, $DB;

        if (empty($this->categories)) {
            $this->categories = $DB->get_records(
                    'course_categories',
                    ['visible' => 1]
            );
        }

        $template = new stdClass();
        $template->coursecount = 0;
        $template->courses = [];

        $rendercourses = [];
        $mycourses = enrol_get_my_courses();

        $template->tag_list = [];
        $output = null;

        // Show or hide some field for frontpage course card.
        $theme = theme_config::load('telaformation');

        $template->showcustomfields = false;
        if ($theme->settings->showcustomfields) {
            $template->showcustomfields = $theme->settings->showcustomfields;
        }

        $template->showcontacts = false;
        if ($theme->settings->showcontacts) {
            $template->showcontacts = $theme->settings->showcontacts;
        }

        $template->showstartdate = false;
        if ($theme->settings->showstartdate) {
            $template->showstartdate = $theme->settings->showstartdate;
        }

        foreach ($courses as $course) {
            if ($course->id == 1) {
                continue;
            }
            if ($course instanceof stdClass) {
                $course = new core_course_list_element($course);
            }
            if (array_key_exists($course->id, $mycourses) or $this->page->pagetype == "site-index") {
                $rendercourse = new stdClass();
                // Get course name.
                $rendercourse->coursename = $chelper->get_course_formatted_name($course);

                // Display course contacts. See core_course_list_element::get_course_contacts().
                if ($course->has_course_contacts()) {
                    $rendercourse->contacts = [];
                    foreach ($course->get_course_contacts() as $userid => $coursecontact) {
                        $contact = new stdClass();
                        $contact->role = $coursecontact['rolename'];
                        $contact->name = $coursecontact['username'];
                        $contact->url = new moodle_url(
                                '/user/view.php',
                                [
                                        'id' => $userid,
                                        'course' => SITEID
                                ]
                        );
                        $rendercourse->contacts[] = $contact;
                    }
                }

                // Get course description.
                if ($course->has_summary()) {
                    $rendercourse->coursedescription = strip_tags($chelper->get_course_formatted_summary($course));
                }
                // Get course dates.
                if ($course->startdate) {
                    $rendercourse->startdate = userdate(
                            $course->startdate,
                            get_string('strftimedate')
                    );
                }
                // Get course category name.
                if ($catid = $course->category) {
                    if (array_key_exists(
                            $catid,
                            $this->categories
                    )) {
                        $category = \core_course_category::get($course->category);
                        $rendercourse->category = $category->get_formatted_name();
                    } else {
                        $rendercourse->category = null;
                    }
                }

                // Get course link.
                $params = ["id" => $course->id];
                $rendercourse->viewurl = new moodle_url(
                        "/course/view.php",
                        $params
                );

                // Search custom fields.
                $customfields = $course->get_custom_fields();
                $rendercourse->customfields = [];
                // Adding of custom fields in the template.
                foreach ($customfields as $customfield) {
                    $cf = new stdClass();
                    $cf->customfield = $customfield->get_value();

                    if ($cf->customfield != '') {
                        $rendercourse->customfields[] = $cf;
                    }
                }

                // Course visible.
                $rendercourse->visible = $course->visible;

                // Get course image.
                foreach ($course->get_course_overviewfiles() as $file) {
                    if ($file->is_valid_image()) {
                        $rendercourse->courseimage =
                                $CFG->wwwroot . '/pluginfile.php/' . $file->get_contextid() . '/' . $file->get_component() . '/' .
                                $file->get_filearea() . $file->get_filepath() . $file->get_filename();
                    }
                }
                if (!isset($rendercourse->courseimage)) {
                    $rendercourse->courseimage = $this->output->get_generated_image_for_id($course->id);
                }

                // Get the course progress.
                $rendercourse->hasprogress = false;
                if (array_key_exists(
                        $course->id,
                        $mycourses
                )) {
                    $completion = new completion_info($course);
                    $rendercourse->hasprogress = true;
                    $rendercourse->progress = $this->course_progress($course->id);
                }

                $rendercourses[] = $rendercourse;
                $template->coursecount++;
            }
        }

        $template->courses = $rendercourses;
        return $template;
    }

    /**
     * Return course progress.
     *
     * @param int $courseid
     *
     * @return float
     */
    public function course_progress(int $courseid): float {
        $course = get_course($courseid);
        $percentage = progress::get_course_progress_percentage($course);
        if (!is_null($percentage)) {
            $percentage = floor($percentage);
        } else {
            $percentage = 0;
        }
        return $percentage;
    }

    /**
     * Returns HTML to display a tree of subcategories and courses in the given category
     *
     * @param coursecat_helper $chelper various display options
     * @param core_course_category $coursecat top category (this category's name and description will NOT be added to the tree)
     * @return string
     */
    protected function coursecat_tree(coursecat_helper $chelper, $coursecat) {
        // Reset the category expanded flag for this course category tree first.
        $this->categoryexpandedonload = true;
        $template = new stdClass();
        $template->categorycontent = $this->coursecat_category_content($chelper, $coursecat, 0);
        if (empty($template->categorycontent)) {
            return '';
        }

        // Start content generation.
        $content = '';
        $template->attributes = $chelper->get_and_erase_attributes('course_category_tree clearfix');
        $template->contentattributes = '';
        foreach ($template->attributes as $key => $attribute) {
            $template->contentattributes .= $key . "=" . $attribute;
        }

        if ($coursecat->get_children_count()) {
            $template->linkclass = 'collapseexpand aabtn';

            // Check if the category content contains subcategories with children's content loaded.
            if ($this->categoryexpandedonload) {
                $template->linkclass .= ' collapse-all';
                $template->linkname = get_string('collapseall');
            } else {
                $template->linkname = get_string('expandall');
            }
            // Only show the collapse/expand if there are children to expand.
            $this->page->requires->strings_for_js(array('collapseall', 'expandall'), 'moodle');
        }

        $content .= $this->output->render_from_template(
                'theme_telaformation/course_category_tree',
                $template
        );

        return $content;
    }

    /**
     * Returns HTML to display course name.
     *
     * @param coursecat_helper $chelper
     * @param core_course_list_element $course
     * @return string
     */
    protected function course_name(coursecat_helper $chelper, core_course_list_element $course): string {
        $content = '';
        $template = new stdClass();
        if ($chelper->get_show_courses() >= self::COURSECAT_SHOW_COURSES_EXPANDED) {
            $template->nametag = 'h3';
        } else {
            $template->nametag = 'div';
        }
        $coursename = $chelper->get_course_formatted_name($course);
        $template->coursenamelink = html_writer::link(new moodle_url('/course/view.php', ['id' => $course->id]),
                $coursename, [
                        'class' => $course->visible ? 'aalink' : 'aalink dimmed',
                        'data-moreinfoid' => 'moreinfo' . $course->id,
                        'data-summary' => $course->has_summary()
                ]);
        // If we display course in collapsed form but the course has summary or course contacts, display the link to the info page.
        if ($chelper->get_show_courses() < self::COURSECAT_SHOW_COURSES_EXPANDED) {
            if ($course->has_summary() || $course->has_course_contacts() || $course->has_course_overviewfiles()
                    || $course->has_custom_fields()) {
                $template->url = new moodle_url('/course/info.php', ['id' => $course->id]);
                $template->title = $this->strings->summary;
                $template->moreinfoid = 'moreinfo' . $course->id;
                $template->image = $this->output->pix_icon('i/info', $this->strings->summary);
                // Make sure JS file to expand course content is included.
                $this->coursecat_include_js();
            }
        }
        $content .= $this->output->render_from_template(
                'theme_telaformation/course_name',
                $template
        );

        return $content;
    }

    /**
     * Returns HTML to display course content (summary, course contacts and optionally category name)
     *
     * This method is called from coursecat_coursebox() and may be re-used in AJAX
     *
     * @param coursecat_helper $chelper various display options
     * @param stdClass|core_course_list_element $course
     * @return string
     */
    protected function coursecat_coursebox_content(coursecat_helper $chelper, $course) {
        if ($chelper->get_show_courses() < self::COURSECAT_SHOW_COURSES_EXPANDED) {
            return '';
        }
        if ($course instanceof stdClass) {
            $course = new core_course_list_element($course);
        }
        $content = $this->course_summary($chelper, $course);
        $content .= $this->course_overview_files($course);
        $content .= $this->course_contacts($course);
        $content .= $this->course_category_name($chelper, $course);
        $content .= $this->course_custom_fields($course);
        $content .= html_writer::link(new moodle_url('/course/view.php', ['id' => $course->id]),
                'Enter', ['class' => 'entercourse btn btn-secondary']);
        return $content;
    }
}