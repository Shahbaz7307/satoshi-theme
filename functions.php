<?php
/**
 * Satoshi Theme Functions
 *
 * @package Satoshi_Theme
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Define theme constants
 */
define('SATOSHI_THEME_VERSION', '1.0.0');
define('SATOSHI_THEME_DIR', get_template_directory());
define('SATOSHI_THEME_URI', get_template_directory_uri());

/**
 * Include theme files
 */
require_once SATOSHI_THEME_DIR . '/inc/theme-setup.php';
require_once SATOSHI_THEME_DIR . '/inc/enqueue-scripts.php';
require_once SATOSHI_THEME_DIR . '/inc/woocommerce.php';
