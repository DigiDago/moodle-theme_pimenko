# Behat Test Coverage for Pimenko Theme

This document describes the functional use cases covered by automated Behat tests for the Pimenko theme. These tests ensure that the theme's features work correctly and that settings are properly saved and applied.

## 1. General Settings & Branding
- **Color Customization**: Verifies that brand colors, button colors, and text colors can be set and are correctly saved.
- **SCSS Customization**: Ensures that custom SCSS code can be added to the theme to apply advanced styling.
- **Favicon & Fonts**: Checks that a custom favicon can be uploaded and that Google Fonts can be enabled.

## 2. Navigation Bar (Navbar)
- **Site Name Visibility**: Checks the ability to show or hide the site name in the top navigation bar.
- **Custom Menu Items**: Verifies that links added via the Moodle custom menu settings appear correctly in the navigation bar.
- **Appearance**: Ensures navbar colors and text colors are correctly applied.

## 3. Frontpage Features
- **Carousel (Slideshow)**: Verifies that the frontpage carousel can be enabled or disabled, and that its settings (number of slides, images) are functional.
- **Course Information**: Checks that course details like custom fields, contacts, and start dates can be displayed on the frontpage.

## 4. Course Features
- **Activity Navigation**: Verifies that the "Previous/Next" activity buttons at the bottom of activity pages can be enabled or disabled.
- **Participants List**: Tests the ability to restrict access to the course "Participants" menu for specific roles (like students), ensuring privacy or simplified navigation when needed.

## 5. Course Catalog
- **Catalog Enablement**: Checks that the custom Pimenko course catalog view can be activated.
- **Filters**: Verifies that tag filters and custom field filters work within the catalog.
- **Display Options**: Ensures catalog titles and subscriber counts are displayed correctly.

## 6. Login Page
- **Simplified Login**: Verifies that the manual login form can be hidden (useful when using SSO/external authentication).
- **Branding**: Checks that background styles and templates for the login page are correctly applied.

## 7. Footer
- **Custom Content**: Verifies that the four custom footer columns (headings and text) are displayed correctly across the site.
- **Branding**: Ensures footer background and text colors are correctly applied.

## 8. Contact Page
- **Accessibility**: Verifies that the "Contact us" page is accessible and displays the expected content.
