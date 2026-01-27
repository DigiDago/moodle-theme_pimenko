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
 * Step definitions related to the Pimenko theme.
 *
 * @package    theme_pimenko
 * @category   test
 * @copyright  2024 Pimenko
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

require_once(__DIR__ . '/../../../../lib/behat/behat_base.php');

use Behat\Mink\Exception\ExpectationException as ExpectationException;

/**
 * Step definitions for the Pimenko theme.
 */
class behat_theme_pimenko extends behat_base {

    /**
     * Checks if the specified checkbox is checked.
     *
     * @Then /^the "(?P<checkbox_string>(?:[^"]|\\")*)" checkbox should be checked$/
     * @param string $checkbox
     * @throws ExpectationException
     */
    public function the_checkbox_should_be_checked($checkbox) {
        $node = $this->get_selected_node('checkbox', $checkbox);
        if (!$node->isChecked()) {
            throw new ExpectationException('The "' . $checkbox . '" checkbox is not checked', $this->getSession());
        }
    }

    /**
     * Checks if the specified checkbox is not checked.
     *
     * @Then /^the "(?P<checkbox_string>(?:[^"]|\\")*)" checkbox should not be checked$/
     * @param string $checkbox
     * @throws ExpectationException
     */
    public function the_checkbox_should_not_be_checked($checkbox) {
        $node = $this->get_selected_node('checkbox', $checkbox);
        if ($node->isChecked()) {
            throw new ExpectationException('The "' . $checkbox . '" checkbox is checked', $this->getSession());
        }
    }

    /**
     * Maximizes the browser window.
     *
     * @Given /^I maximize the window$/
     */
    public function i_maximize_the_window() {
        if (!$this->running_javascript()) {
            return;
        }
        $this->getSession()->getDriver()->maximizeWindow();
    }

    /**
     * Clicks the specified element after scrolling it into the middle of the viewport.
     * This is useful when fixed elements (like a navbar) might be overlapping the element.
     *
     * @When /^I click on "(?P<element_string>(?:[^"]|\\")*)" "(?P<selector_string>[^"]*)" forced$/
     * @param string $element
     * @param string $selectortype
     */
    public function i_click_on_forced($element, $selectortype) {
        $node = $this->get_selected_node($selectortype, $element);
        $this->execute_js_on_node($node, '{{ELEMENT}}.scrollIntoView({block: "center"});');
        $this->execute_js_on_node($node, '{{ELEMENT}}.click();');
    }
}
