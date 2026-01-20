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

    // Enqueue animations CSS
    wp_enqueue_style(
        'satoshi-animations',
        get_template_directory_uri() . '/assets/css/animations.css',
        array('satoshi-theme-style'),
        '1.0.0'
    );

    // Enqueue GSAP from CDN
    wp_enqueue_script(
        'gsap',
        'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js',
        array(),
        '3.12.5',
        true
    );

    // Enqueue custom JavaScript (depends on GSAP)
    wp_enqueue_script(
        'satoshi-theme-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array('gsap'),
        '1.0.0',
        true
    );

    // Enqueue comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'satoshi_enqueue_scripts');
