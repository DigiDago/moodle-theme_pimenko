<?php
// This file is part of the Pimenko theme for Moodle
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
 * Theme Pimenko lang file.
 *
 * @package    theme_pimenko
 * @copyright  Pimenko 2020
 * @author     Sylvain Revenu - Pimenko 2020 <contact@pimenko.com> <pimenko.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
// This is the FR Lang package.
defined('MOODLE_INTERNAL') || die();

// A description shown in the admin theme selector.
$string['choosereadme'] = 'Le thème Pimenko est un thème enfant de Boost. Il ajoute quelques nouvelles fonctionnalités';
// The name of our plugin.
$string['pluginname'] = 'Pimenko';
// The name of the second tab in the theme settings.
$string['advancedsettings'] = 'Réglages avancés';
// The brand color setting.
$string['brandcolor'] = 'Couleur générale';
// The brand color setting description.
$string['brandcolor_desc'] = 'Défini la couleur principale du site ( pour les liens ... )';
// The button brand color setting.
$string['brandcolorbutton'] = 'Couleur de base des boutons';
// The button brand color setting description.
$string['brandcolorbuttondesc'] = 'Défini une couleur de fond pour les boutons';
// The button brand color setting.
$string['brandcolortextbutton'] = 'Couleur générale du texte des boutons';
// The button brand color setting description.
$string['brandcolortextbuttondesc'] = 'Définir une couleur générale pour les textes des boutons';
// Name of the settings pages.
$string['configtitle'] = 'Options Pimenko';
// Name of the first settings tab.
$string['generalsettings'] = 'Réglages généraux';
// Preset files setting.
$string['presetfiles'] = 'Fichier de préréglages du thème';
// Preset files help text.
$string['presetfiles_desc'] =
    'Les fichiers prédéfinis peuvent être utilisés pour modifier radicalement l\'apparence du thème. Voir <a href=https://docs.moodle.org/dev/Boost_Presets>Préréglages Boost</a> pour plus d\'informations sur la création et le partage de vos propres fichiers prédéfinis, et consultez le <a href=http://moodle.net/boost>Dépôt de préréglages</a> pour les préréglages que d\'autres ont partagés.';
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
$string['rawscsspre_desc'] =
    'Dans ce champ, vous pouvez fournir le code SCSS d\'initialisation, il sera injecté avant tout le reste. La plupart du temps, vous utiliserez ce paramètre pour définir des variables.';
// We need to include a lang string for each block region.
$string['region-side-pre'] = 'Droite';

// Favicon *******************************************************.

$string['favicon'] = 'Favicon';
$string['favicondesc'] = 'Ajouter un favicon';

// Site logo *******************************************************.

$string['sitelogo'] = 'Logo du site';
$string['sitelogodesc'] = 'Ajouter un logo';

// Header picture *******************************************************.
$string['navbarpicture'] = 'Arrière-plan de la barre de navigation';
$string['navbarpicturedesc'] = 'Ajoutez une image de fond à barre de navigation, il vous faudra ensuite adapter le style à vôtre besoin. Vous pouvez cibler l\'élément ".withnavbarpicture"';

// Navbar *******************************************************.
$string['navbarsettings'] = 'Barre de navigation';
$string['navbarcolor'] = 'Couleur de la barre de navigation';
$string['navbarcolordesc'] = 'Couleur de fond de la barre de navigation';
$string['navbartextcolor'] = 'Couleur du texte pour la barre de navigation';
$string['navbartextcolordesc'] = 'Définir une couleur pour le texte de la barre de navigation';
$string['hoovernavbarcolor'] = 'Définir la couleur de surbrillance pour les liens dans la barre de navigation';
$string['hoovernavbarcolordesc'] = 'Couleur de surbrillance des liens dans la bare de navigation';

// Profile page.
$string['profile:joinedon'] = 'Inscrit le ';
$string['profile:lastaccess'] = 'Dernier accès ';
$string['profile:basicinfo'] = 'Informations générales';
$string['profile:contactinfo'] = 'Contact';

// Login *******************************************************.
$string['loginsettings'] = 'Paramètres de la page d\'authentification';
$string['loginsettingsheading'] = 'Personnalisez la page de connexion';
$string['logindesc'] =
    'Personnalisez la page de connexion en ajoutant un arrière-plan d\'image et des textes au-dessus et en dessous de la zone de connexion.';
$string['loginbgimage'] = 'Image en arrière plan';
$string['loginbgimagedesc'] = 'Ajoutez une image d\'arrière-plan à la page.';
$string['loginbgstyle'] = 'Style d\'arrière-plan de connexion';
$string['loginbgstyledesc'] = 'Sélectionnez le style de l\'image téléchargée.';
$string['loginbgopacity'] = 'Opacité de la zone de contenu';
$string['loginbgopacitydesc'] =
    'Opacité d\'arrière-plan de connexion pour l\'en-tête, la barre de navigation, la zone de connexion et le pied de page lorsqu\'il y a une image d\'arrière-plan.';
$string['logintextboxtop'] = 'Zone de contenu supérieur';
$string['logintextboxtopdesc'] = 'Ajoutez un texte personnalisé au-dessus de la zone de connexion.';
$string['logintextboxbottom'] = 'Zone de contenu inférieur';
$string['logintextboxbottomdesc'] = 'Ajoutez un texte personnalisé au-dessous de la zone de connexion.';

$string['stylecover'] = 'Cover';
$string['stylestretch'] = 'Stretch';

$string['hide'] = 'Cacher';
$string['show'] = 'Afficher';

// Footer *******************************************************.
$string['footersettings'] = 'Pied de page';
$string['settings:footer:footercolumn'] = 'Pied de page colonne {$a}';
$string['settings:footer:footerheading'] = 'Pied de page entête {$a}';
$string['settings:footer:footertext'] = 'Pied de page texte {$a}';
$string['settings:footer:footerheadingdesc'] = 'h3 de la colonne';
$string['settings:footer:footertextdesc'] = 'Ajouter du contenu pour le pied de page.';
$string['settings:footer:footercolumndesc'] = '';
$string['footercolor'] = 'Pied de page couleur';
$string['footercolordesc'] = 'Définir la couleur de fond pour le pied de page';
$string['footertextcolor'] = 'Pied de page couleur texte';
$string['footertextcolordesc'] = 'Définir la couleur pour le texte du pied de page';
$string['hooverfootercolor'] = 'Définir la couleur de surbrillance pour les liens en pied de page';
$string['hooverfootercolordesc'] = 'Pied de page couleur de surbrillance des liens';

// Completion.
$string['completion-alt-manual-n'] = 'Incomplet';
$string['completion-alt-manual-n-override'] = 'Incomplet';
$string['completion-alt-manual-y'] = 'Incomplet';
$string['completion-alt-manual-y-override'] = 'Incomplet';
$string['completion-alt-auto-n'] = 'Incomplet';
$string['completion-alt-auto-n-override'] = 'Incomplet';
$string['completion-alt-auto-y'] = 'Incomplet';
$string['completion-alt-auto-y-override'] = 'Incomplet';
$string['completion-tooltip-manual-n'] = 'Cliquez pour marquer comme terminé';
$string['completion-tooltip-manual-n-override'] = 'Cliquez pour marquer comme terminé';
$string['completion-tooltip-manual-y'] = 'Cliquez pour marquer comme non terminé';
$string['completion-tooltip-manual-y-override'] = 'Cliquez pour marquer comme non terminé';
$string['completion-tooltip-auto-n'] = 'Achèvement automatique';
$string['completion-tooltip-auto-n-override'] = 'Achèvement automatique';
$string['completion-tooltip-auto-y'] = 'Achèvement automatique';
$string['completion-tooltip-auto-y-override'] = 'Achèvement automatique';
$string['completion-tooltip-auto-pass'] = 'Achèvement automatique';
$string['completion-tooltip-auto-enabled'] = 'Le système marque cet élément comme terminé';
$string['completion-tooltip-manual-enabled'] = 'Les élèves peuvent marquer manuellement cet élément comme terminé';
$string['completion-alt-auto-enabled'] = 'Le système marque cet élément comme terminé';
$string['completion-alt-manual-enabled'] = 'Les élèves peuvent marquer manuellement cet élément comme terminé';

// Catalog.
$string['viewcat'] = 'Voir la catégorie';
$string['viewcourse'] = 'Voir le cours';
$string['nextmod'] = 'Activité suivante';

// Block Regions.
$string['frontpage'] = 'Paramètres de la page d\'accueil';
$string['settings:regions:frontpageblocksettingscription'] = '';
$string['settings:regions:frontpageblocksettingscriptiondesc'] =
    'Sur cette page, vous pouvez déterminer la composition de la page d\'accueil, qui peut être divisée en 8 lignes. Pour chaque ligne, vous pouvez déterminer la couleur et si elle doit être composée d\'une ou plusieurs colonnes. Important: après avoir effectué les modifications, rendez-vous sur la page d\'accueil de votre site pour ajouter du contenu à l\'aide de blocs. Vous pouvez trouver la page d\'accueil ici : <a href= ' .
    new moodle_url($CFG->wwwroot . '/?redirect=0') . '>Page d\'accueil</a>.';
$string['settings:regions:blockrow'] = 'Zone de contenu {$a}';
$string['settings:regions:blockrowdesc'] = 'Ajouter / définir la mise en page pour la zone de contenu sur la première page.';

// Block Regions colors.
$string['settings:regions:blockregionrowbackgroundcolor'] = 'Couleur de fond de la zone {$a}';
$string['settings:regions:blockregionrowbackgroundcolordesc'] =
    'Ajoutez / définissez une couleur de fond pour la zone de contenu sur la première page.';
$string['settings:regions:blockregionrowtextcolor'] = 'Couleur de texte de la zone {$a}';
$string['settings:regions:blockregionrowtextcolordesc'] =
    'Ajoutez / définissez une couleur de texte pour la zone de contenu sur la première page.';
$string['settings:regions:blockregionrowlinkcolor'] = 'Couleur des liens de la zone {$a}';
$string['settings:regions:blockregionrowlinkcolordesc'] =
    'Ajoutez / définissez une couleur pour les liens pour la zone de contenu sur la première page.';
$string['settings:regions:blockregionrowlinkhovercolor'] = 'Couleur des liens \'survoler\' de la zone {$a}';
$string['settings:regions:blockregionrowlinkhovercolordesc'] =
    'Ajoutez / définissez une couleur pour les liens \'survoler\' pour la zone de contenu sur la première page.';

// Slide.
$string['settings:frontslider:enablecarousel'] = 'Activer le carrousel';
$string['settings:frontslider:enablecarouseldesc'] = 'Permet d\'afficher ou non le carrousel';
$string['settings:frontslider:slideimagenr'] = 'Nombre de slides';
$string['settings:frontslider:slideimagenrdesc'] = '
Définissez le nombre de diapositives que vous utiliserez.<br>Remarque: vous devrez enregistrer cette option pour afficher le nouveau champ de paramètres.';
$string['settings:frontslider:slideimage'] = 'Image de diapositive {$a}';
$string['settings:frontslider:slideimagedesc'] = 'Définir une image pour cette diapositive';
$string['settings:frontslider:slidecaption'] = 'Légende de la diapositive {$a}';
$string['settings:frontslider:slidecaptiondesc'] = 'Définir un texte pour cette diapositive';

// Course card frontpage.
$string['settings:frontcoursecard:showcustomfields'] = 'Afficher les champs personnalisés';
$string['settings:frontcoursecard:showcustomfieldsdesc'] =
    'Afficher les champs personnalisés pour les cours sur la page d\'accueil';
$string['settings:frontcoursecard:showcontacts'] = 'Voir contacts';
$string['settings:frontcoursecard:showcontactsdesc'] = 'Afficher le contact dans la carte de cours de la page d\'accueil';
$string['settings:frontcoursecard:showstartdate'] = 'Afficher la date de début';
$string['settings:frontcoursecard:showstartdatedesc'] = 'Afficher la date de début dans la carte de cours de la page d\'accueil';

// Fonts.
$string['settings:font:googlefont'] = 'Police Google';
$string['settings:font:googlefontdesc'] =
    'Veuillez vous référer à la page: https://fonts.google.com/ pour trouver votre typographie';

// Frontpage Block Regions name.
$string['region-theme-front-a'] = 'Pimenko front-a';
$string['region-theme-front-b'] = 'Pimenko front-b';
$string['region-theme-front-c'] = 'Pimenko front-c';
$string['region-theme-front-d'] = 'Pimenko front-d';
$string['region-theme-front-e'] = 'Pimenko front-e';
$string['region-theme-front-f'] = 'Pimenko front-f';
$string['region-theme-front-g'] = 'Pimenko front-g';
$string['region-theme-front-h'] = 'Pimenko front-h';
$string['region-theme-front-i'] = 'Pimenko front-i';
$string['region-theme-front-j'] = 'Pimenko front-j';
$string['region-theme-front-k'] = 'Pimenko front-k';
$string['region-theme-front-l'] = 'Pimenko front-l';
$string['region-theme-front-m'] = 'Pimenko front-m';
$string['region-theme-front-n'] = 'Pimenko front-n';
$string['region-theme-front-o'] = 'Pimenko front-o';
$string['region-theme-front-p'] = 'Pimenko front-p';
$string['region-theme-front-q'] = 'Pimenko front-q';
$string['region-theme-front-r'] = 'Pimenko front-r';
$string['region-theme-front-s'] = 'Pimenko front-s';
$string['region-theme-front-t'] = 'Pimenko front-t';
$string['region-theme-front-u'] = 'Pimenko front-u';
$string['region-side-post'] = 'Droite';
$string['region-side-pre'] = 'Gauche';

// Trad enter button in courselist.
$string['entercourse'] = 'Entrer';

// Moodle activity completion design enabling setting.
$string['moodleactivitycompletion'] = "Activer l'affichage de l'achévement d'activité moodle";
$string['moodleactivitycompletion_desc'] =
    "Dans les activités ou les ressources d'un cours, les conditions d'achèvement sont affichées sous la forme d'une étiquette en dessous du titre de l'activité ou de la ressource. Ce réglage permet de masquer l'étiquette qui indique l'état de l'achèvement. Elle ne modifie pas l'affichage du suivi qui apparait au-dessous de chaque activité sur la page de cours et que vous pouvez régler dans les paramètres d'un cours.";

// Setting show participant tab or no.
$string['showparticipantscourse'] = "Afficher la rubrique participant dans le menu secondaire visible dans les cours";
$string['showparticipantscourse_desc'] =
    "Cette option permet d'afficher ou de masquer la rubrique 'Participants' qui s’affiche par défaut dans le menu secondaire de la page d'accueil d'un cours.";

// Show or not navigation in mod in course.
$string['showactivitynavigation'] = "Afficher la navigation précédent/suivant pour les mods";
$string['showactivitynavigation_desc'] =
    "Cette option permet d'afficher ou de masquer la navigation précédent/suivant dans les activités";

$string['totop'] = 'Aller en haut';

$string['listuserrole'] = 'Liste des rôles';
$string['listuserrole_desc'] =
    'Si l\'option showparticipantscourse est activé définisser les utilisateurs pouvant voir l\'onglet participants';

$string['unaddableblocks'] = 'Blocs inutiles';
$string['unaddableblocks_desc'] =
    'Les blocs spécifiés ne sont pas nécessaires lors de l\'utilisation de ce thème et ne seront pas listés dans le menu \'Ajouter un bloc\'.';

$string['backgroundimage'] = 'Image de fond';
$string['backgroundimage_desc'] = 'L\'image à afficher en arrière-plan du site.';

$string['pimenkofeature'] = 'Fonctionnalités Pimenko';

// Catalog enabling setting.
$string['catalogsettings'] = "Catalogue";
$string['catalogsettings_desc'] = "Configuration de la page catalogue";
$string['customfieldfilter'] = "Activation des filtres sur champs personnalisés";
$string['customfieldfilter_desc'] = "Active les filtres sur les champs personnalisés des cours dans le catalogue";
$string['enablecatalog'] = "Activation du catalogue";
$string['enablecatalog_desc'] = "Activer le catalogue";

$string['titlecatalog'] = "Titre du catalogue";
$string['titlecatalog_desc'] = "Modifier le titre du catalogue";

$string['tagfilter'] = "Activation du filtre par tags du catalogue";
$string['tagfilter_desc'] = "Cette option permet de rajouter un filtre par tags au niveau du catalogue de cours";

$string['allcategories'] = "Toutes les catégories";
$string['alltags'] = "Tous les tags";
$string['labelcategory'] = "Filtrer par catégorie";
$string['labelsearch'] = "Ou rechercher";
$string['placeholdersearch'] = "Mots clés...";
$string['search'] = "Rechercher";
$string['close'] = "Fermer";

// Show the count of subscribers.
$string['showsubscriberscount'] = 'Affiche le nombre d\'inscrits sur les vignettes de cours';
$string['showsubscriberscount_desc'] = 'Permet d\'afficher le nombre d\'inscrits sur les vignettes de cours';
$string['subscribers'] = 'inscrits';

$string['viewallhiddencourses'] = "Afficher les cours cachés sur la page course/index.php pour la méthode d'inscription synopsis";
$string['viewallhiddencourses_desc'] = "Activer/Désactiver l'affichage des cours cachés";

$string['catalogsummarymodal'] = "Afficher le résumé des cours du catalogue sous forme de modal";
$string['catalogsummarymodal_desc'] = "Permet l'affichage du résumé des cours du catalogue sous forme d'une modal";

// Other feature heading.
$string['otherfeature'] = "Autres fonctionnalités";
$string['otherfeature_desc'] = "Configurez d'autres fonctionnalités du thème Pimenko";

// Slider heading settings.
$string['slidersettings'] = "Options du carousel";
$string['slidersettings_desc'] = "Configurez le carousel pour la page d'accueil";

// Front page content settings heading.
$string['frontpagecontentsettings'] = "Options de la zone de contenu pour la page d'accueil";
$string['frontpagecontentsettings_desc'] = "Configurez la zone de contenu pour la page d'accueil";

// Card settings heading.
$string['frontpagecardsettings'] = "Options pour les cards des cours en page d'accueil";
$string['frontpagecardsettings_desc'] = "Configurez l'affichage des cards en page d'accueil";

// Hide site name setting.
$string['hidesitename'] = "Cacher le nom du site";
$string['hidesitename_desc'] =
    "Cette option permet de cacher le nom du site qui apparait dans l’en tête du site, à droite du logo en vue ordinateur.";
$string['cardlabelformat'] = "Formateur";
$string['cardlabeldate'] = "Date de début";

$string['contactsettings'] = "Nous contacter";
$string['contactheading'] = "À propos";
$string['contactus_content'] = "Pimenko est basée en France, à Lyon.<br>
Nous sommes un acteur engagé auprès des ONG, associations, organismes de formation et dans la communauté OpenSource.<br> 
Envie d'un développement sur mesure ? Des conseils adaptés à votre besoins ? Contacter nous : <a href='mailto:support@pimenko.com' target='_blank' style='font-weight: bold;'>support@pimenko.com</a>";
$string['contactus_button_text'] = "Nous envoyer un mail";

// Custom navbar menu.
$string['removedprimarynavitems'] = "Onglets du menu à supprimer";
$string['removedprimarynavitems_desc'] = "Vous pouvez renseigner aussi l'identifiants des menus à supprimer de la navbar. Chaque identifiants doit être séparé par une ',' exemple :<br>
<pre>myhome,courses,mycourses</pre>";
$string['customnavbarmenu'] = "Personnalisation du menu dans la barre de navigation";
$string['customnavbarmenu_desc'] =
    "Les options suivantes vous permettront de modifier l'aspect du menu dans la barre de navigation";
$string['custommenuitemslogin'] =
    'Éléments du menu personnalisé qui apparaitra une fois que les utilisateurs sont authentifiés sur le site';
$string['configcustommenuitemslogin'] = "Vous pouvez définir ici un menu personnalisé qui sera affiché par le theme quand vous êtes authentifié. Chaque ligne est constituée d'un texte du menu, d'une URL (optionnelle) et d'un texte (optionnel) à afficher dans une infobulle et d'un code de langue ou d'une liste de tels codes séparés par des virgules (optionnel, pour permettre l'affichage d'éléments en fonction de la langue). Ces éléments sont séparés par des caractères « trait vertical » (|). Une structure hiérarchique peut être définie à l'aide de tirets au début des lignes, et des lignes de séparation peuvent être indiquées à l'aide de ###. Exemple :
<pre>
Cours
-Tous les cours|/course/
-Recherche de cours|/course/search.php
-###
-FAQ|https://une-url.xyz/faq
-Preguntas más frecuentes|https://une-url.xyz/pmf||es
Mobile app|https://une-url.xyz/app|Téléchargez notre app
</pre>";

// Cover image for course.
$string['coursecover'] = "Bannière de cours";
$string['coursecoversettings'] = "Déterminer les réglages pour l’affichage d’image (vignette) en haut des pages de cours";
$string['coursecoversettings_desc'] =
    "Il est possible d’ajouter une image dans l’en tête des pages d’un cours. Les options ci-après permettent de choisir comment ces images qui s’affichent.";
$string['gradienttextcolor'] =
    "Si vous indiquez une couleur, elle sera utilisé pour modifier la couleur du titre du cours afficher dans l’en tête. Vous pouvez par exemple mettre le code couleur du blanc (#fff) pour avoir un titre de cours plus visible sur une photo foncée.";
$string['gradienttextcolor_desc'] = "Cette option permet de modifier la couleur du texte afficher sur la bannière";
$string['editcoverimage'] = "Changer la vignette";
$string['displaycoverallpage'] = "Afficher l’image dans l’en-tête de toutes les pages du cours";
$string['displaycoverallpage_desc'] =
    "Si cette option est activée, l’image sera affichée à la fois sur la page d’accueil de cours mais aussi dans les activités, les ressources ou les pages d’administration du cours";
$string['displayasthumbnail'] = "Afficher l’image sous la forme d’une vignette ou sur la pleine largeur de l’en tête du cours";
$string['displayasthumbnail_desc'] =
    "Si cette option est activée, l’image sera affichée sous la forme d’une vignette, c’est-à-dire un rectangle d’environ . Si cette option n’est pas activée, l’image sera affichée sous la forme d’une bannière qui occupe l’ensemble de la largeur de l’en tête de cours.";
// Options pour la vignette des cours.
$string['gradientcovercolor'] = "Appliquer une couleur sur l’image";
$string['gradientcovercolor_desc'] =
    "Si vous indiquez une couleur, elle sera affichée par-dessus l’image avec une transparence pour donner un effet de masque de couleur au-dessus de l’image";
// Options d'affichage pour le menu des cate.
$string['menuheadercateg'] = 'Mes catégories';
$string['menuheadercategdesc'] = 'Afficher une liste déroulante avec les catégories des utilisateurs';
$string['menuheadercateg:excludehidden'] = 'Activer l\'exclusion des catégories cachées';
$string['menuheadercateg:includehidden'] = 'Activer l\'inclusion des catégories cachées';
$string['menuheadercateg:disabled'] = 'Désactiver';
$string['filterbycustomfilter'] = 'Filtrer par champs personnalisés';
$string['yes'] = 'Oui';
$string['no'] = 'Non';

$string['optionloginhtmlcontent'] = 'Options spécifiques à la page d\'authentification en mode paysage';
$string['optionloginhtmlcontentdesc'] = 'Ces réglages s\'affiche quand vous activez l\'affichage de l\'authenfication en mode paysage';
$string['leftblockloginhtmlcontent'] = 'Zone de contenu à gauche de la page d\'authentification';
$string['leftblockloginhtmlcontentdesc'] = 'Permet la création d\'une zone de contenu qui sera affiché dans la partie gauche de la page d\authentification';
$string['rightblockloginhtmlcontent'] = 'Zone de contenu à droite de la page d\'authentification';
$string['rightblockloginhtmlcontentdesc'] = 'Permet la création d\'une zone de contenu qui sera affiché dans la partie droite de la page d\authentification';

// H5P.
$string['h5pcss'] = 'Fichier CSS pour H5P';
$string['h5pcss_desc'] = 'Ajouter un fichier CSS qui ne sera chargé que par H5P pour changer de design';
