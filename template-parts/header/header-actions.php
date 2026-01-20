<?php

/**
 * Header Actions - Search, Account, Cart
 *
 * @package Satoshi_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="header-actions flex items-center justify-end gap-3">
    <!-- Search Icon/Bar -->
    <div id="searchWrapper" class="relative">
        <button id="searchToggle" class="w-12 h-12 bg-white rounded-lg shadow flex items-center justify-center transition-smooth btn-hover-lift">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" width="24" height="24" role="img">
                <path d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z">
                </path>
            </svg>
        </button>

        <!-- Expanded Search Bar (hidden by default) -->
        <div id="searchBar" class="hidden fixed top-0 left-0 right-0 z-50 bg-white shadow-lg">
            <div class="w-full max-w-screen-2xl mx-auto px-4 py-4">
                <div class="flex items-center gap-4">
                    <div class="flex-1 flex items-center gap-3 bg-white rounded-lg px-4 py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" width="24" height="24" role="img">
                            <path d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z">
                            </path>
                        </svg>
                        <input
                            type="search"
                            id="searchInput"
                            placeholder="Search"
                            class="flex-1 outline-none text-lg"
                            autocomplete="off">
                    </div>
                    <button id="searchClose" class="text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Icon -->
    <div id="accountWrapper" class="relative">
        <button id="accountToggle" class="w-12 h-12 bg-white rounded-lg shadow flex items-center justify-center transition-smooth btn-hover-lift">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" width="24" height="24" role="img">
                <path d="M12.004 2a5 5 0 1 0 0 10 5 5 0 0 0 0-10Zm0 8a3 3 0 1 1 0-6 3 3 0 0 1 0 6Zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1h2Z"></path>
            </svg>
        </button>

        <!-- Account Dropdown -->
        <div id="accountDropdown" class="hidden absolute top-full right-0 mt-2 bg-white rounded-lg shadow-xl min-w-[200px] py-2 z-50">
            <div class="px-4 py-2">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" width="24" height="24" role="img">
                        <path d="M12.004 2a5 5 0 1 0 0 10 5 5 0 0 0 0-10Zm0 8a3 3 0 1 1 0-6 3 3 0 0 1 0 6Zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1h2Z"></path>
                    </svg>
                    <span class="font-medium">Account</span>
                </div>
            </div>
            <?php
            $dropdown_link_class = 'block px-4 py-2 hover:bg-gray-50 transition-colors';

            if (is_user_logged_in()) :
                $account_links = array(
                    array(
                        'url' => satoshi_is_woocommerce_active() ? wc_get_account_endpoint_url('dashboard') : home_url('/my-account'),
                        'text' => __('My Account', 'satoshi-theme')
                    ),
                    array(
                        'url' => satoshi_is_woocommerce_active() ? wc_get_account_endpoint_url('orders') : home_url('/my-account/orders'),
                        'text' => __('Orders', 'satoshi-theme')
                    ),
                    array(
                        'url' => wp_logout_url(home_url()),
                        'text' => __('Logout', 'satoshi-theme')
                    )
                );
            else :
                $account_url = satoshi_is_woocommerce_active() ? wc_get_page_permalink('myaccount') : wp_login_url();
                $account_links = array(
                    array(
                        'url' => $account_url,
                        'text' => __('Sign In', 'satoshi-theme')
                    ),
                    array(
                        'url' => $account_url,
                        'text' => __('Create an Account', 'satoshi-theme')
                    )
                );
            endif;

            foreach ($account_links as $link) :
            ?>
                <a href="<?php echo esc_url($link['url']); ?>" class="<?php echo esc_attr($dropdown_link_class); ?>">
                    <?php echo esc_html($link['text']); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Shopping Cart Icon -->
    <div id="cartWrapper" class="relative">
        <button id="cartToggle" class="w-12 h-12 bg-white rounded-lg shadow flex items-center justify-center transition-smooth btn-hover-lift relative">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" width="24" height="24" role="img">
                <path d="M5 22h14c1.103 0 2-.897 2-2V9a1 1 0 0 0-1-1h-3V7c0-2.757-2.243-5-5-5S7 4.243 7 7v1H4a1 1 0 0 0-1 1v11c0 1.103.897 2 2 2zM9 7c0-1.654 1.346-3 3-3s3 1.346 3 3v1H9V7zm-4 3h2v2h2v-2h6v2h2v-2h2l.002 10H5V10z">
                </path>
            </svg>
            <?php
            $cart_count = satoshi_get_cart_count();
            if ($cart_count > 0) :
            ?>
                <span id="cartCount" class="absolute -top-1 -right-1 bg-black text-white text-xs w-5 h-5 rounded-full flex items-center justify-center cart-badge-enter">
                    <?php echo esc_html($cart_count); ?>
                </span>
            <?php endif; ?>
        </button>

        <!-- Cart Dropdown -->
        <div id="cartDropdown" class="hidden absolute top-full right-0 mt-2 bg-white rounded-lg shadow-xl w-80 z-50">
            <div class="px-4 py-3">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" width="24" height="24" role="img">
                        <path d="M5 22h14c1.103 0 2-.897 2-2V9a1 1 0 0 0-1-1h-3V7c0-2.757-2.243-5-5-5S7 4.243 7 7v1H4a1 1 0 0 0-1 1v11c0 1.103.897 2 2 2zM9 7c0-1.654 1.346-3 3-3s3 1.346 3 3v1H9V7zm-4 3h2v2h2v-2h6v2h2v-2h2l.002 10H5V10z">
                        </path>
                    </svg>
                    <span class="font-medium">Shopping cart</span>
                </div>
            </div>
            <div id="cartContent" class="p-4">
                <?php if (satoshi_is_woocommerce_active()) : ?>
                    <?php if (WC()->cart->is_empty()) : ?>
                        <p class="text-gray-500 text-sm"><?php esc_html_e('You did not add any products to cart yet!', 'satoshi-theme'); ?></p>
                    <?php else : ?>
                        <div class="space-y-3 max-h-64 overflow-y-auto">
                            <?php
                            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
                                $product = $cart_item['data'];
                                $product_id = $cart_item['product_id'];
                                $thumbnail = get_the_post_thumbnail_url($product_id, 'thumbnail');
                                $product_name = $product->get_name();
                                $quantity = $cart_item['quantity'];
                            ?>
                                <div class="flex gap-3 pb-3 border-b last:border-b-0">
                                    <?php if ($thumbnail) : ?>
                                        <img
                                            src="<?php echo esc_url($thumbnail); ?>"
                                            alt="<?php echo esc_attr($product_name); ?>"
                                            class="w-16 h-16 object-cover rounded"
                                            loading="lazy">
                                    <?php endif; ?>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-medium truncate"><?php echo esc_html($product_name); ?></h4>
                                        <p class="text-xs text-gray-500">
                                            <?php printf(esc_html__('Qty: %s', 'satoshi-theme'), $quantity); ?>
                                        </p>
                                        <p class="text-sm font-medium"><?php echo wp_kses_post(WC()->cart->get_product_price($product)); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-4 pt-4 border-t">
                            <div class="flex justify-between mb-3">
                                <span class="font-medium"><?php esc_html_e('Subtotal:', 'satoshi-theme'); ?></span>
                                <span class="font-bold"><?php echo wp_kses_post(WC()->cart->get_cart_subtotal()); ?></span>
                            </div>
                            <a href="<?php echo esc_url(wc_get_cart_url()); ?>"
                               class="block w-full bg-black text-white text-center py-2 rounded-lg hover:bg-gray-800 transition-colors mb-2">
                                <?php esc_html_e('View Cart', 'satoshi-theme'); ?>
                            </a>
                            <a href="<?php echo esc_url(wc_get_checkout_url()); ?>"
                               class="block w-full bg-gray-200 text-black text-center py-2 rounded-lg hover:bg-gray-300 transition-colors">
                                <?php esc_html_e('Checkout', 'satoshi-theme'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <p class="text-gray-500 text-sm"><?php esc_html_e('Please install WooCommerce.', 'satoshi-theme'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Overlay for dropdowns -->
<div id="headerOverlay" class="hidden fixed inset-0 bg-black/30 z-40"></div>