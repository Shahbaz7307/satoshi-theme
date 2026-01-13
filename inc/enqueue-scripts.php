<?php
/**
 * Enqueue Scripts and Styles
 *
 * @package Satoshi_Theme
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Enqueue scripts and styles.
 */
function satoshi_enqueue_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('satoshi-theme-style', get_stylesheet_uri(), array(), '1.0.0');

    // Enqueue custom JavaScript
    wp_enqueue_script(
        'satoshi-theme-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        '1.0.0',
        true
    );

    // Enqueue comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'satoshi_enqueue_scripts');
