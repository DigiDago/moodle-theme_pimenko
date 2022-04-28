<?php
// This file is part of the moockie2 theme for Moodle
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
 * Theme pimenko profile render file.
 *
 * @package    theme_pimenko
 * @copyright  Pimenko 2019
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_pimenko\external;
use coding_exception;
use context_course;
use core_course_category;
use core_course_list_element;
use external_api;
use external_files;
use external_format_value;
use external_function_parameters;
use external_multiple_structure;
use external_single_structure;
use external_util;
use external_value;
use external_warnings;
use invalid_parameter_exception;
use moodle_exception;
use moodle_url;
use theme_config;
use function clean_param;
use function enrol_get_instances;
use function enrol_get_my_courses;
use function external_format_string;
use function external_format_text;
use function format_string;
use function get_course_display_name_for_list;
use function is_enrolled;
use function is_siteadmin;
use function require_capability;
use const IGNORE_MISSING;
use const PARAM_ALPHA;
use const PARAM_BOOL;
use const PARAM_CAPABILITY;
use const PARAM_INT;
use const PARAM_NOTAGS;
use const PARAM_PLUGIN;
use const PARAM_RAW;
use const PARAM_SAFEDIR;
use const PARAM_TEXT;
use const VALUE_DEFAULT;
use const VALUE_OPTIONAL;

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir . "/externallib.php");
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->libdir . '/filterlib.php');

class search_courses extends external_api {

    /**
     * Returns description of method parameters
     *
     * @return external_function_parameters
     * @since Moodle 3.0
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters(
            [
                'criterianame' => new external_value(
                    PARAM_ALPHA,
                    'criteria name
                                                        (search, modulelist (only admins), blocklist (only admins), tagid)'
                ),
                'criteriavalue' => new external_value(
                    PARAM_RAW,
                    'criteria value'
                ),
                'page' => new external_value(
                    PARAM_INT,
                    'page number (0 based)',
                    VALUE_DEFAULT,
                    0
                ),
                'perpage' => new external_value(
                    PARAM_INT,
                    'items per page',
                    VALUE_DEFAULT,
                    0
                ),
                'requiredcapabilities' => new external_multiple_structure(
                    new external_value(
                        PARAM_CAPABILITY,
                        'Capability string used to filter courses by permission'
                    ),
                    'Optional list of required capabilities (used to filter the list)',
                    VALUE_DEFAULT,
                    []
                ),
                'limittoenrolled' => new external_value(
                    PARAM_BOOL,
                    'limit to enrolled courses',
                    VALUE_DEFAULT,
                    0
                ),
            ]
        );
    }

    /**
     * Returns description of method result value
     *
     * @return external_single_structure
     * @since Moodle 3.0
     */
    public static function execute_returns(): external_single_structure {
        return new external_single_structure(
            [
                'total' => new external_value(
                    PARAM_INT,
                    'total course count'
                ),
                'courses' => new external_multiple_structure(
                    self::get_course_structure(),
                    'course'
                ),
                'warnings' => new external_warnings()
            ]
        );
    }

    /**
     * Returns a course structure definition
     *
     * @param boolean $onlypublicdata set to true, to retrieve only fields viewable by anyone when the course is
     *                                 visible
     *
     * @return external_single_structure|array the course structure
     * @since  Moodle 3.2
     */
    protected static function get_course_structure(bool $onlypublicdata = true) {
        $coursestructure = [
            'id' => new external_value(
                PARAM_INT,
                'course id'
            ),
            'fullname' => new external_value(
                PARAM_TEXT,
                'course full name'
            ),
            'displayname' => new external_value(
                PARAM_TEXT,
                'course display name'
            ),
            'shortname' => new external_value(
                PARAM_TEXT,
                'course short name'
            ),
            'categoryid' => new external_value(
                PARAM_INT,
                'category id'
            ),
            'categoryname' => new external_value(
                PARAM_TEXT,
                'category name'
            ),
            'sortorder' => new external_value(
                PARAM_INT,
                'Sort order in the category',
                VALUE_OPTIONAL
            ),
            'summary' => new external_value(
                PARAM_RAW,
                'summary'
            ),
            'summaryformat' => new external_format_value('summary'),
            'summaryfiles' => new external_files(
                'summary files in the summary field',
                VALUE_OPTIONAL
            ),
            'overviewfiles' => new external_files('additional overview files attached to this course'),
            'contacts' => new external_multiple_structure(
                new external_single_structure(
                    [
                        'id' => new external_value(
                            PARAM_INT,
                            'contact user id'
                        ),
                        'fullname' => new external_value(
                            PARAM_NOTAGS,
                            'contact user fullname'
                        ),
                    ]
                ),
                'contact users'
            ),
            'enrollmentmethods' => new external_multiple_structure(
                new external_value(
                    PARAM_PLUGIN,
                    'enrollment method'
                ),
                'enrollment methods list'
            ),
        ];

        if (!$onlypublicdata) {
            $extra = [
                'idnumber' => new external_value(
                    PARAM_RAW,
                    'Id number',
                    VALUE_OPTIONAL
                ),
                'format' => new external_value(
                    PARAM_PLUGIN,
                    'Course format: weeks, topics, social, site,..',
                    VALUE_OPTIONAL
                ),
                'showgrades' => new external_value(
                    PARAM_INT,
                    '1 if grades are shown, otherwise 0',
                    VALUE_OPTIONAL
                ),
                'newsitems' => new external_value(
                    PARAM_INT,
                    'Number of recent items appearing on the course page',
                    VALUE_OPTIONAL
                ),
                'startdate' => new external_value(
                    PARAM_INT,
                    'Timestamp when the course start',
                    VALUE_OPTIONAL
                ),
                'enddate' => new external_value(
                    PARAM_INT,
                    'Timestamp when the course end',
                    VALUE_OPTIONAL
                ),
                'maxbytes' => new external_value(
                    PARAM_INT,
                    'Largest size of file that can be uploaded into',
                    VALUE_OPTIONAL
                ),
                'showreports' => new external_value(
                    PARAM_INT,
                    'Are activity report shown (yes = 1, no =0)',
                    VALUE_OPTIONAL
                ),
                'visible' => new external_value(
                    PARAM_INT,
                    '1: available to student, 0:not available',
                    VALUE_OPTIONAL
                ),
                'groupmode' => new external_value(
                    PARAM_INT,
                    'no group, separate, visible',
                    VALUE_OPTIONAL
                ),
                'groupmodeforce' => new external_value(
                    PARAM_INT,
                    '1: yes, 0: no',
                    VALUE_OPTIONAL
                ),
                'defaultgroupingid' => new external_value(
                    PARAM_INT,
                    'default grouping id',
                    VALUE_OPTIONAL
                ),
                'enablecompletion' => new external_value(
                    PARAM_INT,
                    'Completion enabled? 1: yes 0: no',
                    VALUE_OPTIONAL
                ),
                'completionnotify' => new external_value(
                    PARAM_INT,
                    '1: yes 0: no',
                    VALUE_OPTIONAL
                ),
                'lang' => new external_value(
                    PARAM_SAFEDIR,
                    'Forced course language',
                    VALUE_OPTIONAL
                ),
                'theme' => new external_value(
                    PARAM_PLUGIN,
                    'Fame of the forced theme',
                    VALUE_OPTIONAL
                ),
                'marker' => new external_value(
                    PARAM_INT,
                    'Current course marker',
                    VALUE_OPTIONAL
                ),
                'legacyfiles' => new external_value(
                    PARAM_INT,
                    'If legacy files are enabled',
                    VALUE_OPTIONAL
                ),
                'calendartype' => new external_value(
                    PARAM_PLUGIN,
                    'Calendar type',
                    VALUE_OPTIONAL
                ),
                'timecreated' => new external_value(
                    PARAM_INT,
                    'Time when the course was created',
                    VALUE_OPTIONAL
                ),
                'timemodified' => new external_value(
                    PARAM_INT,
                    'Last time  the course was updated',
                    VALUE_OPTIONAL
                ),
                'requested' => new external_value(
                    PARAM_INT,
                    'If is a requested course',
                    VALUE_OPTIONAL
                ),
                'cacherev' => new external_value(
                    PARAM_INT,
                    'Cache revision number',
                    VALUE_OPTIONAL
                ),
                'filters' => new external_multiple_structure(
                    new external_single_structure(
                        [
                            'filter' => new external_value(
                                PARAM_PLUGIN,
                                'Filter plugin name'
                            ),
                            'localstate' => new external_value(
                                PARAM_INT,
                                'Filter state: 1 for on, -1 for off, 0 if inherit'
                            ),
                            'inheritedstate' => new external_value(
                                PARAM_INT,
                                '1 or 0 to use when localstate is set to inherit'
                            ),
                        ]
                    ),
                    'Course filters',
                    VALUE_OPTIONAL
                ),
                'courseformatoptions' => new external_multiple_structure(
                    new external_single_structure(
                        [
                            'name' => new external_value(
                                PARAM_RAW,
                                'Course format option name.'
                            ),
                            'value' => new external_value(
                                PARAM_RAW,
                                'Course format option value.'
                            ),
                        ]
                    ),
                    'Additional options for particular course format.',
                    VALUE_OPTIONAL
                ),
            ];
            $coursestructure = array_merge(
                $coursestructure,
                $extra
            );
        }
        return new external_single_structure($coursestructure);
    }

    /**
     * Search courses following the specified criteria.
     *
     * @param string $criterianame Criteria name (search, modulelist (only admins), blocklist (only admins),
     *                                     tagid)
     * @param string $criteriavalue Criteria value
     * @param int $page Page number (for pagination)
     * @param int $perpage Items per page
     * @param array $requiredcapabilities Optional list of required capabilities (used to filter the list).
     * @param int $limittoenrolled Limit to only enrolled courses
     *
     * @return array of course objects and warnings
     */
    public function execute(
        string $criterianame,
        string $criteriavalue,
        int $page = 0,
        int $perpage = 0,
        array $requiredcapabilities = [],
        int $limittoenrolled = 0): array {
        global $USER, $DB;
        $warnings = [];

        $parameters = [
            'criterianame' => $criterianame,
            'criteriavalue' => $criteriavalue,
            'page' => $page,
            'perpage' => $perpage,
            'requiredcapabilities' => $requiredcapabilities
        ];
        $params = self::validate_parameters(
            self::execute_parameters(),
            $parameters
        );

        $allowedcriterianames = [
            'search',
            'modulelist',
            'blocklist',
            'tagid'
        ];
        if (!in_array(
            $params['criterianame'],
            $allowedcriterianames
        )) {
            throw new invalid_parameter_exception(
                'Invalid value for criterianame parameter (value: ' . $params['criterianame'] . '),' . 'allowed values are: ' .
                implode(
                    ',',
                    $allowedcriterianames
                )
            );
        }

        if ($params['criterianame'] == 'modulelist' or $params['criterianame'] == 'blocklist') {
            require_capability(
                'moodle/site:config',
                context_system::instance()
            );
        }

        $paramtype = [
            'search' => PARAM_RAW,
            'modulelist' => PARAM_PLUGIN,
            'blocklist' => PARAM_INT,
            'tagid' => PARAM_INT
        ];
        $params['criteriavalue'] = clean_param(
            $params['criteriavalue'],
            $paramtype[$params['criterianame']]
        );

        // Prepare the search API options.
        $searchcriteria = [];
        $searchcriteria[$params['criterianame']] = $params['criteriavalue'];

        $options = [];
        if ($params['perpage'] != 0) {
            $offset = $params['page'] * $params['perpage'];
            $options = [
                'offset' => $offset,
                'limit' => $params['perpage']
            ];
        }

        // Search the courses.
        $courses = core_course_category::search_courses(
            $searchcriteria,
            $options,
            $params['requiredcapabilities']
        );
        $totalcount = core_course_category::search_courses_count(
            $searchcriteria,
            $options,
            $params['requiredcapabilities']
        );

        if (!empty($limittoenrolled)) {
            // Get the courses where the current user has access.
            $enrolled = enrol_get_my_courses(
                [
                    'id',
                    'cacherev'
                ]
            );
        }

        $finalcourses = [];

        foreach ($courses as $course) {
            $coursecontext = context_course::instance($course->id);
            $neverhidden = false;
            $neverhiddenpaypal = false;
            $enrolmethod = enrol_get_instances(
                $course->id,
                true
            );
            foreach ($enrolmethod as $enrol) {
                if ($enrol->enrol == 'synopsis') {
                    $neverhidden = true;
                    break;
                }
                if ($enrol->enrol == 'synopsispaypal') {
                    $neverhiddenpaypal = true;
                    break;
                }
            }

            $categoryvisible = $DB->get_field(
                'course_categories',
                'visible',
                ['id' => $course->category]
            );
            if ((theme_config::load(
                        'pimenko'
                    )->settings->viewallhiddencourses == 1 && ($neverhidden || $neverhiddenpaypal) &&
                    $categoryvisible == 1) || ($course->visible == 1 && $categoryvisible == 1) || is_enrolled(
                    $coursecontext,
                    $USER
                ) || is_siteadmin($USER)) {
                if (!empty($limittoenrolled)) {
                    // Filter out not enrolled courses.
                    if (!isset($enrolled[$course->id])) {
                        $totalcount--;
                        continue;
                    }
                }
                $finalcourses[] = self::get_course_public_information(
                    $course,
                    $coursecontext
                );
            }
        }

        return [
            'total' => $totalcount,
            'courses' => $finalcourses,
            'warnings' => $warnings
        ];
    }

    /**
     * Return the course information that is public (visible by every one)
     *
     * @param core_course_list_element $course course in list object
     * @param context_course $coursecontext course context object
     *
     * @return array the course information
     * @since  Moodle 3.2
     * @throws coding_exception
     * @throws moodle_exception
     */
    private static function get_course_public_information(core_course_list_element $course, context_course $coursecontext): array {

        static $categoriescache = [];

        // Category information.
        if (!array_key_exists(
            $course->category,
            $categoriescache
        )) {
            $categoriescache[$course->category] = core_course_category::get(
                $course->category,
                IGNORE_MISSING
            );
        }
        $category = $categoriescache[$course->category];

        // Retrieve course overview used files.
        $files = [];
        foreach ($course->get_course_overviewfiles() as $file) {
            $fileurl = moodle_url::make_webservice_pluginfile_url(
                $file->get_contextid(),
                $file->get_component(),
                $file->get_filearea(),
                null,
                $file->get_filepath(),
                $file->get_filename()
            )->out(false);
            $files[] = [
                'filename' => $file->get_filename(),
                'fileurl' => $fileurl,
                'filesize' => $file->get_filesize(),
                'filepath' => $file->get_filepath(),
                'mimetype' => $file->get_mimetype(),
                'timemodified' => $file->get_timemodified(),
            ];
        }

        // Retrieve the course contacts,
        // we need here the users fullname since if we are not enrolled can be difficult to obtain them via other Web Services.
        $coursecontacts = [];
        foreach ($course->get_course_contacts() as $contact) {
            $coursecontacts[] = [
                'id' => $contact['user']->id,
                'fullname' => $contact['username'],
                'roles' => array_map(
                    function($role) {
                        return [
                            'id' => $role->id,
                            'name' => $role->displayname
                        ];
                    },
                    $contact['roles']
                ),
                'role' => [
                    'id' => $contact['role']->id,
                    'name' => $contact['role']->displayname
                ],
                'rolename' => $contact['rolename']
            ];
        }

        // Allowed enrolment methods (maybe we can self-enrol).
        $enroltypes = [];
        $instances = enrol_get_instances(
            $course->id,
            true
        );
        foreach ($instances as $instance) {
            $enroltypes[] = $instance->enrol;
        }

        // Format summary.
        list(
            $summary, $summaryformat
            ) = external_format_text(
            $course->summary,
            $course->summaryformat,
            $coursecontext->id,
            'course',
            'summary',
            null
        );

        $categoryname = '';
        if (!empty($category)) {
            $categoryname = external_format_string(
                $category->get_formatted_name(),
                $category->get_context()
            );
        }

        $displayname = get_course_display_name_for_list($course);
        $coursereturns = [];
        $coursereturns['id'] = $course->id;
        $coursereturns['fullname'] = format_string(
            $course->fullname,
            true,
            array('context' => context_course::instance($course->id))
        );
        $coursereturns['displayname'] = format_string(
            $displayname,
            true,
            array('context' => context_course::instance($course->id))
        );
        $coursereturns['shortname'] = format_string(
            $course->shortname,
            true,
            array('context' => context_course::instance($course->id))
        );
        $coursereturns['categoryid'] = $course->category;
        $coursereturns['categoryname'] = $categoryname;
        $coursereturns['summary'] = $summary;
        $coursereturns['summaryformat'] = $summaryformat;
        $coursereturns['summaryfiles'] = external_util::get_area_files(
            $coursecontext->id,
            'course',
            'summary',
            false,
            false
        );
        $coursereturns['overviewfiles'] = $files;
        $coursereturns['contacts'] = $coursecontacts;
        $coursereturns['enrollmentmethods'] = $enroltypes;
        $coursereturns['sortorder'] = $course->sortorder;
        return $coursereturns;
    }

}
