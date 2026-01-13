<?php
function custom_starter_theme_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');

    // Register navigation menus
    register_nav_menus(
        array(
            'primary-menu' => esc_html__('Primary Menu', 'custom-starter-theme'),
            'footer-menu' => esc_html__('Footer Menu', 'custom-starter-theme')
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
}
add_action('after_setup_theme', 'custom_starter_theme_setup');

// Enqueue scripts and styles
function custom_starter_theme_scripts() {
    wp_enqueue_style('custom-starter-theme-style', get_stylesheet_uri());
    
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'custom_starter_theme_scripts');

// Register widget areas
function custom_starter_theme_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'custom-starter-theme'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'custom-starter-theme'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'custom_starter_theme_widgets_init');