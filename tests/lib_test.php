<?php
// This file is part of Moodle - http://moodle.org/
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

namespace theme_pimenko;

use theme_config;

/**
 * Unit tests for theme_pimenko lib.php functions.
 *
 * @package    theme_pimenko
 * @copyright  Pimenko 2024
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @covers \theme_pimenko\lib
 */
final class lib_test extends \advanced_testcase {
    /**
     * Sets up the required environment for testing.
     *
     * @return void
     */
    protected function setUp(): void {
        global $CFG;
        require_once($CFG->dirroot . '/theme/pimenko/lib.php');
        parent::setUp();
    }

    /**
     * Test theme_pimenko_hex2rgb.
     *
     * @return void
     */
    public function test_theme_pimenko_hex2rgb(): void {
        // Test with 6 characters hex.
        $this->assertEquals(
            ['r' => 255, 'g' => 255, 'b' => 255],
            theme_pimenko_hex2rgb('#FFFFFF'),
        );
        $this->assertEquals(
            ['r' => 0, 'g' => 0, 'b' => 0],
            theme_pimenko_hex2rgb('#000000'),
        );
        $this->assertEquals(
            ['r' => 255, 'g' => 0, 'b' => 0],
            theme_pimenko_hex2rgb('#FF0000'),
        );

        // Test with 3 characters hex.
        $this->assertEquals(
            ['r' => 255, 'g' => 255, 'b' => 255],
            theme_pimenko_hex2rgb('#FFF'),
        );
        $this->assertEquals(
            ['r' => 0, 'g' => 0, 'b' => 0],
            theme_pimenko_hex2rgb('#000'),
        );
        $this->assertEquals(
            ['r' => 255, 'g' => 0, 'b' => 0],
            theme_pimenko_hex2rgb('#F00'),
        );

        // Test without #.
        $this->assertEquals(
            ['r' => 255, 'g' => 255, 'b' => 255],
            theme_pimenko_hex2rgb('FFFFFF'),
        );
    }

    /**
     * Test theme_pimenko_hex2rgba.
     *
     * @return void
     */
    public function test_theme_pimenko_hex2rgba(): void {
        $this->assertEquals(
            'rgba(255, 255, 255, 0.5)',
            theme_pimenko_hex2rgba(
                '#FFFFFF',
                '0.5',
            ),
        );
        $this->assertEquals(
            'rgba(0, 0, 0, 1)',
            theme_pimenko_hex2rgba(
                '#000000',
                '1',
            ),
        );
        $this->assertEquals(
            'transparent',
            theme_pimenko_hex2rgba(
                '',
                '0.5',
            ),
        );
        $this->assertEquals(
            'transparent',
            theme_pimenko_hex2rgba(
                '#FFFFFF',
                '',
            ),
        );
    }

    /**
     * Test theme_pimenko_colorbrightness.
     *
     * This test checks the functionality of the `theme_pimenko_colorbrightness` method for both brightening
     * and darkening colors. It verifies edge cases such as pure white and black handling, as well as mid-tone adjustments.
     *
     * @return void
     */
    public function test_theme_pimenko_colorbrightness(): void {
        $this->assertEquals(
            '#80807f',
            theme_pimenko_colorbrightness(
                '#FFFFFF',
                -0.5,
            ),
        );

        $this->assertEquals(
            '#010101',
            theme_pimenko_colorbrightness(
                '#000000',
                -0.5,
            ),
        );

        $this->assertEquals(
            '#c0c0c0',
            theme_pimenko_colorbrightness(
                '#808080',
                0.5,
            ),
        );
    }

    /**
     * Test theme_pimenko_get_fontawesome_icon_map.
     *
     * @return void
     */
    public function test_theme_pimenko_get_fontawesome_icon_map(): void {
        $map = theme_pimenko_get_fontawesome_icon_map();
        $this->assertIsArray($map);
        $this->assertArrayHasKey(
            'theme_pimenko:t/check',
            $map,
        );
        $this->assertEquals(
            'fa-check',
            $map['theme_pimenko:t/check'],
        );
    }

    /**
     * Test theme_pimenko_regions.
     *
     * @return void
     */
    public function test_theme_pimenko_regions(): void {
        $regions = theme_pimenko_regions();
        $this->assertIsArray($regions);
        $this->assertContains(
            'side-pre',
            $regions,
        );
        $this->assertContains(
            'side-post',
            $regions,
        );
        $this->assertContains(
            'theme-front-a',
            $regions,
        );
        $this->assertContains(
            'theme-front-u',
            $regions,
        );
        $this->assertCount(
            23,
            $regions,
        );
    }

    /**
     * Test theme_pimenko_get_extra_scss.
     *
     * @return void
     */
    public function test_theme_pimenko_get_extra_scss(): void {
        $theme = $this->createMock(theme_config::class);
        $theme->settings = (object) [
            'scss' => '.custom { color: red; }',
        ];
        $theme->method('setting_file_url')->willReturn('http://example.com/bg.jpg');

        $extrascss = theme_pimenko_get_extra_scss($theme);
        $this->assertStringContainsString(
            '.custom { color: red; }',
            $extrascss,
        );
        $this->assertStringContainsString(
            'background-image: url(\'http://example.com/bg.jpg\')',
            $extrascss,
        );

        // Test without scss setting.
        $theme->settings->scss = '';
        $extrascss = theme_pimenko_get_extra_scss($theme);
        $this->assertStringNotContainsString(
            '.custom',
            $extrascss,
        );
        $this->assertStringContainsString(
            'background-image:',
            $extrascss,
        );

        // Test without background image.
        $theme = $this->createMock(theme_config::class);
        $theme->settings = (object) ['scss' => '.custom { color: red; }'];
        $theme->method('setting_file_url')->willReturn('');
        $extrascss = theme_pimenko_get_extra_scss($theme);
        $this->assertEquals(
            '.custom { color: red; } ',
            $extrascss,
        );
    }

    /**
     * Test theme_pimenko_get_main_scss_content.
     *
     * @return void
     */
    public function test_theme_pimenko_get_main_scss_content(): void {
        global $CFG;
        $theme = $this->createMock(theme_config::class);
        $theme->settings = (object) [
            'preset' => 'default.scss',
        ];

        $scss = theme_pimenko_get_main_scss_content($theme);
        $this->assertStringContainsString(
            'Bootstrap',
            $scss,
        );

        $theme->settings->preset = 'plain.scss';
        $scss = theme_pimenko_get_main_scss_content($theme);
        $this->assertStringContainsString(
            'plain',
            $scss,
        );

        // Test fallback to default.scss.
        $theme->settings->preset = 'nonexistent.scss';
        $scss = theme_pimenko_get_main_scss_content($theme);
        $this->assertStringContainsString(
            'Bootstrap',
            $scss,
        );
    }

    /**
     * Tests the `theme_pimenko_process_css` function to ensure it processes the CSS with
     * the provided theme settings and replaces the placeholders in the CSS with the expected values.
     *
     * This test validates that:
     * - Brand color is replaced correctly in the CSS.
     * - Navbar text color is replaced correctly.
     * - Login background image is processed with the correct file URL.
     * - Login background style is applied properly.
     * - Hover navbar color is replaced as expected.
     * - Gradient cover color is applied with correct opacity.
     *
     * @return void
     */
    public function test_theme_pimenko_process_css(): void {
        $theme = $this->createMock(theme_config::class);
        $theme->settings = (object) [
            'brandcolor' => '#123456',
            'navbartextcolor' => '#654321',
            'loginbgimage' => 'login.jpg',
            'loginbgstyle' => 'stretch',
            'hoovernavbarcolor' => '#112233',
            'gradientcovercolor' => '#AABBCC',
        ];
        $theme->method('setting_file_url')->willReturn('http://example.com/login.jpg');

        $css =
            'body { color: brandcolor; background: navbartextcolor; } .login { background: loginbgimage;
             background-size: loginbgstyle; } .hover { color: darkennavcolor; } .gradient { background: gradientcovercolor; }';
        $processed = theme_pimenko_process_css(
            $css,
            $theme,
        );

        $this->assertStringContainsString(
            '#123456',
            $processed,
        );
        $this->assertStringContainsString(
            '#654321',
            $processed,
        );
        $this->assertStringContainsString(
            'url("http://example.com/login.jpg") no-repeat center center fixed',
            $processed,
        );
        $this->assertStringContainsString(
            '100% 100%',
            $processed,
        );
        $this->assertStringContainsString(
            '#112233',
            $processed,
        );
        $this->assertStringContainsString(
            'rgba(170, 187, 204, .6)',
            $processed,
        );
    }
}
