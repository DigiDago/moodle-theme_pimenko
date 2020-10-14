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
 * Theme Telaformation settings file.
 * @package    theme_telaformation
 * @copyright  Tela Botanica 2020
 * @author     Sylvain Revenu - Pimenko 2020
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Every file should have GPL and copyright in the header - we skip it in tutorials but you should not skip it for real.
// This line protects the file from being accessed by a URL directly.
// This is the FR Lang package
defined('MOODLE_INTERNAL') || die();

// A description shown in the admin theme selector.
$string['choosereadme'] = 'Le thème de la téléformation est un thème enfant de Boost. Il ajoute quelques nouvelles fonctionnalités';
// The name of our plugin.
$string['pluginname'] = 'Telaformation';
// The name of the second tab in the theme settings.
$string['advancedsettings'] = 'Options avancées';
// The brand colour setting.
$string['brandcolor'] = 'Couleur générale';
// The brand colour setting description.
$string['brandcolor_desc'] = 'Défini la couleur principale du site ( pour les liens ... )';
// Name of the settings pages.
$string['configtitle'] = 'Options Telaformation';
// Name of the first settings tab.
$string['generalsettings'] = 'Options générales';
// Preset files setting.
$string['presetfiles'] = 'Fichier de préréglages du thème';
// Preset files help text.
$string['presetfiles_desc'] = 'Les fichiers prédéfinis peuvent être utilisés pour modifier radicalement l\'apparence du thème. Voir <a href=https://docs.moodle.org/dev/Boost_Presets>Préréglages Boost</a> pour plus d\'informations sur la création et le partage de vos propres fichiers prédéfinis, et consultez le <a href=http://moodle.net/boost>Dépôt de préréglages</a> pour les préréglages que d\'autres ont partagés.';
// Preset setting.
$string['preset'] = 'Préréglages du thème';
// Preset help text.
$string['preset_desc'] = 'Choisissez un préréglage pour modifier globalement l\'apparence du thème.';
// Raw SCSS setting.
$string['rawscss'] = 'SCSS brut';
// Raw SCSS setting help text.
$string['rawscss_desc'] = 'Utilisez ce champ pour fournir du code SCSS ou CSS qui sera injecté à la fin de la feuille de style.';
// Raw initial SCSS setting.
$string['rawscsspre'] = 'SCSS initial brut';
// Raw initial SCSS setting help text.
$string['rawscsspre_desc'] = 'Dans ce champ, vous pouvez fournir le code SCSS d\'initialisation, il sera injecté avant tout le reste. La plupart du temps, vous utiliserez ce paramètre pour définir des variables.';
// We need to include a lang string for each block region.
$string['region-side-pre'] = 'Droite';