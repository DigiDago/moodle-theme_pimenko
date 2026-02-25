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
 * Theme pimenko renderer file.
 *
 * @package    theme_pimenko
 * @copyright  Pimenko 2019
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_pimenko\output;

use coding_exception;
use moodle_exception;
use plugin_renderer_base;
use theme_config;
use stdClass;

/**
 * carousel_renderer is responsible for rendering a carousel in the theme.
 */
final class carousel_renderer extends plugin_renderer_base {
    /**
     * Configuration array for theme settings.
     * @var \core\output\theme_config
     */
    public $themeconf;
    /**
     * An array to hold slide data.
     * @var array|mixed
     */
    public $slides = [];
    /**
     * The layout of the carousel.
     * @var string
     */
    public $layout;

    /**
     * Generates and returns the rendered output of a carousel.
     *
     * @return string The rendered carousel output based on the provided template and slides.
     */
    public function output(): string {
        $this->load_items();
        $template = new stdClass();
        $template->slides = $this->slides;
        $template->layout = 'centered';
        return $this->render_from_template(
            'theme_pimenko/carousel',
            $template,
        );
    }

    /**
     * Loads the theme configuration and initializes slide items for a carousel.
     *
     * This method processes the theme settings and generates slides based on the number
     * of configured images, assigning necessary properties such as image URLs, captions,
     * and active state to each slide. The slides are stored in the `$slides` property.
     *
     * @return bool True on successful loading of the slides.
     */
    private function load_items(): bool {
        $this->themeconf = $theme = theme_config::load('pimenko');
        $imagenr = $this->themeconf->settings->slideimagenr;
        for ($i = 1; $i <= $imagenr; $i++) {
            $slide = new stdClass();
            // We need to count from 0 or indicator will not work.
            $slide->slidenum = $i - 1;
            $slide->active = '';
            if ($i == 1) {
                $slide->active = 'active';
            }
            $image = "slideimage{$i}";
            $caption = "slidecaption{$i}";
            if (
                $this->themeconf->setting_file_url(
                    $image,
                    $image,
                )
            ) {
                $slide->image = $this->themeconf->setting_file_url(
                    $image,
                    $image,
                );
                $slide->caption = format_text($this->themeconf->settings->$caption);
                $this->slides[] = $slide;
            }
        }
        return true;
    }
}
