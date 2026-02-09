@core @core_admin @theme_pimenko @javascript
Feature: Check if all setings are working.

  Background:
    Given I log in as "admin"
    And I maximize the window
    And I visit "/admin/settings.php?section=themesettingpimenko"

  Scenario: Verify that the general settings can be saved
    And I click on "s_theme_pimenko_brandcolor" "field" forced
    And I set the field "s_theme_pimenko_brandcolor" to "#123456"
    When I press "Save changes"
    And I click on "General settings" "link"
    Then the field "s_theme_pimenko_brandcolor" matches value "#123456"

  Scenario: Verify that the advanced settings can be saved
    Given I click on "Advanced settings" "link"
    And I click on "s_theme_pimenko_scss" "field" forced
    And I set the field "s_theme_pimenko_scss" to "body { background-color: #000; }"
    When I press "Save changes"
    And I click on "Advanced settings" "link"
    Then the field "s_theme_pimenko_scss" matches value "body { background-color: #000; }"

  Scenario: Verify that the Pimenko Feature settings can be saved
    Given I click on "Pimenko features" "link"
    And I click on "s_theme_pimenko_enablecatalog" "checkbox" forced
    And I set the field "s_theme_pimenko_enablecatalog" to "1"
    And I set the field "s_theme_pimenko_tagfilter" to "1"
    And I set the field "s_theme_pimenko_customfieldfilter" to "1"
    And I set the field "s_theme_pimenko_titlecatalog" to "New Catalog Title"
    And I set the field "s_theme_pimenko_showsubscriberscount" to "1"
    And I set the field "s_theme_pimenko_viewallhiddencourses" to "1"
    And I set the field "s_theme_pimenko_catalogsummarymodal" to "1"
    And I set the field "s_theme_pimenko_displaycoverallpage" to "1"
    And I set the field "s_theme_pimenko_displayasthumbnail" to "1"
    And I set the field "s_theme_pimenko_displaytitlecourseunderimage" to "1"
    And I click on "s_theme_pimenko_gradientcovercolor" "field" forced
    And I set the field "s_theme_pimenko_gradientcovercolor" to "#112233"
    And I click on "s_theme_pimenko_gradienttextcolor" "field" forced
    And I set the field "s_theme_pimenko_gradienttextcolor" to "#445566"
    And I set the field "s_theme_pimenko_moodleactivitycompletion" to "1"
    And I set the field "s_theme_pimenko_showactivitynavigation" to "0"
    And I set the field "s_theme_pimenko_showparticipantscourse" to "0"
    When I press "Save changes"
    And I click on "Pimenko features" "link"
    Then the field "s_theme_pimenko_enablecatalog" matches value "1"
    And the field "s_theme_pimenko_tagfilter" matches value "1"
    And the field "s_theme_pimenko_customfieldfilter" matches value "1"
    And the field "s_theme_pimenko_titlecatalog" matches value "New Catalog Title"
    And the field "s_theme_pimenko_showsubscriberscount" matches value "1"
    And the field "s_theme_pimenko_viewallhiddencourses" matches value "1"
    And the field "s_theme_pimenko_catalogsummarymodal" matches value "1"
    And the field "s_theme_pimenko_displaycoverallpage" matches value "1"
    And the field "s_theme_pimenko_displayasthumbnail" matches value "1"
    And the field "s_theme_pimenko_displaytitlecourseunderimage" matches value "1"
    And the field "s_theme_pimenko_gradientcovercolor" matches value "#112233"
    And the field "s_theme_pimenko_gradienttextcolor" matches value "#445566"
    And the field "s_theme_pimenko_moodleactivitycompletion" matches value "1"
    And the "s_theme_pimenko_showactivitynavigation" checkbox should not be checked
    And the field "s_theme_pimenko_showparticipantscourse" matches value "0"

  Scenario: Verify that the Frontpage settings can be saved
    Given I click on "Frontpage Block Settings" "link"
    And I click on "s_theme_pimenko_enablecarousel" "checkbox" forced
    And I set the field "s_theme_pimenko_enablecarousel" to "1"
    And I set the field "s_theme_pimenko_slideimagenr" to "2"
    And I set the field "s_theme_pimenko_showcustomfields" to "1"
    And I set the field "s_theme_pimenko_showcontacts" to "1"
    And I set the field "s_theme_pimenko_showstartdate" to "1"
    When I press "Save changes"
    And I click on "Frontpage Block Settings" "link"
    Then the field "s_theme_pimenko_enablecarousel" matches value "1"
    And the field "s_theme_pimenko_slideimagenr" matches value "2"
    And the field "s_theme_pimenko_showcustomfields" matches value "1"
    And the field "s_theme_pimenko_showcontacts" matches value "1"
    And the field "s_theme_pimenko_showstartdate" matches value "1"

  Scenario: Verify that the Login settings can be saved
    Given I click on "Login Page" "link"
    And I click on "s_theme_pimenko_hidemanuelauth" "checkbox" forced
    And I set the field "s_theme_pimenko_hidemanuelauth" to "1"
    And I click on "s_theme_pimenko_vanillalogintemplate" "checkbox" forced
    And I set the field "s_theme_pimenko_loginbgstyle" to "stretch"
    And I set the field "s_theme_pimenko_loginbgopacity" to "0.5"
    When I press "Save changes"
    And I click on "Login Page" "link"
    Then the field "s_theme_pimenko_hidemanuelauth" matches value "1"
    And the field "s_theme_pimenko_vanillalogintemplate" matches value "1"
    And the field "s_theme_pimenko_loginbgstyle" matches value "stretch"
    And the field "s_theme_pimenko_loginbgopacity" matches value "0.5"

  Scenario: Verify that the Navbar settings can be saved
    Given I click on "Navbar" "link"
    And I click on "s_theme_pimenko_hidesitename" "checkbox" forced
    And I set the field "s_theme_pimenko_hidesitename" to "1"
    And I click on "s_theme_pimenko_navbarcolor" "field" forced
    And I set the field "s_theme_pimenko_navbarcolor" to "#112233"
    And I click on "s_theme_pimenko_navbartextcolor" "field" forced
    And I set the field "s_theme_pimenko_navbartextcolor" to "#445566"
    And I set the field "s_theme_pimenko_menuheadercateg" to "includehidden"
    When I press "Save changes"
    And I click on "Navbar" "link"
    Then the field "s_theme_pimenko_hidesitename" matches value "1"
    And the field "s_theme_pimenko_navbarcolor" matches value "#112233"
    And the field "s_theme_pimenko_navbartextcolor" matches value "#445566"
    And the field "s_theme_pimenko_menuheadercateg" matches value "includehidden"

  Scenario: Verify that the Footer settings can be saved
    Given I click on "Footer" "link"
    And I click on "s_theme_pimenko_footercolor" "field" forced
    And I set the field "s_theme_pimenko_footercolor" to "#abcdef"
    And I click on "s_theme_pimenko_footertextcolor" "field" forced
    And I set the field "s_theme_pimenko_footertextcolor" to "#111111"
    And I click on "s_theme_pimenko_footerheading1" "field" forced
    And I set the field "s_theme_pimenko_footerheading1" to "Contact Us"
    When I press "Save changes"
    And I click on "Footer" "link"
    Then the field "s_theme_pimenko_footercolor" matches value "#abcdef"
    And the field "s_theme_pimenko_footertextcolor" matches value "#111111"
    And the field "s_theme_pimenko_footerheading1" matches value "Contact Us"

  Scenario: Verify that the Contact tab is accessible
    Given I click on "Contact us" "link"
    Then I should see "Contact us"
