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

$string['advancedsettings'] = 'Réglages avancés';
$string['allcategories'] = "Toutes les catégories";
$string['alltags'] = "Tous les tags";
$string['backgroundimage'] = 'Image de fond';
$string['backgroundimage_desc'] = 'Ajouter une image à afficher en arrière-plan sur l’ensemble site. ';
$string['brandcolor'] = 'Couleur principale';
$string['brandcolor_desc'] = 'La couleur principale du thème qui sera appliquée automatiquement sur une partie du site (iens, titre des blocs, etc.).';
$string['brandcolorbutton'] = 'Couleur des boutons';
$string['brandcolorbuttondesc'] = 'Couleur de fond des boutons';
$string['brandcolortextbutton'] = 'Couleur de texte des boutons';
$string['brandcolortextbuttondesc'] = 'Couleur pour les textes des boutons';
$string['cardlabeldate'] = "Date de début";
$string['cardlabelformat'] = "Formateur";
$string['catalogsettings'] = "Catalogue";
$string['catalogsettings_desc'] = 'Modifier le fonctionnement de la page avec la <a href="/course/index.php" target="_blank">liste complète des cours</a>. Ces réglages sont effectifs après avoir activé l\'option catalogue';
$string['catalogsummarymodal'] = "Affiche le résumé des cours dans une fenêtre surgissante";
$string['catalogsummarymodal_desc'] = 'Cette option masque le résumé de cours au niveau de la vignette. En cliquant sur l\'icône "i", le résumé apparait dans une fenêtre surgissante';
$string['choosereadme'] = 'Le thème Pimenko est un thème enfant de Boost. Il ajoute quelques nouvelles fonctionnalités';
$string['clearfilters'] = 'Réinitialiser les filtres';
$string['close'] = "Fermer";
$string['completion-alt-auto-enabled'] = 'Le système marque cet élément comme terminé';
$string['completion-alt-auto-n'] = 'Incomplet';
$string['completion-alt-auto-n-override'] = 'Incomplet';
$string['completion-alt-auto-y'] = 'Incomplet';
$string['completion-alt-auto-y-override'] = 'Incomplet';
$string['completion-alt-manual-enabled'] = 'Les élèves peuvent marquer manuellement cet élément comme terminé';
$string['completion-alt-manual-n'] = 'Incomplet';
$string['completion-alt-manual-n-override'] = 'Incomplet';
$string['completion-alt-manual-y'] = 'Incomplet';
$string['completion-alt-manual-y-override'] = 'Incomplet';
$string['completion-tooltip-auto-enabled'] = 'Le système marque cet élément comme terminé';
$string['completion-tooltip-auto-n'] = 'Achèvement automatique';
$string['completion-tooltip-auto-n-override'] = 'Achèvement automatique';
$string['completion-tooltip-auto-pass'] = 'Achèvement automatique';
$string['completion-tooltip-auto-y'] = 'Achèvement automatique';
$string['completion-tooltip-auto-y-override'] = 'Achèvement automatique';
$string['completion-tooltip-manual-enabled'] = 'Les élèves peuvent marquer manuellement cet élément comme terminé';
$string['completion-tooltip-manual-n'] = 'Cliquez pour marquer comme terminé';
$string['completion-tooltip-manual-n-override'] = 'Cliquez pour marquer comme terminé';
$string['completion-tooltip-manual-y'] = 'Cliquez pour marquer comme non terminé';
$string['completion-tooltip-manual-y-override'] = 'Cliquez pour marquer comme non terminé';
$string['configcustommenuitemslogin'] = "Si vous souhaitez afficher des liens différents après authentification, vous pouvez définir ici un menu personnalisé qui sera affiché par le theme quand vous êtes authentifié. Chaque ligne est constituée d'un texte du menu, d'une URL (optionnelle) et d'un texte (optionnel) à afficher dans une infobulle et d'un code de langue ou d'une liste de tels codes séparés par des virgules (optionnel, pour permettre l'affichage d'éléments en fonction de la langue). Ces éléments sont séparés par des caractères « trait vertical » (|). Une structure hiérarchique peut être définie à l'aide de tirets au début des lignes, et des lignes de séparation peuvent être indiquées à l'aide de ###. Exemple :<pre>Cours<br>-Tous les cours|/course/<br>-Recherche de cours|/course/search.php<br>-###<br>-FAQ|https://une-url.xyz/faq<br>-Preguntas más frecuentes|https://une-url.xyz/pmf||es<br>Mobile app|https://une-url.xyz/app|Téléchargez notre app</pre>";
$string['configtitle'] = 'Options Pimenko';
$string['contactheading'] = "À propos";
$string['contactsettings'] = "Nous contacter";
$string['contactus_button_text'] = "Nous envoyer un mail";
$string['contactus_content'] = "Pimenko est basée en France, à Lyon.<br>Nous sommes un acteur engagé auprès des ONG, associations, organismes de formation et dans la communauté OpenSource.<br>Envie d'un développement sur mesure ? Des conseils adaptés à votre besoins ? Contacter nous : <a href='mailto:support@pimenko.com' target='_blank' style='font-weight: bold;'>support@pimenko.com</a>";
$string['coursecover'] = "Bannière de cours";
$string['coursecoversettings'] = 'Vignettes sur les pages d\'accueil des cours';
$string['coursecoversettings_desc'] = 'Ces options permettent d’ajuster comment l\'image dans l\'en tête des cours s\'affiche.';
$string['courseimage'] = 'Image du cours';
$string['customfieldfilter'] = "Affiche des filtres sur les champs personnalisés";
$string['customfieldfilter_desc'] = "Cette option permet d'ajouter des filtres qui sont liés aux champs personnalisés des cours. Les champs personnalisés doivent être paramétrés au niveau du site et complété dans les paramètres de cours.";
$string['custommenuitemslogin'] = 'Éléments du menu personnalisé après authentification';
$string['customnavbarmenu'] = "Personnalisation des liens et des menus de la barre de navigation";
$string['customnavbarmenu_desc'] = "Ces options permettent de modifier les liens et menus dans la barre de navigation";
$string['displayasthumbnail'] = 'Affiche l\'image sous forme d\'une vignette';
$string['displayasthumbnail_desc'] = 'Si cette option est activée, l\'image sera affichée sous la forme d’une vignette de maximum 400px de largeur à droite de l\'en-tête du cours. Si cette option n\'est pas activée, l\'image sera affichée sous la forme d\'une bannière qui occupe l\'ensemble de la largeur de l\'en-tête du cours.';
$string['displaycoverallpage'] = 'Affiche l’image dans l’en-tête des pages d\'accueil des cours, des ressources et des activités';
$string['displaycoverallpage_desc'] = 'Si cette option est activée, l\'image sera affichée à la fois sur la page d\'accueil de cours mais aussi dans les ressources, les activités et les pages d’administration du cours.';
$string['displaytitlecourseunderimage'] = 'Afficher le titre du cours sous l\'image';
$string['displaytitlecourseunderimage_desc'] = 'Si activée, le titre du cours sera affiché sous l\'image.';
$string['editcoverimage'] = "Changer la vignette";
$string['enablecatalog'] = "Active l'affichage catalogue";
$string['enablecatalog_desc'] = 'Cette option transforme l\'affichage par défaut de la page avec la <a href="/course/index.php" target="_blank">liste complète des cours</a>. Ils apparaissent sous la forme d\'une vignette avec le titre du cours et la description si elle est renseignée. Si vous avez ajoutez une image de cours, elle apparait en haut de la vignette.';
$string['enablegooglefont'] = 'Activer Google Fonts';
$string['enablegooglefont_desc'] = 'Activez cette option pour permettre l\'utilisation des polices Google Fonts dans ce thème.';
$string['entercourse'] = 'Entrer';
$string['favicon'] = 'Favicon';
$string['favicondesc'] = 'Charger une favicon à utiliser sur le site';
$string['filterbycustomfilter'] = 'Filtrer par champs personnalisés';
$string['footercolor'] = 'Couleur du pied de page';
$string['footercolordesc'] = 'Définir la couleur de fond pour le pied de page';
$string['footersettings'] = 'Pied de page';
$string['footertextcolor'] = 'Couleur du texte dans le pied de page';
$string['footertextcolordesc'] = 'Définir la couleur pour le texte du pied de page';
$string['frontpage'] = 'Paramètres de la page d\'accueil';
$string['frontpagecardsettings'] = "Options pour la présentation des vignettes de cours sur la page d’accueil";
$string['frontpagecardsettings_desc'] = "Si vous affichez les cours sur la page d'accueil du site, ils apparaissent sous la forme de vignettes. Ces options permettent de déterminer les informations à afficher.";
$string['frontpagecontentsettings'] = "Options des zones de contenu de la page d’accueil";
$string['frontpagecontentsettings_desc'] = "Configurer la zone de contenu pour la page d'accueil";
$string['generalsettings'] = 'Réglages généraux';
$string['gradientcovercolor'] = "Affiche une couleur de premier plan";
$string['gradientcovercolor_desc'] = "Si vous indiquez une couleur, elle sera affichée au premier plan c’est-à-dire par-dessus l’image. Une transparence est automatiquement appliquée pour apporter un effet de filtre.";
$string['gradienttextcolor'] = "Modifie la couleur du titre des cours";
$string['gradienttextcolor_desc'] = "Si vous indiquez une couleur, elle est utilisée comme couleur pour le titre des cours. Vous pouvez par exemple mettre le code couleur blanc (#fff) pour avoir un titre de cours plus visible sur une image avec une teinte foncée.";
$string['h5pcss'] = 'Fichier CSS pour H5P';
$string['h5pcss_desc'] = 'Ajouter un fichier CSS qui sera chargé et modifie le design des activités H5P de votre site.';
$string['hide'] = 'Cacher';
$string['hidemanuelauth'] = 'Cacher l\'authentification manuel';
$string['hidemanuelauth_desc'] = "Si activée, l'authentification manuel sera caché. Utiliser urldusite/login/index.php?adminpage=true pour accéder à l’authentification manuel.";
$string['hidesitename'] = "Cacher le nom du site";
$string['hidesitename_desc'] = "Cette option permet de cacher le nom du site qui apparait dans la barre de navigation.";
$string['hooverfootercolor'] = 'Couleur de surbrillance des liens dans le pied de page';
$string['hooverfootercolordesc'] = 'Définir la couleur de surbrillance pour les liens du pied de page';
$string['hoovernavbarcolor'] = 'Couleur pour les liens dans la barre de navigation';
$string['hoovernavbarcolordesc'] = 'Définir une couleur pour les liens de la barre de navigation';
$string['labelcategory'] = "Filtrer par catégorie";
$string['labelsearch'] = "Ou rechercher";
$string['leftblockloginhtmlcontent'] = 'Zone de contenu à gauche de la page d\'authentification';
$string['leftblockloginhtmlcontentdesc'] = 'Ajouter du contenu qui sera affiché au dessus de la colonne de gauche.';
$string['listuserrole'] = 'Liste des rôles qui voit le lien "Participant"';
$string['listuserrole_desc'] = 'Si l\'option "showparticipantscourse" est activée, choissisez les utilisateurs qui voient le lien "Participants" dans le menu secondaire des cours. Cela vous permet par exemple de masquer ce lien aux apprenants/étudiants.';
$string['loadmore'] = 'Charger plus';
$string['loginbgimage'] = 'Image en arrière plan';
$string['loginbgimagedesc'] = 'Ajouter une image d\'arrière-plan à la page.';
$string['loginbgopacity'] = 'Opacité de la zone de contenu';
$string['loginbgopacitydesc'] = 'Opacité d\'arrière-plan de connexion pour l\'en-tête, la barre de navigation, la zone de connexion et le pied de page lorsqu\'il y a une image d\'arrière-plan.';
$string['loginbgstyle'] = 'Style d\'arrière-plan de connexion';
$string['loginbgstyledesc'] = 'Sélectionner le style de l\'image téléchargée.';
$string['logindesc'] = 'Personnalisez la page de connexion en ajoutant un arrière-plan d\'image et des textes au-dessus et en dessous de la zone de connexion.';
$string['loginsettings'] = 'Paramètres de la page d\'authentification';
$string['loginsettingsheading'] = 'Personnalisez la page de connexion';
$string['logintextboxbottom'] = 'Zone de contenu inférieure';
$string['logintextboxbottomdesc'] = 'Ajouter un contenu personnalisé ( texte, image ... ) en bas du bloc d\' authentification. Il sera affiché sur la pleine du bloc.';
$string['logintextboxtop'] = 'Zone de contenu supérieure';
$string['logintextboxtopdesc'] = 'Ajouter un contenu personnalisé ( texte, image ... ) en haut du bloc d\' authentification. Il sera affiché sur la pleine du bloc.';
$string['menuheadercateg'] = 'Mes catégories';
$string['menuheadercateg:disabled'] = 'Désactiver';
$string['menuheadercateg:excludehidden'] = 'Activer l\'exclusion des catégories cachées';
$string['menuheadercateg:includehidden'] = 'Activer l\'inclusion des catégories cachées';
$string['menuheadercategdesc'] = 'Afficher dans un menu les catégories et les sous catégories du site.';
$string['moodleactivitycompletion'] = "Active l’achèvement d’activité de Moodle en haut de la page des ressources et activités";
$string['moodleactivitycompletion_desc'] = "Par défaut, le thème Pimenko affiche les conditions d’achèvement d’activité sous la forme d’une pastille en bas de chaque ressource ou activité. Cette option permet de reprendre le fonctionnement par défaut de Moodle : les conditions d’achèvement d’activités s’affichent en haut de la page sous la forme d’une étiquette.";
$string['navbarcolor'] = 'Couleur de la barre de navigation';
$string['navbarcolordesc'] = 'Définir une couleur de fond de la barre de navigation';
$string['navbarpicture'] = 'Arrière-plan de la barre de navigation';
$string['navbarpicturedesc'] = 'Ajoutez une image en arrière plan dans la barre de navigation. Il est généralement nécessaire d\'adapter le style (par exemple la hauteur de la barre de navigation).';
$string['navbarsettings'] = 'Barre de navigation';
$string['navbartextcolor'] = 'Couleur du texte pour la barre de navigation';
$string['navbartextcolordesc'] = 'Définir une couleur pour le texte de la barre de navigation';
$string['nextmod'] = 'Activité suivante';
$string['no'] = 'Non';
$string['optionloginhtmlcontent'] = 'Options spécifiques à l\'affichage en deux colonnes';
$string['optionloginhtmlcontentdesc'] = 'Cette mise en forme dispose de zones de contenu personnalisables. Elle a aussi la particularité d’afficher les méthodes d’authentification sur deux colonnes. Dans le cas où vous utilisez plusieurs méthodes d’authentification sur votre site (manuelle, SSO, LDAP, Auth2, etc.), l\'authentification manuelle est affichée dans la colonne de gauche et les autres méthodes d\'authentification sont affichées dans la colonne de droite.';
$string['otherfeature'] = "Options pour transformer le fonctionnement de Moodle";
$string['otherfeature_desc'] = "Il est parfois nécessaire de modifier ou enrichir le fonctionnement classique de Moodle. Ces options permettent d’adapter finement la plateforme à vos besoins.";
$string['pimenkofeature'] = 'Fonctionnalités Pimenko';
$string['placeholdersearch'] = "Mots clés...";
$string['pluginname'] = 'Pimenko';
$string['preset'] = 'Préréglages du thème';
$string['preset_desc'] = 'Veuillez choisir un préréglage pour modifier l’aspect du thème.';
$string['presetfiles'] = 'Fichier de préréglages du thème';
$string['presetfiles_desc'] = 'Des fichiers de préréglages peuvent être utilisés afin de changer totalement la présentation du thème. <a href="https://docs.moodle.org/dev/Boost_Presets">Voir la documentation Moodle</a> pour des informations sur la façon de créer et partager vos propres fichiers de préréglages';
$string['privacy:drawerblockclosed'] = 'La préférence actuelle pour le tiroir de blocs est fermée.';
$string['privacy:drawerblockopen'] = 'La préférence actuelle pour le tiroir de blocs est ouverte.';
$string['privacy:drawerindexclosed'] = 'La préférence actuelle pour le tiroir de l\'index est fermée.';
$string['privacy:drawerindexopen'] = 'La préférence actuelle pour le tiroir de l\'index est ouverte.';
$string['privacy:metadata'] = 'Le thème Pimenko ne stocke aucune donnée personnelle.';
$string['privacy:metadata:preference:draweropenblock'] = 'La préférence de l\'utilisateur pour masquer ou afficher le tiroir avec des blocs.';
$string['privacy:metadata:preference:draweropenindex'] = 'La préférence de l\'utilisateur pour masquer ou afficher le tiroir avec l\'index du cours.';
$string['profile:basicinfo'] = 'Informations générales';
$string['profile:contactinfo'] = 'Contact';
$string['profile:joinedon'] = 'Inscrit le ';
$string['profile:lastaccess'] = 'Dernier accès ';
$string['rawscss'] = 'SCSS brut';
$string['rawscss_desc'] = 'Ce champ permet d\'indiquer du code SCSS ou CSS qui sera injecté à la fin de la feuille de styles.';
$string['rawscsspre'] = 'SCSS initial brut';
$string['rawscsspre_desc'] = 'Ce champ permet d\'indiquer du code SCSS d’initialisation, qui sera injecté dans la feuille de styles avant toute autre définition. La plupart du temps, ce code sera utilisé pour définir des variables.';
$string['region-side-post'] = 'Droite';
$string['region-side-pre'] = 'Gauche';
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
$string['removedprimarynavitems'] = "Liens du menu à supprimer";
$string['removedprimarynavitems_desc'] = 'Indiquer les identifiants des liens à supprimer de la barre de navigation. Les identifiants doivent être séparés par une "," Par exemple pour supprimer la page d’accueil et la page mes cours, le tableau de bord, administration utilisez :<br><pre>home,courses,myhome,siteadmin</pre>';
$string['rightblockloginhtmlcontent'] = 'Zone de contenu à droite de la page d\'authentification';
$string['rightblockloginhtmlcontentdesc'] = 'Ajouter du contenu qui sera affiché au dessus de la colonne de droite.';
$string['search'] = "Rechercher";
$string['settings:font:googlefont'] = 'Police Google';
$string['settings:font:googlefontdesc'] = 'Utiliser une GoogleFont. Voir la documentation sur <a href="https://fonts.google.com/">https://fonts.google.com/</a>';
$string['settings:footer:footercolumn'] = 'Personnaliser le pied de page de la colonne {$a}';
$string['settings:footer:footercolumndesc'] = '';
$string['settings:footer:footerheading'] = 'Titre du pied de page colonne {$a}';
$string['settings:footer:footerheadingdesc'] = 'Ajouter un titre (il sera de niveau h3)';
$string['settings:footer:footertext'] = 'Zone de contenu du pied de page colonne {$a}';
$string['settings:footer:footertextdesc'] = 'Ajouter du contenu pour le pied de page.';
$string['settings:frontcoursecard:showcontacts'] = 'Affiche les enseignants';
$string['settings:frontcoursecard:showcontactsdesc'] = 'Afficher les enseignants dans la vignette de cours';
$string['settings:frontcoursecard:showcustomfields'] = 'Affiche les champs personnalisés';
$string['settings:frontcoursecard:showcustomfieldsdesc'] = 'Afficher les champs personnalisés dans la vignette de cours';
$string['settings:frontcoursecard:showstartdate'] = 'Affiche la date de début';
$string['settings:frontcoursecard:showstartdatedesc'] = 'Afficher la date de début dans la vignette';
$string['settings:frontslider:enablecarousel'] = 'Active le diaporama';
$string['settings:frontslider:enablecarouseldesc'] = 'Activer le diaporama en haut de la page d’accueil du site.';
$string['settings:frontslider:slidecaption'] = 'Légende de l\'image {$a}';
$string['settings:frontslider:slidecaptiondesc'] = 'Définir un texte pour l\'image';
$string['settings:frontslider:slideimage'] = 'Image {$a}';
$string['settings:frontslider:slideimagedesc'] = 'Ajouter une image. La taille recommandée est 1600px x 400px ou plus.';
$string['settings:frontslider:slideimagenr'] = 'Nombre d\'images';
$string['settings:frontslider:slideimagenrdesc'] = 'Sélectionner le nombre d’images que vous souhaitez ajouter puis cliquez sur Enregistrer pour sauvegarder votre choix. Les zones de dépôts d’images complémentaires apparaitront.';
$string['settings:loginsettings:vanillalogintemplate'] = 'Page d\'authentification Moodle';
$string['settings:loginsettings:vanillalogintemplatedesc'] = 'Utiliser la page d’authentification classique du thème officiel de Moodle "Boost"';
$string['settings:regions:blockregionrowbackgroundcolor'] = 'Couleur de fond de la zone {$a}';
$string['settings:regions:blockregionrowbackgroundcolordesc'] = 'Définir une couleur de fond pour la zone de contenu sur la première page.';
$string['settings:regions:blockregionrowlinkcolor'] = 'Couleur des liens de la zone {$a}';
$string['settings:regions:blockregionrowlinkcolordesc'] = 'Définir une couleur pour les liens pour la zone de contenu sur la première page.';
$string['settings:regions:blockregionrowlinkhovercolor'] = 'Couleur des liens \'survoler\' de la zone {$a}';
$string['settings:regions:blockregionrowlinkhovercolordesc'] = 'Définir une couleur pour les liens \'survoler\' pour la zone de contenu sur la première page.';
$string['settings:regions:blockregionrowtextcolor'] = 'Couleur de texte de la zone {$a}';
$string['settings:regions:blockregionrowtextcolordesc'] = 'Définir une couleur de texte pour la zone de contenu sur la première page.';
$string['settings:regions:blockrow'] = 'Zone de contenu {$a}';
$string['settings:regions:blockrowdesc'] = 'Définir la mise en page pour la zone de contenu sur la première page.';
$string['settings:regions:frontpageblocksettingscription'] = '';
$string['settings:regions:frontpageblocksettingscriptiondesc'] = 'Vous pouvez composer la page d’accueil : elle peut être divisée en 8 lignes pour vous permettre d’ajouter votre contenu. Pour chaque ligne, des options permettent de choisir les couleurs et le nombre de colonnes. Important : pour ajouter du contenu dans les zones, vous devez activer le mode édition sur la page d’accueil. Vous pourrez ensuite glisser/déposer des blocs dans les zones créées. Vous pouvez trouver la page d\'accueil ici : <a href= \'/?redirect=0\'>Page d\'accueil</a>.';
$string['show'] = 'Afficher';
$string['showactivitynavigation'] = "Active des fonctionnalités de navigation dans chaque activité et ressource";
$string['showactivitynavigation_desc'] = "Depuis Moodle 4.0, la navigation entre les activités et les ressources n’est plus disponible en bas de page. Cette option permet d’afficher un lien vers l’activité ou la ressource précédente et suivante. Elle affiche également un menu déroulant pour accéder à n’importe quel contenu du cours.";
$string['showparticipantscourse'] = "Affiche le lien participant dans le menu secondaire du cours aux utilisateurs de son choix";
$string['showparticipantscourse_desc'] = "Cette option permet de choisir les utilisateurs pour lesquels le lien « Participants » s’affiche dans le menu secondaire des cours. Vous devez déterminer les rôles qui voient le lien dans le menu ci-après. Si cette option n’est pas activée, seul les administrateurs verront le lien « participant ».";
$string['showsubscriberscount'] = 'Affiche le nombre d\'inscrits sur les vignettes de cours';
$string['showsubscriberscount_desc'] = 'Cette option afficher automatiquement le nombre d\'inscrits sur les vignettes de cours';
$string['sitelogo'] = 'Logo du site';
$string['sitelogodesc'] = 'Ajouter un logo dans la barre navigation.';
$string['slidersettings'] = "Diaporama de la page d'accueil";
$string['slidersettings_desc'] = "Configurez le diaporama pour la page d'accueil";
$string['stylecover'] = 'Cover';
$string['stylestretch'] = 'Stretch';
$string['subscribers'] = 'inscrits';
$string['tagfilter'] = "Affiche un système de filtre lié à la fonctionnalité des tags de cours";
$string['tagfilter_desc'] = "Cette option ajoute un menu déroulant pour filtrer les cours par tags. Ils doivent être ajoutées dans les paramètres d’un cours (rubrique <strong>Tags</strong>).";
$string['titlecatalog'] = "Titre du catalogue";
$string['titlecatalog_desc'] = 'Cette option modifie le titre de la page avec la <a href="/course/index.php" target="_blank">liste complète des cours</a>.';
$string['totop'] = 'Aller en haut';
$string['unaddableblocks'] = 'Blocs inutiles';
$string['unaddableblocks_desc'] = 'Les blocs spécifiés ne sont pas nécessaires lors de l\'utilisation de ce thème et ne seront pas listés dans le menu \'Ajouter un bloc\'.';
$string['viewallhiddencourses'] = 'Affiche les cours en visibilité "cacher" pour la méthode d’inscription synopsis';
$string['viewallhiddencourses_desc'] = 'Si la visibilité du cours est sur "cacher", cette option permet quand même aux participants de voir la vignette du cours dans le catalogue. Attention : cette option fonctionne uniquement avec la méthode d\'inscription "enrol synopsis" développée par Pimenko. Lorsqu\'un participant clique sur le cours, il accède à la page la description et peut s\'inscrire en attendant son ouverture.';
$string['viewcat'] = 'Voir la catégorie';
$string['viewcourse'] = 'Voir le cours';
$string['yes'] = 'Oui';
