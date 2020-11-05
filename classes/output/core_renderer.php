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

use stdClass;
use theme_config;
use context_course;
use custom_menu;
use html_writer;
use completion_info;

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

    /**
     * Returns template of login page.
     *
     * @param $OUTPUT
     * @return string
     */
    public final function render_login_page($OUTPUT): string {
        global $SITE ,$PAGE;

        // We check if the user is connected and we set the drawer to close.
        if (isloggedin()) {
            $navdraweropen = (get_user_preferences(
                            'drawer-open-nav',
                            'false'
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
        $template->sitename = format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]);
        $template->bodyattributes = $OUTPUT->body_attributes($extraclasses);

        // Define nav for the drawer.
        $template->flatnavigation = $PAGE->flatnav;

        // Output content.
        $template->output = $OUTPUT;

        // Main login content.
        $template->maincontent = $OUTPUT->main_content();

        return $OUTPUT->render_from_template(
                'theme_telaformation/login',
                $template
        );
    }

    /**
     * Returns settings as formatted text
     *
     * @param string $setting
     * @param bool $format = false
     * @param string $theme = null
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
            return format_text($theme->settings->$setting, FORMAT_HTML, array('trusted' => true));
        } else {
            return format_string($theme->settings->$setting);
        }
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
                    'sitelogo',
                    'sitelogo'
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
                        $space,
                        '',
                        $theme->settings->$text
                );
                if (!empty($textwithoutspace)) {
                    $column = new stdClass();
                    $column->text = format_text($theme->settings->$text);
                    $column->list = [];
                    $menu = new custom_menu(
                            $column->text,
                            current_language()
                    );
                    foreach ($menu->get_children() as $item) {
                        $listitem = new stdClass();
                        $listitem->text = $item->get_text();
                        $listitem->url = $item->get_url();
                        $column->list[] = $listitem;
                    }
                    if (isset($theme->settings->$heading)) {
                        $column->heading = format_text($theme->settings->$heading);
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
                'theme_telaformation/footercustomcontent',
                $template
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
                    'favicon',
                    'favicon'
            );
        }
        return parent::favicon();
    }

    /**
     * Renders the login form.
     *
     * @param \core_auth\output\login $form The renderable.
     * @return string
     */
    public function render_login(\core_auth\output\login $form) {
        global $CFG, $SITE, $OUTPUT;

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
        $context->sitename = format_string($SITE->fullname, true,
                ['context' => context_course::instance(SITEID), "escape" => false]);

        $context->logintextboxtop = $OUTPUT->get_setting('logintextboxtop', 'format_html');
        $context->logintextboxbottom = $OUTPUT->get_setting('logintextboxbottom', 'format_html');

        return $this->render_from_template('core/loginform', $context);
    }

    /**
     * Render mod completion
     * If we're on a 'mod' page, retrieve the mod object and check it's completion state in order to conditionally
     * pop a completion modal and show a link to the next activity in the footer.
     *
     * @return string list of $mod, show completed activity (bool), and show completion modal (bool)
     */
    public function render_completion_footer(): string {
        global $PAGE, $COURSE, $OUTPUT;

        if ($COURSE->enablecompletion != COMPLETION_ENABLED) {
            return '';
        }

        if ($OUTPUT->body_id() == 'page-mod-quiz-attempt') {
            return '';
        }

        echo html_writer::start_tag(
                'form',
                [
                        'action' => '.',
                        'method' => 'get'
                ]
        );
        echo html_writer::start_tag('div');
        echo html_writer::empty_tag(
                'input',
                [
                        'type' => 'hidden',
                        'id' => 'completion_dynamic_change',
                        'name' => 'completion_dynamic_change',
                        'value' => '0'
                ]
        );
        echo html_writer::end_tag('div');
        echo html_writer::end_tag('form');

        $PAGE->requires->js_init_call('M.core_completion.init');

        $renderer = $PAGE->get_renderer(
                'core',
                'course'
        );

        $completioninfo = new completion_info($COURSE);

        // Short-circuit if we are not on a mod page, and allow restful access
        $pagepath = explode(
                '-',
                $PAGE->pagetype
        );
        if ($pagepath[0] != 'mod') {
            return '';
        }
        if ($pagepath[2] == 'index') {
            return '';
        }
        // Make sure we have a mod object.
        $mod = $PAGE->cm;
        if (!is_object($mod)) {
            return '';
        }

        // Get all course modules from modinfo
        $cms = $mod->get_modinfo()->cms;

        $currentcmidfoundflag = false;
        $nextmod = false;
        // Loop through all course modules to find the next mod
        foreach ($cms as $cmid => $cm) {
            // The nextmod must be after the current mod
            // Keep looping until the current mod is found (+1)
            if (!$currentcmidfoundflag) {
                if ($cmid == $mod->id) {
                    $currentcmidfoundflag = true;
                }

                // short circuit to next mod in list
                continue;

            } else {
                // (The continue and else condition are not mutually neccessary
                // but the statement block is more clear with the explicit else)

                // The current activity has been found... set the next activity to the first
                // user visible mod after this point.
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
                    $COURSE,
                    $completioninfo,
                    $mod,
                    ['showcompletiontext' => true]
            );
            return $OUTPUT->render_from_template(
                    'theme_telaformation/completionfooter',
                    $template
            );
        }
        return '';
    }
}