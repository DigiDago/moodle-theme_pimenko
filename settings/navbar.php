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
 * Theme Telaformation settings navbar file.
 *
 * @package    theme_telaformation
 * @copyright  Tela Botanica 2020
 * @author     Sylvain Revenu - Pimenko 2020 <contact@pimenko.com> <pimenko.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$page = new admin_settingpage('theme_telaformation_navbar',
        get_string('navbarsettings', 'theme_telaformation'));

// Site logo.
$name = 'theme_telaformation/sitelogo';
$title = get_string('sitelogo', 'theme_telaformation');
$description = get_string('sitelogodesc', 'theme_telaformation');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'sitelogo');
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Navbar color.
$name          = 'theme_telaformation/navbarcolor';
$title         = get_string(
        'navbarcolor',
        'theme_telaformation'
);
$description   = get_string(
        'navbarcolordesc',
        'theme_telaformation'
);
$previewconfig = null;
$setting       = new admin_setting_configcolourpicker(
        $name,
        $title,
        $description,
        '',
        $previewconfig
);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Navbar text color.

$name          = 'theme_telaformation/navbartextcolor';
$title         = get_string(
        'navbartextcolor',
        'theme_telaformation'
);
$description   = get_string(
        'navbartextcolordesc',
        'theme_telaformation'
);
$previewconfig = null;
$setting       = new admin_setting_configcolourpicker(
        $name,
        $title,
        $description,
        '',
        $previewconfig
);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$settings->add($page);