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

namespace theme_pimenko\output\core\navigation;

use renderer_base;
use theme_config;

/**
 * more menu navigation renderable
 *
 * @package     core
 * @category    navigation
 * @copyright   2021 onwards Adrian Greeve
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class more_menu extends \core\navigation\output\more_menu {

    /**
     * Return data for rendering a template.
     * Ovveride this to add an option for hide participants node
     *
     * @param renderer_base $output The output
     * @return array Data for rendering a template
     */
    public function export_for_template(renderer_base $output): array {
        $data = ['navbarstyle' => $this->navbarstyle];

        // Hide participants node with theme settings ask for it.
        $theme    = theme_config::load('pimenko');
        if (!$theme->settings->showparticipantscourse) {
            $this->content->children->remove('participants');
        }

        if ($this->haschildren) {
            // The node collection doesn't have anything to render so exit now.
            if (!isset($this->content->children) || count($this->content->children) == 0) {
                return [];
            }
            $data['nodecollection'] = $this->content;
        } else {
            $data['nodearray'] = (array) $this->content;
        }
        $data['moremenuid'] = uniqid();

        return $data;
    }

}
