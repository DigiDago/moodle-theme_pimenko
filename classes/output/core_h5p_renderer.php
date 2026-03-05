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

namespace theme_pimenko\output;

use theme_config;
use context_system;

/**
 * Class core_h5p_renderer
 *
 * Extends the H5P renderer so that we are able to override the relevant
 * functions declared there
 *
 * @package    theme_pimenko
 * @copyright  Pimenko 2019
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_h5p_renderer extends \core_h5p\output\renderer {
    /**
     * Alters the styles being loaded for H5P content.
     *
     * This method allows the addition of custom styles defined in the theme
     * configuration to be applied to H5P content. If a custom CSS file is
     * configured, its URL is added to the styles array.
     *
     * @param array  $styles An array of style objects that will be modified to include additional styles.
     * @param array  $libraries An array of H5P libraries being used.
     * @param string $embedtype Specifies how the content is embedded (e.g., div, iframe).
     * @return void
     */
    public function h5p_alter_styles(&$styles, $libraries, $embedtype) {
        global $CFG;
        $theme = theme_config::load('pimenko');

        // Generate url of file we set up in settings.
        $component = 'theme_pimenko';
        $itemid = theme_get_revision();
        $filepath = $theme->settings->h5pcss;
        $syscontext = context_system::instance();
        // Don't add url if filepath is empty to prevent case where user don't custom H5P css.
        if ($filepath) {
            $url = "$CFG->wwwroot/pluginfile.php" . "/$syscontext->id/$component/h5pcss/$itemid" . $filepath;

            // Now we can send it to h5p.
            $styles[] = (object) [
                'path' => $url,
                'version' => '',
            ];
        }
    }
}
