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
 * Theme pimenko renderers file.
 *
 * @package    theme_pimenko
 * @copyright  Pimenko 2019
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class theme_pimenko_simple_theme_settings {
    /**
     * @var mixed
     */
    private $settingspage;
    /**
     * @var string|null
     */
    private $strprefix;
    /**
     * @var string
     */
    private $themename;

    /**
     * Constructor for initializing the class with provided settings.
     *
     * @param mixed       $settingspage The settings page object or identifier.
     * @param string      $themename The name of the theme.
     * @param string|null $strprefix Optional string prefix, default is null.
     *
     * @return void
     */
    public function __construct(
        $settingspage,
        $themename,
        $strprefix = null,
    ) {
        $this->themename = $themename;
        $this->settingspage = $settingspage;
        $this->strprefix = $strprefix;
    }

    /**
     * Generates a name string for a given setting with an optional suffix.
     *
     * @param string $setting The base name or key of the setting.
     * @param string $suffix An optional suffix to append to the setting name, default is an empty string.
     *
     * @return string The generated name combining the theme name, setting, and suffix.
     */
    private function name_for(
        $setting,
        $suffix = '',
    ) {
        return $this->themename . '/' . $setting . $suffix;
    }

    /**
     * Generates a title string based on the given setting and additional parameters.
     *
     * @param string     $setting The base setting key used to retrieve the title string.
     * @param mixed|null $additional Optional additional data to be included in the title string.
     * @return string The generated title string.
     */
    private function title_for(
        $setting,
        $additional = null
    ) {
        return get_string(
            $this->strprefix . $setting,
            $this->themename,
            $additional,
        );
    }

    /**
     * Retrieves the description string corresponding to the given setting.
     *
     * @param string $setting The base setting key used to retrieve the description string.
     * @return string The retrieved description string.
     */
    private function description_for($setting) {
        return get_string(
            $this->strprefix . $setting . 'desc',
            $this->themename,
        );
    }

    /**
     * Adds a configuration checkbox to the settings page.
     *
     * @param string $setting The unique key for the setting.
     * @param int    $default The default value of the checkbox (0 for unchecked, 1 for checked).
     * @param int    $checked The value to store when the checkbox is checked.
     * @param int    $unchecked The value to store when the checkbox is unchecked.
     * @return void
     */
    public function add_checkbox(
        $setting,
        $default = 0,
        $checked = 1,
        $unchecked = 0
    ) {
        $checkbox = new admin_setting_configcheckbox(
            $this->name_for($setting),
            $this->title_for($setting),
            $this->description_for($setting),
            $default,
            $checked,
            $unchecked,
        );
        $checkbox->set_updatedcallback('theme_reset_all_caches');
        $this->settingspage->add($checkbox);
    }

    /**
     * Adds a checkbox setting to the settings page with specified parameters.
     *
     * @param string $setting The base setting key used to create the checkbox identifier.
     * @param mixed  $instance The specific instance or identifier to append to the setting key.
     * @param int    $default The default state of the checkbox (0 for unchecked, 1 for checked).
     * @param int    $checked The value representing the checkbox when it is checked.
     * @param int    $unchecked The value representing the checkbox when it is unchecked.
     * @return void
     */
    public function add_checkboxes(
        $setting,
        $instance,
        $default = 0,
        $checked = 1,
        $unchecked = 0
    ) {
        $checkbox = new admin_setting_configcheckbox(
            $this->name_for($setting . $instance),
            $this->title_for(
                $setting,
                $instance,
            ),
            $this->description_for($setting),
            $default,
            $checked,
            $unchecked,
        );
        $checkbox->set_updatedcallback('theme_reset_all_caches');
        $this->settingspage->add($checkbox);
    }

    /**
     * Adds a text input setting to the settings page.
     *
     * @param string $setting The unique key representing the setting to be added.
     * @param string $default Optional default value for the text input setting.
     * @return void
     */
    public function add_text(
        $setting,
        $default = ''
    ) {
        $text = new admin_setting_configtext(
            $this->name_for($setting),
            $this->title_for($setting),
            $this->description_for($setting),
            $default,
        );
        $text->set_updatedcallback('theme_reset_all_caches');
        $this->settingspage->add($text);
    }

    /**
     * Adds a configurable text input field to the settings page.
     *
     * @param string $setting The base key used to identify the setting.
     * @param string $instance A specific instance identifier to differentiate the setting.
     * @param string $default Optional default value for the text input field. Defaults to an empty string.
     * @return void
     */
    public function add_texts(
        $setting,
        $instance,
        $default = ''
    ) {
        $text = new admin_setting_configtext(
            $this->name_for($setting . $instance),
            $this->title_for(
                $setting,
                $instance,
            ),
            $this->description_for($setting),
            $default,
        );
        $text->set_updatedcallback('theme_reset_all_caches');
        $this->settingspage->add($text);
    }

    /**
     * Adds a heading setting to the settings page.
     *
     * @param string $setting The key used for generating the name, title, and description of the heading.
     * @return void
     */
    public function add_heading($setting) {
        $heading = new admin_setting_heading(
            $this->name_for($setting),
            $this->title_for($setting),
            $this->description_for($setting),
        );
        $this->settingspage->add($heading);
    }

    /**
     * Adds a heading to the settings page based on the provided setting and instance.
     *
     * @param string $setting The setting key used to create the heading.
     * @param mixed  $instance The specific instance related to the setting.
     * @return void
     */
    public function add_headings(
        $setting,
        $instance
    ) {
        $heading = new admin_setting_heading(
            $this->name_for($setting . $instance),
            $this->title_for(
                $setting,
                $instance,
            ),
            $this->description_for($setting),
        );
        $this->settingspage->add($heading);
    }

    /**
     * Adds a select setting to the settings page with specified options.
     *
     * @param string $setting The identifier for the setting to be added.
     * @param mixed  $default The default value for the select setting.
     * @param array  $options The list of available options for the select setting,
     * where the keys are option values and the values are labels.
     * @return void
     */
    public function add_select(
        $setting,
        $default,
        $options
    ) {
        $select = new admin_setting_configselect(
            $this->name_for($setting),
            $this->title_for($setting),
            $this->description_for($setting),
            $default,
            $options,
        );
        $select->set_updatedcallback('theme_reset_all_caches');
        $this->settingspage->add($select);
    }

    /**
     * Adds a select dropdown element to the settings page with specified parameters.
     *
     * @param string $setting The base setting key for the select element.
     * @param mixed  $default The default value to be pre-selected in the dropdown.
     * @param array  $options An associative array of key-value pairs representing the options for the dropdown.
     * @param mixed  $instance A unique instance identifier for the select element.
     * @return void
     */
    public function add_selects(
        $setting,
        $default,
        $options,
        $instance
    ) {
        $select = new admin_setting_configselect(
            $this->name_for($setting . $instance),
            $this->title_for(
                $setting,
                $instance,
            ),
            $this->description_for($setting),
            $default,
            $options,
        );
        $select->set_updatedcallback('theme_reset_all_caches');
        $this->settingspage->add($select);
    }

    /**
     * Adds a textarea setting to the settings page.
     *
     * @param string $setting The unique identifier for the setting.
     * @param string $default Optional default value for the textarea setting. Defaults to an empty string.
     * @return void
     */
    public function add_textarea(
        $setting,
        $default = ''
    ) {
        $textarea = new admin_setting_configtextarea(
            $this->name_for($setting),
            $this->title_for($setting),
            $this->description_for($setting),
            $default,
        );
        $textarea->set_updatedcallback('theme_reset_all_caches');
        $this->settingspage->add($textarea);
    }

    /**
     * Adds a textarea configuration setting to the settings page.
     *
     * @param string $setting The base name of the setting.
     * @param string $instance The specific instance identifier for the setting.
     * @param string $default Optional default value for the textarea setting.
     * @return void
     */
    public function add_textareas(
        $setting,
        $instance,
        $default = ''
    ) {
        $textarea = new admin_setting_configtextarea(
            $this->name_for($setting . $instance),
            $this->title_for(
                $setting,
                $instance,
            ),
            $this->description_for($setting),
            $default,
        );
        $textarea->set_updatedcallback('theme_reset_all_caches');
        $this->settingspage->add($textarea);
    }

    /**
     * Adds an HTML editor setting to the settings page.
     *
     * @param string $setting The name of the setting.
     * @param string $default The default value for the HTML editor setting. Defaults to an empty string.
     * @return void
     */
    public function add_htmleditor(
        $setting,
        $default = ''
    ) {
        $htmleditor = new theme_pimenko_admin_setting_confightmleditor(
            $this->name_for($setting),
            $this->title_for($setting),
            $this->description_for($setting),
            $default,
        );
        $htmleditor->set_updatedcallback('theme_reset_all_caches');
        $this->settingspage->add($htmleditor);
    }

    /**
     * Adds multiple HTML editor settings to the settings page.
     *
     * @param string $setting The base name of the setting.
     * @param string $instance A unique instance identifier to distinguish between multiple HTML editors.
     * @param string $default The default value for the HTML editor setting. Defaults to an empty string.
     * @return void
     */
    public function add_htmleditors(
        $setting,
        $instance,
        $default = ''
    ) {
        $htmleditor = new theme_pimenko_admin_setting_confightmleditor(
            $this->name_for($setting . $instance),
            $this->title_for(
                $setting,
                $instance,
            ),
            $this->description_for($setting),
            $default,
        );
        $htmleditor->set_updatedcallback('theme_reset_all_caches');
        $this->settingspage->add($htmleditor);
    }

    /**
     * Adds a super HTML editor setting to the settings page.
     *
     * @param string $setting The base name of the setting.
     * @param string $instance A unique identifier to distinguish the specific instance of the setting.
     * @param string $default The default value for the super HTML editor setting. Defaults to an empty string.
     * @return void
     */
    public function add_superhtmleditors(
        $setting,
        $instance,
        $default = ''
    ) {
        $htmleditor = new theme_pimenko_admin_setting_confightmleditor(
            $this->name_for($setting . $instance),
            $this->title_for(
                $setting,
                $instance,
            ),
            $this->description_for($setting),
            $default,
        );
        $htmleditor->set_updatedcallback('theme_reset_all_caches');
        $this->settingspage->add($htmleditor);
    }

    /**
     * Adds a color picker setting to the settings page.
     *
     * @param string $setting The name of the setting.
     * @param string $default The default value for the color picker, specified as a hex color code. Defaults to '#666'.
     * @return void
     */
    public function add_colourpicker(
        $setting,
        $default = '#666'
    ) {
        $colorpicker = new admin_setting_configcolourpicker(
            $this->name_for($setting),
            $this->title_for($setting),
            $this->description_for($setting),
            $default,
            null, // Don't hook up any javascript preview of color change.
        );
        $colorpicker->set_updatedcallback('theme_reset_all_caches');
        $this->settingspage->add($colorpicker);
    }

    /**
     * Adds a color picker setting to the settings page.
     *
     * @param string $setting The base name of the setting.
     * @param string $instance An identifier to differentiate multiple instances of the setting.
     * @param string $default The default value for the color picker. Defaults to an empty string.
     * @return void
     */
    public function add_colourpickers(
        $setting,
        $instance,
        $default = ''
    ) {
        $colorpicker = new admin_setting_configcolourpicker(
            $this->name_for($setting . $instance),
            $this->title_for(
                $setting,
                $instance,
            ),
            $this->description_for($setting),
            $default,
            null, // Don't hook up any javascript preview of color change.
        );
        $colorpicker->set_updatedcallback('theme_reset_all_caches');
        $this->settingspage->add($colorpicker);
    }

    /**
     * Adds a file upload setting to the settings page.
     *
     * @param string $setting The name of the setting, which should be unique.
     * @return void
     */
    public function add_file($setting) {
        $file = new admin_setting_configstoredfile(
            $this->name_for($setting),
            $this->title_for($setting),
            $this->description_for($setting),
            $setting,
        );
        $file->set_updatedcallback('theme_reset_all_caches');
        $this->settingspage->add($file);
    }

    /**
     * Adds a file setting to the settings page.
     *
     * @param string $setting The name of the setting.
     * @param string $instance A unique instance identifier for the setting.
     * @return void
     */
    public function add_files(
        $setting,
        $instance
    ) {
        $file = new admin_setting_configstoredfile(
            $this->name_for(
                $setting,
                $instance,
            ),
            $this->title_for(
                $setting,
                $instance,
            ),
            $this->description_for($setting),
            $setting . $instance,
        );
        $file->set_updatedcallback('theme_reset_all_caches');
        $this->settingspage->add($file);
    }

    /**
     * Adds multiple numbered textarea settings to the settings page.
     *
     * @param string $setting The base name of the setting.
     * @param int    $count The number of textarea settings to add.
     * @param string $default The default value for each textarea. Defaults to an empty string.
     * @return void
     */
    public function add_numbered_textareas(
        $setting,
        $count,
        $default = ''
    ) {
        for ($i = 1; $i <= $count; $i++) {
            $textarea = new admin_setting_configtextarea(
                $this->name_for(
                    $setting,
                    $i,
                ),
                $this->title_for(
                    $setting,
                    $i,
                ),
                $this->description_for($setting),
                $default,
            );
            $textarea->set_updatedcallback('theme_reset_all_caches');
            $this->settingspage->add($textarea);
        }
    }
}
