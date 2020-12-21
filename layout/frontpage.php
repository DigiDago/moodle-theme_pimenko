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
 * A two column layout for the boost theme.
 *
 * @package    theme_telaformation2
 * @copyright  Pimenko 2019
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

user_preference_allow_ajax_update(
        'drawer-open-nav',
        PARAM_ALPHA
);
require_once($CFG->libdir . '/behat/lib.php');

if (isloggedin()) {
    $navdraweropen = false;
} else {
    $navdraweropen = false;
}
$extraclasses = [];
if ($navdraweropen) {
    $extraclasses[] = 'drawer-open-left';
}
$bodyattributes = $OUTPUT->body_attributes($extraclasses);
$blockshtml = $OUTPUT->blocks('side-pre');
$hasblocks = strpos( $blockshtml, 'data-block=' ) !== false;
$regionmainsettingsmenu = $OUTPUT->region_main_settings_menu();
$hasfrontpageregions = $OUTPUT->get_block_regions();
$iscarouselenabled = $OUTPUT->is_carousel_enabled();
$templatecontext = [
        'sitename' => format_string(
                $SITE->shortname,
                true,
                [
                        'context' => context_course::instance(SITEID),
                        "escape" => false
                ]
        ),
        'output' => $OUTPUT,
        'sidepreblocks' => $blockshtml,
        'hasblocks' => $hasblocks,
        'bodyattributes' => $bodyattributes,
        'navdraweropen' => $navdraweropen,
        'regionmainsettingsmenu' => $regionmainsettingsmenu,
        'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu),
        'hasfrontpageregions' => !empty($hasfrontpageregions),
        'iscarouselenabled' => $iscarouselenabled,
];

// Include js module.
$PAGE->requires->js_call_amd('theme_telaformation/telaformation', 'init');
$PAGE->requires->js_call_amd('theme_telaformation/completion', 'init');

$templatecontext['flatnavigation'] = $PAGE->flatnav;
echo $OUTPUT->render_from_template(
        'theme_telaformation/frontpage',
        $templatecontext
);