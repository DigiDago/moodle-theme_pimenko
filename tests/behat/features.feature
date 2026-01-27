@theme_pimenko @pimenko_feature @javascript
Feature: Test theme features
  In order to use pimenko theme features
  As an admin
  I need to be able to enable and verify them

  Background:
    Given I log in as "admin"
    And I maximize the window
    And the following config values are set as admin:
      | defaulthomepage | 0 |
      | custommenuitems | -This is a custom item\|/customurl/ |
    And I visit "/admin/settings.php?section=themesettingpimenko"

  Scenario: Verify that hiding the site name in navbar works
    Given I click on "Navbar" "link"
    And I click on "s_theme_pimenko_hidesitename" "checkbox" forced
    And I set the field "s_theme_pimenko_hidesitename" to "1"
    And I press "Save changes"
    When I am on homepage
    Then ".site-name" "css_element" should not exist
    And I visit "/admin/settings.php?section=themesettingpimenko"
    And I click on "Navbar" "link"
    And I click on "s_theme_pimenko_hidesitename" "checkbox" forced
    And I set the field "s_theme_pimenko_hidesitename" to "0"
    And I press "Save changes"
    When I am on homepage
    Then ".site-name" "css_element" should exist

  Scenario: Verify that the frontpage carousel can be enabled
    Given I click on "Frontpage Block Settings" "link"
    And I click on "s_theme_pimenko_enablecarousel" "checkbox" forced
    And I set the field "s_theme_pimenko_enablecarousel" to "1"
    And I press "Save changes"
    When I am on homepage
    Then "#pimenko-carousel" "css_element" should exist
    And I visit "/admin/settings.php?section=themesettingpimenko"
    And I click on "Frontpage Block Settings" "link"
    And I click on "s_theme_pimenko_enablecarousel" "checkbox" forced
    And I set the field "s_theme_pimenko_enablecarousel" to "0"
    And I press "Save changes"
    When I am on homepage
    Then "#pimenko-carousel" "css_element" should not exist

  Scenario: Verify that the activity navigation can be disabled
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "activities" exist:
      | activity   | name         | intro                       | course | idnumber  | section |
      | page       | Page 1       | Test page description       | C1     | page1     | 0       |
      | page       | Page 2       | Test page description       | C1     | page2     | 0       |
    And I click on "Pimenko features" "link"
    And I set the field "s_theme_pimenko_showactivitynavigation" to "1"
    And I press "Save changes"
    And I am on "Course 1" course homepage
    And I should see "Page 1"
    And I click on "Page 1" "link" forced
    Then ".activity-navigation" "css_element" should exist
    And I visit "/admin/settings.php?section=themesettingpimenko"
    And I click on "Pimenko features" "link"
    And I set the field "s_theme_pimenko_showactivitynavigation" to "0"
    And I press "Save changes"
    And I am on "Course 1" course homepage
    And I click on "Page 1" "link" forced
    Then ".activity-navigation" "css_element" should not exist

  Scenario: Verify that course participants visibility can be controlled
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "users" exist:
      | username | firstname | lastname | email                |
      | student1 | Student   | 1        | student1@example.com |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | student1 | C1     | student        |
    And I click on "Pimenko features" "link"
    And I set the field "s_theme_pimenko_showparticipantscourse" to "0"
    And I press "Save changes"
    And I log out
    And I log in as "student1"
    And I am on "Course 1" course homepage
    Then I should not see "Participants" in the ".secondary-navigation" "css_element"
    And I log out
    And I log in as "admin"
    And I visit "/admin/settings.php?section=themesettingpimenko"
    And I click on "Pimenko features" "link"
    And I set the field "s_theme_pimenko_showparticipantscourse" to "1"
    # Select 'student' role in listuserrole (assuming shortname is student)
    And I set the field "s_theme_pimenko_listuserrole[]" to "student"
    And I press "Save changes"
    And I log out
    And I log in as "student1"
    And I am on "Course 1" course homepage
    Then I should see "Participants" in the ".secondary-navigation" "css_element"

  Scenario: Verify that hiding manual auth on login page works
    Given I click on "Login Page" "link"
    And I click on "s_theme_pimenko_hidemanuelauth" "checkbox" forced
    And I set the field "s_theme_pimenko_hidemanuelauth" to "1"
    And I press "Save changes"
    And I log out
    When I am on homepage
    And I click on "Log in" "link"
    Then ".leftloginblock" "css_element" should not exist
    And I log in as "admin"
    And I visit "/admin/settings.php?section=themesettingpimenko"
    And I click on "Login Page" "link"
    And I click on "s_theme_pimenko_hidemanuelauth" "checkbox" forced
    And I set the field "s_theme_pimenko_hidemanuelauth" to "0"
    And I press "Save changes"
    And I log out
    When I am on homepage
    And I click on "Log in" "link"
    Then ".leftloginblock" "css_element" should exist

  Scenario: Verify that footer content is displayed
    Given I click on "Footer" "link"
    And I click on "s_theme_pimenko_footerheading1" "field" forced
    And I set the field "s_theme_pimenko_footerheading1" to "Footer Column 1 Heading"
    And I set the field "s_theme_pimenko_footertext1" to "Footer Column 1 Text Content"
    And I press "Save changes"
    When I am on homepage
    Then I should see "Footer Column 1 Heading" in the "footer" "css_element"
    And I should see "Footer Column 1 Text Content" in the "footer" "css_element"

  Scenario: Verify that Pimenko Feature settings can be enabled (Catalog)
    Given I click on "Pimenko features" "link"
    And I set the field "s_theme_pimenko_enablecatalog" to "1"
    And I set the field "s_theme_pimenko_tagfilter" to "1"
    And I set the field "s_theme_pimenko_customfieldfilter" to "1"
    And I set the field "s_theme_pimenko_titlecatalog" to "Pimenko Course Catalog"
    And I set the field "s_theme_pimenko_showsubscriberscount" to "1"
    And I press "Save changes"
    When I visit "/course/index.php"
    Then I should see "Pimenko Course Catalog"
    And "#course-gallery" "css_element" should exist

  Scenario: Verify that the custom menu items are displayed in the navbar
    Given I am on homepage
    Then I should see "This is a custom item" in the "nav" "css_element"
