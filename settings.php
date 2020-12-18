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
 * Theme Telaformation settings file.
 *
 * @package    theme_telaformation
 * @copyright  Tela Botanica 2020
 * @author     Sylvain Revenu - Pimenko 2020 <contact@pimenko.com> <pimenko.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/libs/admin_setting_confightmleditor.php');
require_once(__DIR__ . "/libs/simple_theme_settings.php");

// This is used for performance, we don't need to know about these settings on every page in Moodle, only when
// we are looking at the admin settings pages.
/** @var admin_root $ADMIN */
if ($ADMIN->fulltree) {

    // Boost provides a nice setting page which splits settings onto separate tabs. We want to use it here.
    $settings =
            new theme_boost_admin_settingspage_tabs('themesettingtelaformation', get_string('configtitle', 'theme_telaformation'));

    // Each page is a tab - the first is the "General" tab.
    $page = new admin_settingpage('theme_telaformation_general', get_string('generalsettings', 'theme_telaformation'));

    // Replicate the preset setting from boost.
    $name = 'theme_telaformation/preset';
    $title = get_string('preset', 'theme_telaformation');
    $description = get_string('preset_desc', 'theme_telaformation');
    $default = 'default.scss';

    // We list files in our own file area to add to the drop down. We will provide our own function to
    // load all the presets from the correct paths.
    $context = context_system::instance();
    $fs = get_file_storage();
    $files = $fs->get_area_files($context->id, 'theme_telaformation', 'preset', 0, 'itemid, filepath, filename', false);

    $choices = [];
    foreach ($files as $file) {
        $choices[$file->get_filename()] = $file->get_filename();
    }
    // These are the built in presets from Boost.
    $choices['default.scss'] = 'default.scss';
    $choices['plain.scss'] = 'plain.scss';

    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Preset files setting.
    $name = 'theme_telaformation/presetfiles';
    $title = get_string('presetfiles', 'theme_telaformation');
    $description = get_string('presetfiles_desc', 'theme_telaformation');

    $setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0,
            array('maxfiles' => 20, 'accepted_types' => array('.scss')));
    $page->add($setting);

    // Variable $brand-color.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_telaformation/brandcolor';
    $title = get_string('brandcolor', 'theme_telaformation');
    $description = get_string('brandcolor_desc', 'theme_telaformation');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Default color for button.
    $name = 'theme_telaformation/brandcolorbutton';
    $title = get_string('brandcolorbutton', 'theme_telaformation');
    $description = get_string('brandcolorbuttondesc', 'theme_telaformation');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Default text color for button.
    $name = 'theme_telaformation/brandcolortextbutton';
    $title = get_string('brandcolortextbutton', 'theme_telaformation');
    $description = get_string('brandcolortextbuttondesc', 'theme_telaformation');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Site Favicon.
    $name = 'theme_telaformation/favicon';
    $title = get_string('favicon', 'theme_telaformation');
    $description = get_string('favicondesc', 'theme_telaformation');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'favicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new simple_theme_settings(
            $page,
            'theme_telaformation',
            'settings:font:'
    );
    $setting->add_text(
            'googlefont',
            'Verdana'
    );

    // Must add the page after definiting all the settings!
    $settings->add($page);

    // Advanced settings.
    $page = new admin_settingpage('theme_telaformation_advanced', get_string('advancedsettings', 'theme_telaformation'));

    // Raw SCSS to include before the content.
    $setting = new admin_setting_configtextarea('theme_telaformation/scsspre',
            get_string('rawscsspre', 'theme_telaformation'), get_string('rawscsspre_desc', 'theme_telaformation'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Raw SCSS to include after the content.
    $setting = new admin_setting_configtextarea('theme_telaformation/scss', get_string('rawscss', 'theme_telaformation'),
            get_string('rawscss_desc', 'theme_telaformation'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    // Login settings.
    include_once(dirname(__FILE__) . '/settings/frontpage.php');
    include_once(dirname(__FILE__) . '/settings/login.php');
    include_once(dirname(__FILE__) . '/settings/navbar.php');
    include_once(dirname(__FILE__) . '/settings/footer.php');
}