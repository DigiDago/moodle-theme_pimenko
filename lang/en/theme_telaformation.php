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
 * Theme Telaformation lang file.
 *
 * @package    theme_telaformation
 * @copyright  Tela Botanica 2020
 * @author     Sylvain Revenu - Pimenko 2020 <contact@pimenko.com> <pimenko.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
// This is the EN Lang package
defined('MOODLE_INTERNAL') || die();

// A description shown in the admin theme selector.
$string['choosereadme'] = 'Theme telaformation is a child theme of Boost. It adds some new features';
// The name of our plugin.
$string['pluginname'] = 'Telaformation';
// The name of the second tab in the theme settings.
$string['advancedsettings'] = 'Advanced settings';
// The brand colour setting.
$string['brandcolor'] = 'Brand colour';
// The brand colour setting description.
$string['brandcolor_desc'] = 'The accent colour.';
// Name of the settings pages.
$string['configtitle'] = 'Telaformation settings';
// Name of the first settings tab.
$string['generalsettings'] = 'General settings';
// Preset files setting.
$string['presetfiles'] = 'Additional theme preset files';
// Preset files help text.
$string['presetfiles_desc'] =
        'Preset files can be used to dramatically alter the appearance of the theme. See <a href=https://docs.moodle.org/dev/Boost_Presets>Boost presets</a> for information on creating and sharing your own preset files, and see the <a href=http://moodle.net/boost>Presets repository</a> for presets that others have shared.';
// Preset setting.
$string['preset'] = 'Theme preset';
// Preset help text.
$string['preset_desc'] = 'Pick a preset to broadly change the look of the theme.';
// Raw SCSS setting.
$string['rawscss'] = 'Raw SCSS';
// Raw SCSS setting help text.
$string['rawscss_desc'] = 'Use this field to provide SCSS or CSS code which will be injected at the end of the style sheet.';
// Raw initial SCSS setting.
$string['rawscsspre'] = 'Raw initial SCSS';
// Raw initial SCSS setting help text.
$string['rawscsspre_desc'] =
        'In this field you can provide initialising SCSS code, it will be injected before everything else. Most of the time you will use this setting to define variables.';
// We need to include a lang string for each block region.
$string['region-side-pre'] = 'Right';

// Login page traduction
$string['loginsettings'] = 'Login page settings';
$string['logintextboxtop'] = 'Top text box';
$string['logintextboxtopdesc'] = 'Add a custom text above the login box.';

// Favicon *******************************************************.

$string['favicon'] = 'Favicon';
$string['favicondesc'] = 'Add a favicon';

// Site logo *******************************************************.

$string['sitelogo'] = 'Site logo';
$string['sitelogodesc'] = 'Add a logo for ur site';

// Navbar *******************************************************.
$string['navbarsettings'] = 'Navbar';
$string['navbarcolor'] = 'Navbar color';
$string['navbarcolordesc'] = 'Add a background color to your navbar';
$string['navbartextcolor'] = 'Navbar text color';
$string['navbartextcolordesc'] = 'Add a text color to your navbar';

// Profile page.
$string['profile:joinedon'] = 'Joined on ';
$string['profile:lastaccess'] = 'Last access ';
$string['profile:basicinfo'] = 'Basic Information';
$string['profile:contactinfo'] = 'Contact Information';

// Login *******************************************************.
$string['loginsettings'] = 'Login Page';
$string['loginsettingsheading'] = 'Customize the login page';
$string['logindesc'] = 'Customize the login page with adding an image background and texts above and below the login box.';
$string['loginsettingsheading'] = 'Customize the login page.';
$string['loginbgimage'] = 'Background image';
$string['loginbgimagedesc'] = 'Add a background image to the full size page.';
$string['loginbgstyle'] = 'Login background style';
$string['loginbgstyledesc'] = 'Select the style for the uploaded image.';
$string['loginbgopacity'] = 'Login page header, navbar, login box and footer background opacity when there is a background image';
$string['loginbgopacitydesc'] =
        'Login background opacity for the header, navbar, login box and footer when there is a background image.';
$string['logintextboxtop'] = 'Top text box';
$string['logintextboxtopdesc'] = 'Add a custom text above the login box.';
$string['logintextboxbottom'] = 'Bottom text box';
$string['logintextboxbottomdesc'] = 'Add a custom text below the login box.';

// Footer *******************************************************.
$string['footersettings'] = 'Footer';
$string['settings:footer:footercolumn'] = 'Footer column {$a}';
$string['settings:footer:footerheading'] = 'Footer heading {$a}';
$string['settings:footer:footertext'] = 'Footer text {$a}';
$string['settings:footer:footerheadingdesc'] = 'h3 header for column';
$string['settings:footer:footertextdesc'] = 'Add content for the footer.';
$string['settings:footer:footercolumndesc'] = '';
$string['footercolor'] = 'Footer color';
$string['footercolordesc'] = 'Add a background color to your footer';
$string['footertextcolor'] = 'Footer text color';
$string['footertextcolordesc'] = 'Add a text color to your footer';

$string['stylecover'] = 'Cover';
$string['stylestretch'] = 'Stretch';

$string['hide'] = 'Hide';
$string['show'] = 'Show';

//Completion.
$string['completion-alt-manual-n'] = 'Not complete';
$string['completion-alt-manual-n-override'] = 'Not complete';
$string['completion-alt-manual-y'] = 'Not complete';
$string['completion-alt-manual-y-override'] = 'Not complete';
$string['completion-alt-auto-n'] = 'Not complete';
$string['completion-alt-auto-n-override'] = 'Not complete';
$string['completion-alt-auto-y'] = 'Not complete';
$string['completion-alt-auto-y-override'] = 'Not complete';
$string['completion-tooltip-manual-n'] = 'Click to mark as complete';
$string['completion-tooltip-manual-n-override'] = 'Click to mark as complete';
$string['completion-tooltip-manual-y'] = 'Click to mark as not complete';
$string['completion-tooltip-manual-y-override'] = 'Click to mark as not complete';
$string['completion-tooltip-auto-n'] = 'Automatic completion';
$string['completion-tooltip-auto-n-override'] = 'Automatic completion';
$string['completion-tooltip-auto-y'] = 'Automatic completion';
$string['completion-tooltip-auto-y-override'] = 'Automatic completion';
$string['completion-tooltip-auto-pass'] = 'Automatic completion';
$string['completion-tooltip-auto-enabled'] = 'The system marks this item complete';
$string['completion-tooltip-manual-enabled'] = 'Students can manually mark this item complete';
$string['completion-alt-auto-enabled'] = 'The system marks this item complete';
$string['completion-alt-manual-enabled'] = 'Students can manually mark this item complete';

// Catalog
$string['viewcat'] = 'View cat';

// Block Regions.
$string['settings:regions:title'] = 'Frontpage Block Settings';
$string['settings:regions:frontpageblocksettingscription'] = '';
$string['settings:regions:frontpageblocksettingscriptiondesc'] =
        'On this page you can determine the composition of the homepage, which can be divided into 8 lines. For each line, you can determine the color and if it should be composed of one or more columns. Important : after making the changes, go to the homepage of your site to add content using blocks. You can find the homepage here : <a href= ' .
        new moodle_url(
                $CFG->wwwroot . '/?redirect=0'
        ) . '>Homepage</a>.';
$string['settings:regions:blockrow'] = 'Block Region Row {$a}';
$string['settings:regions:blockrowdesc'] = 'Add / set layout for block region row on front page.';

// Block Regions colors.
$string['settings:regions:blockregionrowbackgroundcolor'] = 'Row {$a} color';
$string['settings:regions:blockregionrowbackgroundcolordesc'] = 'Add / set a color for the block region row on front page.';
$string['settings:regions:blockregionrowtextcolor'] = 'Row {$a} text color';
$string['settings:regions:blockregionrowtextcolordesc'] = 'Add / set a text color for the block region row on front page.';
$string['settings:regions:blockregionrowlinkcolor'] = 'Row {$a} link color';
$string['settings:regions:blockregionrowlinkcolordesc'] = 'Add / set a link color for the block region row on front page.';
$string['settings:regions:blockregionrowlinkhovercolor'] = 'Row {$a} link hover color';
$string['settings:regions:blockregionrowlinkhovercolordesc'] =
        'Add / set a link hover color for the block region row on front page.';

// Slide.
$string['settings:regions:enablecarousel'] = 'Enable carousel';
$string['settings:regions:enablecarouseldesc'] = 'Allows to display or not the carousel';
$string['settings:regions:slideimagenr'] = 'Number of slides';
$string['settings:regions:slideimagenrdesc'] = '';
$string['settings:regions:slideimage'] = 'Slide image {$a}';
$string['settings:regions:slideimagedesc'] = '';
$string['settings:regions:slidecaption'] = 'Slide caption {$a}';
$string['settings:regions:slidecaptiondesc'] = '';

// Fonts.
$string['settings:font:googlefont'] = 'Google font';
$string['settings:font:googlefontdesc'] = 'Please refer to the page: https://fonts.google.com/ to find your typography';
