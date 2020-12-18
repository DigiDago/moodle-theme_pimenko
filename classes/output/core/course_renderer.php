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

use stdClass;
use html_writer;
use completion_info;
use cm_info;
use coursecat_helper;
use moodle_url;

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
     * @throws \coding_exception
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
     * Returns HTML to display a tree of subcategories and courses in the given category.
     *
     * @param coursecat_helper $chelper various display options
     * @param coursecat $coursecat top category (this category's name and description will NOT be added to the
     *                                    tree)
     *
     * @return string
     */
    protected function coursecat_tree(coursecat_helper $chelper, $coursecat) {
        global $CFG;
        $template = new stdClass();

        // We need root path.
        $template->rootpath = $CFG->wwwroot;

        $categorycontent = $this->coursecat_category_content(
                $chelper,
                $coursecat,
                0
        );
        if (empty($categorycontent)) {
            return '';
        }

        $template->categorycontent = $categorycontent;

        if ($coursecat->get_children_count()) {
            $template->expandall = get_string('expandall');
            $template->collapseall = get_string('collapseall');
        }

        return $this->output->render_from_template(
                'theme_telaformation/course_category_tree',
                $template
        );
    }

    /**
     * Renders the list of subcategories in a category.
     *
     * @param coursecat_helper $chelper various display options
     * @param coursecat $coursecat
     * @param int $depth depth of the category in the current tree
     *
     * @return string
     * @throws \coding_exception
     * @throws \moodle_exception
     */
    protected function coursecat_subcategories(coursecat_helper $chelper, $coursecat, $depth) {
        global $CFG;

        $this->collapsecontainerid++;

        $subcategories = [];
        if (!$chelper->get_categories_display_option('nodisplay')) {
            $subcategories = $coursecat->get_children($chelper->get_categories_display_options());
        }
        $totalcount = $coursecat->get_children_count();
        if (!$totalcount) {
            // Note that we call core_course_category::get_children_count()
            // AFTER core_course_category::get_children() to avoid extra DB requests.
            // Categories count is cached during children categories retrieval.
            return '';
        }

        // Prepare content of paging bar or more link if it is needed.
        $paginationurl = $chelper->get_categories_display_option('paginationurl');
        $paginationallowall = $chelper->get_categories_display_option('paginationallowall');
        if ($totalcount > count($subcategories)) {
            if ($paginationurl) {
                // The option 'paginationurl was specified, display pagingbar.
                $perpage = $chelper->get_categories_display_option(
                        'limit',
                        $CFG->coursesperpage
                );
                $page = $chelper->get_categories_display_option('offset') / $perpage;
                $pagingbar = $this->paging_bar(
                        $totalcount,
                        $page,
                        $perpage,
                        $paginationurl->out(
                                false,
                                ['perpage' => $perpage]
                        )
                );
                if ($paginationallowall) {
                    $pagingbar .= html_writer::tag(
                            'div',
                            html_writer::link(
                                    $paginationurl->out(
                                            false,
                                            ['perpage' => 'all']
                                    ),
                                    get_string(
                                            'showall',
                                            '',
                                            $totalcount
                                    )
                            ),
                            ['class' => 'paging paging-showall']
                    );
                }
            } else if ($viewmoreurl = $chelper->get_categories_display_option('viewmoreurl')) {
                // The option 'viewmoreurl' was specified, display more link (if it is link to category view page, add category id).
                if ($viewmoreurl->compare(
                        new moodle_url('/course/index.php'),
                        URL_MATCH_BASE
                )) {
                    $viewmoreurl->param(
                            'categoryid',
                            $coursecat->id
                    );
                }
                $viewmoretext = $chelper->get_categories_display_option(
                        'viewmoretext',
                        new lang_string('viewmore')
                );
                $morelink = html_writer::tag(
                        'div',
                        html_writer::link(
                                $viewmoreurl,
                                $viewmoretext
                        ),
                        ['class' => 'paging paging-morelink']
                );
            }
        } else if (($totalcount > $CFG->coursesperpage) && $paginationurl && $paginationallowall) {
            // There are more than one page of results and we are in 'view all' mode, suggest to go back to paginated view mode.
            $pagingbar = html_writer::tag(
                    'div',
                    html_writer::link(
                            $paginationurl->out(
                                    false,
                                    ['perpage' => $CFG->coursesperpage]
                            ),
                            get_string(
                                    'showperpage',
                                    '',
                                    $CFG->coursesperpage
                            )
                    ),
                    ['class' => 'paging paging-showperpage']
            );
        }

        // Display list of subcategories.
        $template = new stdClass();
        $template->items = [];

        $template->collapseid = 'accordion_' . $this->collapsecontainerid;
        $chelper->collapseid = 'accordion_' . $this->collapsecontainerid;
        foreach ($subcategories as $subcategory) {
            $template->items[] = $this->coursecat_category(
                    $chelper,
                    $subcategory,
                    $depth + 1
            );
        }
        if (!empty($pagingbar)) {
            $template->pagingbar = $pagingbar;
        }
        if (!empty($morelink)) {
            $template->morelink = $morelink;
        }

        return $this->output->render_from_template(
                'theme_telaformation/categoryaccordion',
                $template
        );
    }

    /**
     * Returns HTML to display a course category as a part of a tree.
     * This is an internal function, to display a particular category and all its contents.
     * use {@link core_course_renderer::course_category()}
     *
     * @param coursecat_helper $chelper various display options
     * @param coursecat $coursecat
     * @param int $depth depth of this category in the current tree
     *
     * @return string
     */
    protected function coursecat_category(coursecat_helper $chelper, $coursecat, $depth) {
        // Open category tag.

        $template = new stdClass();
        $template->name = $coursecat->get_formatted_name();
        $template->id = 'cat' . $coursecat->id;
        $template->accordion_id = $chelper->collapseid;
        $template->collapse_id = $chelper->collapseid . '_' . $coursecat->id;
        $template->cat_url = new moodle_url(
                '/course/index.php',
                ['categoryid' => $coursecat->id]
        );

        if (empty($this->firstcat)) {
            $template->open = 'in';
            $this->firstcat = 'used';
            $template->active = 'active';
        }
        $template->depth = $depth;
        $template->content = $this->coursecat_category_content(
                $chelper,
                $coursecat,
                $depth
        );
        return $this->output->render_from_template(
                'theme_telaformation/categorypanel',
                $template
        );
    }
}