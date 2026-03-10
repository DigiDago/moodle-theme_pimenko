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
 * Utility class for theme_pimenko.
 *
 * @package    theme_pimenko
 * @copyright  Pimenko 2025
 * @author     Junie (AI)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_pimenko;

use core_course_category;

/**
 * Utility class.
 */
class util {
    /**
     * Ensure all parent categories are visible.
     * A child must be hidden if any ancestor is hidden, regardless of the child's own visible flag.
     *
     * @param core_course_category $category
     * @return bool
     */
    public static function are_all_parents_visible(core_course_category $category): bool {
        $parentids = $category->get_parents();
        if (empty($parentids)) {
            return true;
        }
        foreach ($parentids as $pid) {
            // Use core API to fetch parent category and check its visible flag only.
            $parent = core_course_category::get($pid, MUST_EXIST, true);
            if ($parent && !$parent->visible) {
                return false;
            }
        }
        return true;
    }
}
