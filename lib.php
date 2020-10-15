<?php

// This file is part of the Telaformation theme for Moodle
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
 * Theme Telaformation lib file.
 *
 * @package    theme_telaformation
 * @copyright  Tela Botanica 2020
 * @author     Sylvain Revenu - Pimenko 2020 <contact@pimenko.com> <pimenko.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// We will add callbacks here as we add features to our theme.

/**
 * Returns the main SCSS content.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_telaformation_get_main_scss_content($theme) {
    global $CFG;

    // File storage API.
    $scss = '';
    $filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;
    $fs = get_file_storage();

    $context = context_system::instance();
    if ($filename == 'default.scss') {
        // We still load the default preset files directly from the boost theme. No sense in duplicating them.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    } else if ($filename == 'plain.scss') {
        // We still load the default preset files directly from the boost theme. No sense in duplicating them.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/plain.scss');

    } else if ($filename && ($presetfile = $fs->get_file($context->id, 'theme_telaformation', 'preset', 0, '/', $filename))) {
        // This preset file was fetched from the file area for theme_telaformation and not theme_boost (see the line above).
        $scss .= $presetfile->get_content();
    } else {
        // Safety fallback - maybe new installs etc.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    }

    return $scss;
}

/**
 * Get SCSS to prepend.
 * Function to return the SCSS to prepend to our main SCSS for this theme.
 * Note the function name starts with the component name because this is a global function and we don't want namespace clashes.
 *
 * @param theme_config $theme The theme config object.
 * @return array
 */
function theme_telaformation_get_pre_scss($theme) {
    // Load the settings from the parent.
    $theme = theme_config::load('boost');
    // Call the parent themes get_pre_scss function.
    return theme_boost_get_pre_scss($theme);
}

/**
 * Inject additional SCSS.
 * Function to return the SCSS to append to our main SCSS for this theme.
 * Note the function name starts with the component name because this is a global function and we don't want namespace clashes.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_telaformation_get_extra_scss($theme) {
    // Load the settings from the parent.
    $theme = theme_config::load('boost');
    // Call the parent themes get_extra_scss function.
    return theme_boost_get_extra_scss($theme);
}

/**
 * Parses CSS before it is cached.
 * This function can make alterations and replace patterns within the CSS.
 *
 * @param string $css The CSS
 * @param theme_config $theme The theme config object.
 * @return string The parsed CSS The parsed CSS.
 */
function theme_telaformation_process_css($css, $theme) {
    // Define the default settings for the theme incase they've not been set.
    $defaults = [
            'loginbgimage' => '',
            'loginbgstyle' => '',
            'loginbgopacity1' => '',
            'loginbgopacity2' => '',
            'loginbgopacity3' => ''
    ];

    // Get all the defined settings for the theme and replace defaults.
    foreach ($theme->settings as $key => $val) {
        if (array_key_exists($key, $defaults) && !empty($val)) {
            $defaults[$key] = $val;
        }
    }

    // For login bg img.
    $loginbgimage = '';
    if (!empty($theme->settings->loginbgimage)) {
        $loginbgimage = $theme->setting_file_url('loginbgimage', 'loginbgimage');
        $loginbgimage = 'url("' . $loginbgimage . '")';
    }
    $defaults['loginbgimage'] = $loginbgimage;

    // For login bg style.
    $loginbgstyle = '';
    if (!empty($theme->settings->loginbgstyle)) {
        $replacementstyle = 'cover';
        if ($theme->settings->loginbgstyle === 'stretch') {
            $replacementstyle = '100% 100%';
        }
        $loginbgstyle = $replacementstyle;
    }
    $defaults['loginbgstyle'] = $loginbgstyle;

    // For login opacity.
    $loginbgopacity1 = '';
    $loginbgopacity2 = '';
    $loginbgopacity3 = '';
    if (!empty($theme->settings->loginbgopacity)) {
        //$loginbgopacity1 = theme_telaformation_hex2rgba($theme->settings->headerbkcolor2, $theme->settings->loginbgopacity);
        $loginbgopacity2 = 'rgba(255, 255, 255, ' . $theme->settings->loginbgopacity . ') !important;';
        //$loginbgopacity3 = theme_telaformation_hex2rgba($theme->settings->footerbkcolor, $theme->settings->loginbgopacity);
    }
    $defaults['loginbgopacity1'] = $loginbgopacity1;
    $defaults['loginbgopacity2'] = $loginbgopacity2;
    $defaults['loginbgopacity3'] = $loginbgopacity3;

    // Get all the defined settings for the theme and replace defaults.
    $css = strtr($css, $defaults);

    return $css;
}

/**
 * Returns the RGBA for the given hex and alpha.
 *
 * @param string $hex
 * @param string $alpha
 * @return string
 */
function theme_telaformation_hex2rgba($hex, $alpha) {
    $rgba = theme_telaformation_hex2rgb($hex);
    $rgba[] = $alpha;
    return 'rgba(' . implode(", ", $rgba) . ') !important'; // Returns the rgba values separated by commas.
}

/**
 * Returns the RGB for the given hex.
 *
 * @param string $hex
 * @return array
 */
function theme_telaformation_hex2rgb($hex) {
    // From: http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/.
    $hex = str_replace("#", "", $hex);

    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    $rgb = array('r' => $r, 'g' => $g, 'b' => $b);
    return $rgb; // Returns the rgb as an array.
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
function theme_telaformation_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    static $theme;
    if (empty($theme)) {
        $theme = theme_config::load('telaformation');
    }
    if ($context->contextlevel == CONTEXT_SYSTEM) {
        // By default, theme files must be cache-able by both browsers and proxies.  From 'More' theme.
        if (!array_key_exists('cacheability', $options)) {
            $options['cacheability'] = 'public';
        }
        if ($filearea === 'loginbgimage') {
            return $theme->setting_file_serve('loginbgimage', $args, $forcedownload, $options);
        } else if ($filearea === 'favicon') {
            return $theme->setting_file_serve('favicon', $args, $forcedownload, $options);
        } else {
            send_file_not_found();
        }
    } else {
        send_file_not_found();
    }
}
