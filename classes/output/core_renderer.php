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
        global $PAGE;

        // We check if the user is connected and we set the drawer to close.
        if (isloggedin()) {
            $navdraweropen = (get_user_preferences(
                            'drawer-open-nav',
                            'true'
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
        $template->bodyattributes = $OUTPUT->body_attributes($extraclasses);
        $template->logintextboxtop = $OUTPUT->get_setting('logintextboxtop', 'format_html');
        $template->logintextboxbottom = $OUTPUT->get_setting('logintextboxbottom', 'format_html');

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

}