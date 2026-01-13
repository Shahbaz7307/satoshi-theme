<?php
/**
 * Theme Setup
 *
 * @package Satoshi_Theme
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function satoshi_theme_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');

    // Register navigation menus
    register_nav_menus(
        array(
            'primary-menu' => esc_html__('Primary Menu', 'satoshi-theme'),
            'footer-menu' => esc_html__('Footer Menu', 'satoshi-theme')
        )
    );

    // Switch default core markup to output valid HTML5
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script'
        )
    );

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add title tag support
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'satoshi_theme_setup');

/**
 * Register widget areas.
 */
function satoshi_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'satoshi-theme'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'satoshi-theme'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'satoshi_widgets_init');
