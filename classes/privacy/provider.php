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
 * Privacy Subsystem implementation for theme_pimenko.
 *
 * @package    theme_pimenko
 * @copyright  2026 Pimenko
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_pimenko\privacy;

use core_privacy\local\metadata\collection;

/**
 * The pimenko theme stores a user preference data.
 *
 * @copyright  2026 Pimenko
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements
    // This plugin has data.
    \core_privacy\local\metadata\provider,
    // This plugin has some sitewide user preferences to export.
    \core_privacy\local\request\user_preference_provider {
    /** The user preferences for the course index. */
    const DRAWER_OPEN_INDEX = 'drawer-open-index';

    /** The user preferences for the blocks drawer. */
    const DRAWER_OPEN_BLOCK = 'drawer-open-block';

    /**
     * Returns meta data about this system.
     *
     * @param collection $items The initialised item collection to add items to.
     * @return collection A listing of user data stored through this system.
     */
    public static function get_metadata(collection $items): collection {
        $items->add_user_preference(
            self::DRAWER_OPEN_INDEX,
            'privacy:metadata:preference:draweropenindex',
        );
        $items->add_user_preference(
            self::DRAWER_OPEN_BLOCK,
            'privacy:metadata:preference:draweropenblock',
        );
        return $items;
    }

    /**
     * Get the list of contexts that contain user information for the specified user.
     *
     * @param int $userid The user to search.
     * @return \core_privacy\local\request\contextlist The contextlist containing the list of contexts used by this plugin.
     */
    public static function get_contexts_for_userid(int $userid): \core_privacy\local\request\contextlist {
        return new \core_privacy\local\request\contextlist();
    }

    /**
     * Export all user data for the specified user, in the specified contexts.
     *
     * @param \core_privacy\local\request\approved_contextlist $contextlist The approved contexts to export information for.
     */
    public static function export_user_data(\core_privacy\local\request\approved_contextlist $contextlist) {
        // This plugin does not store any user data in contexts.
    }

    /**
     * Delete all data for all users in the specified context.
     *
     * @param \context $context The specific context to delete data for.
     */
    public static function delete_data_for_all_users_in_context(\context $context) {
        // This plugin does not store any user data in contexts.
    }

    /**
     * Delete all user data for the specified user, in the specified contexts.
     *
     * @param \core_privacy\local\request\approved_contextlist $contextlist The approved contexts and user to delete.
     */
    public static function delete_data_for_user(\core_privacy\local\request\approved_contextlist $contextlist) {
        // This plugin does not store any user data in contexts.
    }

    /**
     * Store all user preferences for the plugin.
     *
     * @param int $userid The userid of the user whose data is to be exported.
     */
    public static function export_user_preferences(int $userid) {
        $draweropenindexpref = get_user_preferences(
            self::DRAWER_OPEN_INDEX,
            null,
            $userid,
        );

        if (isset($draweropenindexpref)) {
            $preferencestring = get_string(
                'privacy:drawerindexclosed',
                'theme_pimenko',
            );
            if ($draweropenindexpref == 1) {
                $preferencestring = get_string(
                    'privacy:drawerindexopen',
                    'theme_pimenko',
                );
            }
            \core_privacy\local\request\writer::export_user_preference(
                'theme_pimenko',
                self::DRAWER_OPEN_INDEX,
                $draweropenindexpref,
                $preferencestring,
            );
        }

        $draweropenblockpref = get_user_preferences(
            self::DRAWER_OPEN_BLOCK,
            null,
            $userid,
        );

        if (isset($draweropenblockpref)) {
            $preferencestring = get_string(
                'privacy:drawerblockclosed',
                'theme_pimenko',
            );
            if ($draweropenblockpref == 1) {
                $preferencestring = get_string(
                    'privacy:drawerblockopen',
                    'theme_pimenko',
                );
            }
            \core_privacy\local\request\writer::export_user_preference(
                'theme_pimenko',
                self::DRAWER_OPEN_BLOCK,
                $draweropenblockpref,
                $preferencestring,
            );
        }
    }

    /**
     * Delete all user preferences of the specified user.
     *
     * @param int $userid The userid of the user whose data is to be deleted.
     */
    public static function delete_user_preferences(int $userid) {
        unset_user_preference(
            self::DRAWER_OPEN_INDEX,
            $userid,
        );
        unset_user_preference(
            self::DRAWER_OPEN_BLOCK,
            $userid,
        );
    }
}
