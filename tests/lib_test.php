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

/**
 * Unit tests for the lib.php file.
 *
 * @package    theme_pimenko
 * @copyright  Pimenko 2024
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Unit tests for theme_pimenko lib.php functions.
 *
 * @package    theme_pimenko
 * @copyright  Pimenko 2024
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class theme_pimenko_lib_testcase extends advanced_testcase {

    /**
     * Set up the test.
     */
    protected function setUp(): void {
        global $CFG;
        require_once($CFG->dirroot . '/theme/pimenko/lib.php');
        parent::setUp();
    }

    /**
     * Test theme_pimenko_hex2rgb.
     */
    public function test_theme_pimenko_hex2rgb() {
        // Test with 6 characters hex.
        $this->assertEquals(['r' => 255, 'g' => 255, 'b' => 255], theme_pimenko_hex2rgb('#FFFFFF'));
        $this->assertEquals(['r' => 0, 'g' => 0, 'b' => 0], theme_pimenko_hex2rgb('#000000'));
        $this->assertEquals(['r' => 255, 'g' => 0, 'b' => 0], theme_pimenko_hex2rgb('#FF0000'));

        // Test with 3 characters hex.
        $this->assertEquals(['r' => 255, 'g' => 255, 'b' => 255], theme_pimenko_hex2rgb('#FFF'));
        $this->assertEquals(['r' => 0, 'g' => 0, 'b' => 0], theme_pimenko_hex2rgb('#000'));
        $this->assertEquals(['r' => 255, 'g' => 0, 'b' => 0], theme_pimenko_hex2rgb('#F00'));

        // Test without #.
        $this->assertEquals(['r' => 255, 'g' => 255, 'b' => 255], theme_pimenko_hex2rgb('FFFFFF'));
    }

    /**
     * Test theme_pimenko_hex2rgba.
     */
    public function test_theme_pimenko_hex2rgba() {
        $this->assertEquals('rgba(255, 255, 255, 0.5)', theme_pimenko_hex2rgba('#FFFFFF', '0.5'));
        $this->assertEquals('rgba(0, 0, 0, 1)', theme_pimenko_hex2rgba('#000000', '1'));
        $this->assertEquals('transparent', theme_pimenko_hex2rgba('', '0.5'));
        $this->assertEquals('transparent', theme_pimenko_hex2rgba('#FFFFFF', ''));
    }

    /**
     * Test theme_pimenko_colorbrightness.
     */
    public function test_theme_pimenko_colorbrightness() {
        // Test darkening.
        // #FFFFFF is handled specially to #FFFFFE then darkened.
        // #FFFFFE = [255, 255, 254]
        // Darken 50% (-0.5) -> [128, 128, 127] -> #80807f
        $this->assertEquals('#80807f', theme_pimenko_colorbrightness('#FFFFFF', -0.5));

        // #000000 is handled specially to #010101 then darkened.
        // #010101 = [1, 1, 1]
        // Darken 50% (-0.5) -> [1, 1, 1] * 0.5 = [0.5, 0.5, 0.5] -> round -> [1, 1, 1] -> #010101
        $this->assertEquals('#010101', theme_pimenko_colorbrightness('#000000', -0.5));

        // Test brightening.
        // #808080 = [128, 128, 128]
        // Brighten 50% (0.5) -> round(128 * 0.5) + round(255 * 0.5) = 64 + 128 = 192 -> #c0c0c0
        $this->assertEquals('#c0c0c0', theme_pimenko_colorbrightness('#808080', 0.5));
    }

    /**
     * Test theme_pimenko_get_fontawesome_icon_map.
     */
    public function test_theme_pimenko_get_fontawesome_icon_map() {
        $map = theme_pimenko_get_fontawesome_icon_map();
        $this->assertIsArray($map);
        $this->assertArrayHasKey('theme_pimenko:t/check', $map);
        $this->assertEquals('fa-check', $map['theme_pimenko:t/check']);
    }

    /**
     * Test theme_pimenko_regions.
     */
    public function test_theme_pimenko_regions() {
        $regions = theme_pimenko_regions();
        $this->assertIsArray($regions);
        $this->assertContains('side-pre', $regions);
        $this->assertContains('side-post', $regions);
        $this->assertContains('theme-front-a', $regions);
        $this->assertContains('theme-front-u', $regions);
        $this->assertCount(23, $regions); // side-pre, side-post + a to u (21) = 23
    }

    /**
     * Test theme_pimenko_get_extra_scss.
     */
    public function test_theme_pimenko_get_extra_scss() {
        $theme = $this->createMock(theme_config::class);
        $theme->settings = (object)[
            'scss' => '.custom { color: red; }'
        ];
        $theme->method('setting_file_url')->willReturn('http://example.com/bg.jpg');

        $extra_scss = theme_pimenko_get_extra_scss($theme);
        $this->assertStringContainsString('.custom { color: red; }', $extra_scss);
        $this->assertStringContainsString('background-image: url(\'http://example.com/bg.jpg\')', $extra_scss);

        // Test without scss setting.
        $theme->settings->scss = '';
        $extra_scss = theme_pimenko_get_extra_scss($theme);
        $this->assertStringNotContainsString('.custom', $extra_scss);
        $this->assertStringContainsString('background-image:', $extra_scss);

        // Test without background image.
        $theme = $this->createMock(theme_config::class);
        $theme->settings = (object)['scss' => '.custom { color: red; }'];
        $theme->method('setting_file_url')->willReturn('');
        $extra_scss = theme_pimenko_get_extra_scss($theme);
        $this->assertEquals('.custom { color: red; } ', $extra_scss);
    }

    /**
     * Test theme_pimenko_get_main_scss_content.
     */
    public function test_theme_pimenko_get_main_scss_content() {
        global $CFG;
        $theme = $this->createMock(theme_config::class);
        $theme->settings = (object)[
            'preset' => 'default.scss'
        ];

        $scss = theme_pimenko_get_main_scss_content($theme);
        $this->assertStringContainsString('Bootstrap', $scss); // default.scss should contain Bootstrap

        $theme->settings->preset = 'plain.scss';
        $scss = theme_pimenko_get_main_scss_content($theme);
        $this->assertStringContainsString('plain', $scss);

        // Test fallback to default.scss.
        $theme->settings->preset = 'nonexistent.scss';
        $scss = theme_pimenko_get_main_scss_content($theme);
        $this->assertStringContainsString('Bootstrap', $scss);
    }

    /**
     * Test theme_pimenko_process_css.
     */
    public function test_theme_pimenko_process_css() {
        $theme = $this->createMock(theme_config::class);
        $theme->settings = (object)[
            'brandcolor' => '#123456',
            'navbartextcolor' => '#654321',
            'loginbgimage' => 'login.jpg',
            'loginbgstyle' => 'stretch',
            'hoovernavbarcolor' => '#112233',
            'gradientcovercolor' => '#AABBCC'
        ];
        $theme->method('setting_file_url')->willReturn('http://example.com/login.jpg');

        $css = 'body { color: brandcolor; background: navbartextcolor; } .login { background: loginbgimage; background-size: loginbgstyle; } .hover { color: darkennavcolor; } .gradient { background: gradientcovercolor; }';
        $processed = theme_pimenko_process_css($css, $theme);

        $this->assertStringContainsString('#123456', $processed);
        $this->assertStringContainsString('#654321', $processed);
        $this->assertStringContainsString('url("http://example.com/login.jpg") no-repeat center center fixed', $processed);
        $this->assertStringContainsString('100% 100%', $processed);
        $this->assertStringContainsString('#112233', $processed);
        $this->assertStringContainsString('rgba(170, 187, 204, .6)', $processed);
    }
}
