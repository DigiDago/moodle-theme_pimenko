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
 * Theme Telaformation renderer file.
 *
 * @package    theme_telaformation
 * @copyright  Tela Botanica 2020
 * @author     Sylvain Revenu - Pimenko 2020 <contact@pimenko.com> <pimenko.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_telaformation\output;

use core_auth\output\login;
use stdClass;
use theme_config;
use context_course;
use custom_menu;
use html_writer;
use completion_info;
use context_system;
use moodle_url;

defined('MOODLE_INTERNAL') || die;


/**
 * Class core_renderer extended
 *
 * @package    theme_telaformation
 * @copyright  Tela Botanica 2020
 * @author     Sylvain Revenu - Pimenko 2020 <contact@pimenko.com> <pimenko.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class core_renderer extends \theme_boost\output\core_renderer {
    private $themeconfig;

    /**
     * Returns template of login page.
     *
     * @param $output
     *
     * @return string
     */
    public function render_login_page($output): string {
        global $SITE;

        // We check if the user is connected and we set the drawer to close.
        if (isloggedin()) {
            $navdraweropen = (get_user_preferences(
                            'drawer-open-nav', 'false'
                    ) == 'false');
        } else {
            $navdraweropen = false;
        }

        $extraclasses = [];
        if ($navdraweropen) {
            $extraclasses[] = 'drawer-open-left';
        }

        // Define some needed var for ur template.
        $template = new stdClass();
        $template->sitename = format_string(
                $SITE->shortname, true, [
                        'context' => context_course::instance(SITEID),
                        "escape" => false
                ]
        );
        $template->bodyattributes = $output->body_attributes($extraclasses);

        // Define nav for the drawer.
        $template->flatnavigation = $this->page->flatnav;

        // Output content.
        $template->output = $output;

        // Main login content.
        $template->maincontent = $output->main_content();

        return $output->render_from_template(
                'theme_telaformation/login', $template
        );
    }

    /**
     * @return string
     */
    public function sitelogo(): string {
        $sitelogo = '';
        if (!empty($this->page->theme->settings->sitelogo)) {
            if (empty($this->themeconfig)) {
                $this->themeconfig = $theme = theme_config::load('telaformation');
            }
            $sitelogo = $this->themeconfig->setting_file_url(
                    'sitelogo', 'sitelogo'
            );
        }
        return $sitelogo;
    }

    /**
     * Render footer
     *
     * @return string footer template
     */
    public function footer_custom_content(): string {
        $theme = theme_config::load('telaformation');

        $template = new stdClass();

        $template->columns = [];

        for ($i = 1; $i <= 4; $i++) {
            $heading = "footerheading{$i}";
            $text = "footertext{$i}";
            if (isset($theme->settings->$text) && !empty($theme->settings->$text)) {
                $space = [
                        '/ /',
                        "/\s/",
                        "/&nbsp;/",
                        "/\t/",
                        "/\n/",
                        "/\r/",
                        "/<p>/",
                        "/<\/p>/"
                ];
                $textwithoutspace = preg_replace(
                        $space, '', $theme->settings->$text
                );
                if (!empty($textwithoutspace)) {
                    $column = new stdClass();
                    $column->text = format_text($theme->settings->$text, FORMAT_HTML);
                    $column->classtext = $text;
                    $column->list = [];
                    $menu = new custom_menu(
                            $column->text, current_language()
                    );
                    foreach ($menu->get_children() as $item) {
                        $listitem = new stdClass();
                        $listitem->text = $item->get_text();
                        $listitem->url = $item->get_url();
                        $column->list[] = $listitem;
                    }
                    if (isset($theme->settings->$heading)) {
                        $column->heading = format_text($theme->settings->$heading, FORMAT_HTML);
                        $column->classheading = $heading;
                    }
                    $template->columns[] = $column;
                }
            }
        }

        if (count($template->columns) > 0) {
            $template->gridcount = (12 / (count($template->columns)));
        } else {
            $template->gridcount = 12;
        }

        return $this->render_from_template(
                'theme_telaformation/footercustomcontent', $template
        );
    }

    /**
     * Returns the URL for the favicon.
     *
     * @return string The favicon URL
     */
    public function favicon(): string {
        if (!empty($this->page->theme->settings->favicon)) {
            if (empty($this->themeconfig)) {
                $this->themeconfig = $theme = theme_config::load('telaformation');
            }
            return $this->themeconfig->setting_file_url(
                    'favicon', 'favicon'
            );
        }
        return parent::favicon();
    }

    /**
     * Returns the google font set
     *
     * @return string Google font
     */
    public function googlefont(): string {
        if (!empty($this->page->theme->settings->googlefont)) {
            if (empty($this->themeconfig)) {
                $this->themeconfig = $theme = theme_config::load('telaformation');
            }
            return $this->page->theme->settings->googlefont;
        }
        // The default font we use if no settings define.
        return 'Verdana';
    }

    /**
     * Renders the login form.
     *
     * @param login $form The renderable.
     *
     * @return string
     */
    public function render_login(login $form) {
        global $CFG, $SITE;

        $context = $form->export_for_template($this);

        // Override because rendering is not supported in template yet.
        if ($CFG->rememberusername == 0) {
            $context->cookieshelpiconformatted = $this->help_icon('cookiesenabledonlysession');
        } else {
            $context->cookieshelpiconformatted = $this->help_icon('cookiesenabled');
        }
        $context->errorformatted = $this->error_text($context->error);
        $url = $this->get_logo_url();
        if ($url) {
            $url = $url->out(false);
        }
        $context->logourl = $url;
        $context->sitename = format_string(
                $SITE->fullname, true, [
                        'context' => context_course::instance(SITEID),
                        "escape" => false
                ]
        );

        $context->logintextboxtop = self::get_setting('logintextboxtop', 'format_html');
        $context->logintextboxbottom = self::get_setting('logintextboxbottom', 'format_html');

        return $this->render_from_template('core/loginform', $context);
    }

    /**
     * Returns settings as formatted text
     *
     * @param string $setting
     * @param bool $format = false
     * @param string $theme = null
     *
     * @return string
     */
    public function get_setting($setting, $format = false, $theme = null) {
        if (empty($theme)) {
            $theme = theme_config::load('telaformation');
        }

        if (empty($theme->settings->$setting)) {
            return false;
        } else if (!$format) {
            return $theme->settings->$setting;
        } else if ($format === 'format_text') {
            return format_text($theme->settings->$setting, FORMAT_PLAIN);
        } else if ($format === 'format_html') {
            return format_text($theme->settings->$setting, FORMAT_HTML, ['trusted' => true]);
        } else {
            return format_string($theme->settings->$setting);
        }
    }

    /**
     * Render mod completion
     * If we're on a 'mod' page, retrieve the mod object and check it's completion state in order to conditionally
     * pop a completion modal and show a link to the next activity in the footer.
     *
     * @return string list of $mod, show completed activity (bool), and show completion modal (bool)
     */
    public function render_completion_footer(): string {
        global $COURSE;

        if ($COURSE->enablecompletion != COMPLETION_ENABLED) {
            return '';
        }
        if ($this->page->bodyid == 'page-mod-quiz-attempt') {
            return '';
        }

        echo html_writer::start_tag(
                'form', [
                        'action' => '.',
                        'method' => 'get'
                ]
        );
        echo html_writer::start_tag('div');
        echo html_writer::empty_tag(
                'input', [
                        'type' => 'hidden',
                        'id' => 'completion_dynamic_change',
                        'name' => 'completion_dynamic_change',
                        'value' => '0'
                ]
        );
        echo html_writer::end_tag('div');
        echo html_writer::end_tag('form');

        $this->page->requires->js_init_call('M.core_completion.init');

        $renderer = $this->page->get_renderer(
                'core', 'course'
        );

        $completioninfo = new completion_info($COURSE);

        // Short-circuit if we are not on a mod page, and allow restful access.
        $pagepath = explode(
                '-', $this->page->pagetype
        );
        if ($pagepath[0] != 'mod') {
            return '';
        }
        if ($pagepath[2] == 'index') {
            return '';
        }
        // Make sure we have a mod object.
        $mod = $this->page->cm;
        if (!is_object($mod)) {
            return '';
        }

        // Get all course modules from modinfo.
        $cms = $mod->get_modinfo()->cms;

        $currentcmidfoundflag = false;
        $nextmod = false;
        // Loop through all course modules to find the next mod.
        foreach ($cms as $cmid => $cm) {
            // The nextmod must be after the current mod.
            // Keep looping until the current mod is found (+1).
            if (!$currentcmidfoundflag) {
                if ($cmid == $mod->id) {
                    $currentcmidfoundflag = true;
                }

                // Short circuit to next mod in list.
                continue;

            } else {
                // The continue and else condition are not mutually neccessary.
                // But the statement block is more clear with the explicit else).
                // The current activity has been found... set the next activity to the first.
                // User visible mod after this point.
                if ($cm->uservisible) {
                    $nextmod = $cm;
                    break;
                }
            }
        }
        $template = new stdClass();

        if ($nextmod) {
            $template->nextmodname = format_string($nextmod->name);
            $template->nextmodurl = $nextmod->url;
        }

        if ($completioninfo->is_enabled($mod)) {
            $template->completionicon = $renderer->course_section_cm_completion(
                    $COURSE, $completioninfo, $mod, ['showcompletiontext' => true]
            );
            return $renderer->render_from_template(
                    'theme_telaformation/completionfooter', $template
            );
        }
        return '';
    }

    /**
     * Returns "add course" and "view all courses" buttons.
     *
     * @return string HTML for "add course" and "view all courses" buttons.
     */
    public function add_managerbtns(): string {
        global $CFG;

        // We display this only if we are on dashboard page.
        if ($this->page->pagelayout != "mydashboard") {
            return false;
        }

        $output = '';
        $output .= html_writer::start_tag(
                'div', ['class' => 'managerbtns']
        );
        $context = context_system::instance();

        // Add button create course, we check user capability.
        if (has_capability(
                'moodle/course:create', $context
        )) {
            // Print link to create a new course, for the 1st available category.
            $url = new moodle_url(
                    '/course/edit.php', [
                            'category' => $CFG->defaultrequestcategory,
                            'returnto' => 'topcat'
                    ]
            );
            $output .= $this->single_button(
                    $url, get_string('addnewcourse'), 'get'
            );
        }

        // Add button redirect to course list.
        $url = new moodle_url('/course/index.php');
        $output .= $this->single_button(
                $url, get_string('viewallcourses'), 'get'
        );

        $output .= html_writer::end_tag('div');
        return $output;
    }

    /**
     * Renders block regions on home page
     *
     * @return string
     */
    public function get_block_regions(): string {

        global $USER;

        $settingsname = 'blockrow';
        $fields = [];
        $retval = '';
        $blockcount = 0;
        $style = '';
        $adminediting = false;

        if (is_siteadmin() && isset($USER->editing) && $USER->editing == 1) {
            $style = '" style="display: block; background: #EEEEEE; min-height: 50px;
        border: 2px dashed #BFBDBD; margin-top: 5px';
            $adminediting = true;
        }
        for ($i = 1; $i <= 8; $i++) {
            $blocksrow = "{$settingsname}{$i}";
            $blocksrow = $this->page->theme->settings->$blocksrow;
            if ($blocksrow != '0-0-0-0') {
                $fields[] = $blocksrow;
            }
        }

        $i = 0;
        foreach ($fields as $field) {
            $retval .= '<div class="row front-page-row" id="front-page-row-' . ++$i . '">';
            $vals = explode(
                    '-', $field
            );
            foreach ($vals as $val) {
                if ($val > 0) {
                    $retval .= "<div class=\"col-md-{$val}{$style}\">";

                    // Moodle does not seem to like numbers in region names so using letter instead.
                    $blockcount++;
                    $block = 'theme-front-' . chr(96 + $blockcount);

                    if ($adminediting) {
                        $retval .= '<span style="padding-left: 10px;"> ' . '' . '</span>';
                    }

                    $retval .= $this->blocks(
                            $block, 'block-region-front container-fluid'
                    );
                    $retval .= '</div>';
                }
            }
            $retval .= '</div>';
        }

        return $retval;
    }

    /**
     * Check if renderer is enabled.
     *
     * @return bool
     */
    public function is_carousel_enabled(): bool {
        if (empty($this->themeconfig)) {
            $this->themeconfig = $theme = theme_config::load('telaformation');
        }
        if (isset($this->themeconfig->settings->enablecarousel)
                && $this->themeconfig->settings->enablecarousel == 1) {
            return true;
        }
        return false;
    }

    /**
     * Init carousel renderer.
     *
     * @return string
     */
    public function carousel(): string {
        $carousel = $this->page->get_renderer('theme_telaformation', 'carousel');
        return $carousel->output();
    }
}