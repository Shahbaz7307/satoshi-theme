<?php
/**
 * WooCommerce Compatibility
 *
 * @package Satoshi_Theme
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Add WooCommerce support
 */
function satoshi_woocommerce_setup() {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'satoshi_woocommerce_setup');

/**
 * Get product categories for navigation
 *
 * @param int $limit Number of parent categories to retrieve
 * @return array|WP_Error Array of term objects or WP_Error on failure
 */
function satoshi_get_product_categories($limit = 3) {
    if (!class_exists('WooCommerce')) {
        return array();
    }

    // Get the uncategorized category to exclude it
    $uncategorized = get_term_by('slug', 'uncategorized', 'product_cat');
    $exclude = array();

    if ($uncategorized) {
        $exclude[] = $uncategorized->term_id;
    }

    return get_terms(array(
        'taxonomy' => 'product_cat',
        'parent' => 0,
        'hide_empty' => false,
        'number' => $limit,
        'exclude' => $exclude,
        'orderby' => 'name',
        'order' => 'ASC'
    ));
}

/**
 * Get product subcategories
 *
 * @param int $parent_id Parent category ID
 * @return array|WP_Error Array of term objects or WP_Error on failure
 */
function satoshi_get_product_subcategories($parent_id) {
    if (!class_exists('WooCommerce')) {
        return array();
    }

    return get_terms(array(
        'taxonomy' => 'product_cat',
        'parent' => $parent_id,
        'hide_empty' => false
    ));
}

/**
 * Check if WooCommerce is active
 *
 * @return bool
 */
function satoshi_is_woocommerce_active() {
    return class_exists('WooCommerce');
}

/**
 * Get cart count
 *
 * @return int
 */
function satoshi_get_cart_count() {
    if (!satoshi_is_woocommerce_active()) {
        return 0;
    }
    return WC()->cart->get_cart_contents_count();
}

/**
 * Add cart fragments for AJAX cart update
 */
function satoshi_cart_fragments($fragments) {
    ob_start();
    $cart_count = satoshi_get_cart_count();
    ?>
    <span id="cartCount" class="absolute -top-1 -right-1 bg-black text-white text-xs w-5 h-5 rounded-full flex items-center justify-center <?php echo $cart_count > 0 ? 'cart-badge-enter' : 'hidden'; ?>">
        <?php echo $cart_count; ?>
    </span>
    <?php
    $fragments['#cartCount'] = ob_get_clean();

    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'satoshi_cart_fragments');
