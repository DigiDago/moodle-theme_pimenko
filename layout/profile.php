<?php
// This file is part of the telaformation theme for Moodle
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
 * Theme telaformation lib.
 *
 * @package    theme_telaformation
 * @copyright  2017 DigiDago
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__ . '/../../../config.php');
require_login();

global $OUTPUT, $PAGE;

$context = context_system::instance();

$userid = required_param(
        'userid',
        PARAM_INT
);

$PAGE->set_url(
        '/user/profile.php',
        ['id' => $userid]
);

if (!empty($CFG->forceloginforprofiles)) {
    if (isguestuser()) {
        $PAGE->set_context(context_system::instance());
        echo $OUTPUT->header();
        echo $OUTPUT->confirm(
                get_string(
                        'guestcantaccessprofiles',
                        'error'
                ),
                get_login_url(),
                $CFG->wwwroot
        );
        echo $OUTPUT->footer();
        die;
    }
}

$PAGE->set_context($context);
$PAGE->set_pagelayout('telaformationProfile');
$PAGE->set_title('Profile');
$PAGE->blocks->show_only_fake_blocks();

$profile = $PAGE->get_renderer(
        'theme_telaformation',
        'profile'
);

$content = $profile->userprofile($userid);

echo $OUTPUT->header();

if (empty($content)) {
    echo 'Profile not found';
} else {
    echo $content;
}

echo $OUTPUT->footer();