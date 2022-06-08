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

namespace theme_pimenko\output\core;

use moodle_url;
use theme_config;

/**
 * Class responsible for generating the action bar (tertiary nav) elements in an individual category page
 *
 * @package    core
 * @copyright  2021 Peter Dias
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class category_action_bar extends \core_course\output\category_action_bar {

    /**
     * Export the content to be displayed on the category page.
     *
     * @param \renderer_base $output
     * @return array Consists of the following:
     *              - categoryselect A list of available categories to be fed into a urlselect
     *              - search The course search form
     *              - additionaloptions Additional actions that can be performed in a category
     */
    public function export_for_template(\renderer_base $output): array {
        $template = [
            'categoryselect' => $this->get_category_select($output),
            'search' => $this->get_search_form(),
            'additionaloptions' => $this->get_additional_category_options()
        ];

        $theme = theme_config::load('pimenko');

        if (isset($theme->settings->tagfilter) && $theme->settings->tagfilter && $theme->settings->enablecatalog) {
            $template['tagselect'] = $this->get_tags_select($output);
        }

        return $template;
    }

    /**
     * Gets the url_select to be displayed in the participants page if available.
     *
     * @param \renderer_base $output
     * @return object|null The content required to render the url_select
     */
    public function get_tags_select(\renderer_base $output): ?object {
        global $DB;

        $alltagsobj = new \stdClass();
        $alltagsobj->id = '0';
        $alltagsobj->name = get_string('alltags', 'theme_pimenko');
        $alltagsobj->raw = get_string('alltags', 'theme_pimenko');
        $alltags[] = $alltagsobj;

        $tags = $DB->get_records_sql('SELECT * FROM {tag}');
        $tags = array_merge($alltags, $tags);

        if (count($tags) > 1) {
            foreach ($tags as $id => $tag) {
                $url = new moodle_url($this->page->url, ['tagid' => $tag->id]);
                $options[$url->out()] = $tag->name;
            }
            $currenturl = new moodle_url($this->page->url->get_path(), ['tagid' => $tag->id]);
            $select = new \url_select($options, $currenturl, null);
            $select->set_label(get_string('tags'), ['class' => 'sr-only']);
            $select->class .= ' text-truncate w-100';

            return $select->export_for_template($output);
        } else {
            return null;
        }
    }
}
