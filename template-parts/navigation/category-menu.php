<?php

/**
 * Category Menu Navigation
 *
 * @package Satoshi_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<!-- Menu Toggle Button / Dropdown Container -->
<div id="menuWrapper" class="relative">
    <button id="categoryMenuBtn" class="flex items-center gap-2 text-lg font-medium transition-smooth bg-white px-4 py-2 rounded-lg shadow btn-hover-lift">
        <!-- Hamburger Icon (shown when closed) -->
        <svg id="hamburgerIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" aria-hidden="true" width="24" height="24" role="img">
            <path fill-rule="evenodd" d="M3 7a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 13a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
        </svg>
        <!-- Close Icon (shown when open) -->
        <svg id="closeIcon" class="hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" aria-hidden="true" width="24" height="24" role="img">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
        <span id="menuText">Menu</span>
    </button>

    <!-- Mega Menu Dropdown -->
    <div id="categoryMenu" class="hidden absolute top-full left-0 mt-2 bg-white rounded-lg shadow-2xl overflow-hidden subcategory-expand z-50">
        <div id="menuContent" class="flex">
            <!-- Categories Column -->
            <div id="categoriesColumn" class="w-full">
                <?php
                if (satoshi_is_woocommerce_active()) :
                    $parent_categories = satoshi_get_product_categories(3);

                    if ($parent_categories && !is_wp_error($parent_categories)) :
                        foreach ($parent_categories as $parent_cat) :
                            $subcategories = satoshi_get_product_subcategories($parent_cat->term_id);
                            $has_subcategories = $subcategories && !is_wp_error($subcategories) && count($subcategories) > 0;
                            $category_name = $parent_cat->name;
                            $category_link = get_term_link($parent_cat);
                ?>
                    <button
                        class="category-item w-full px-6 py-4 text-left hover:bg-gray-50 flex justify-between items-center transition-colors"
                        data-category="<?php echo esc_attr($parent_cat->term_id); ?>"
                        data-category-name="<?php echo esc_attr($category_name); ?>"
                        data-category-link="<?php echo esc_url($category_link); ?>"
                        data-has-subcategories="<?php echo $has_subcategories ? 'true' : 'false'; ?>"
                        aria-label="<?php echo esc_attr(sprintf(__('View %s category', 'satoshi-theme'), $category_name)); ?>">
                        <span class="text-base text-gray-700"><?php echo esc_html($category_name); ?></span>
                        <?php if ($has_subcategories) : ?>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        <?php endif; ?>
                    </button>

                    <!-- Subcategories (hidden, will be shown on right) -->
                    <?php if ($has_subcategories) : ?>
                        <div class="subcategory-list hidden" data-parent="<?php echo esc_attr($parent_cat->term_id); ?>">
                            <?php foreach ($subcategories as $subcat) : ?>
                                <a
                                    href="<?php echo esc_url(get_term_link($subcat)); ?>"
                                    class="subcategory-link"
                                    data-name="<?php echo esc_attr($subcat->name); ?>"
                                    aria-label="<?php echo esc_attr($subcat->name); ?>">
                                    <?php echo esc_html($subcat->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php
                        endforeach;
                    endif;
                else : ?>
                    <div class="px-6 py-4 text-gray-500">
                        <?php esc_html_e('Please install and activate WooCommerce.', 'satoshi-theme'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Subcategories Column (initially hidden) -->
            <div id="subcategoriesColumn" class="w-0 overflow-hidden border-l border-gray-100 transition-all duration-300">
                <div class="w-80 p-6">
                    <!-- Category header with View all link -->
                    <div class="flex justify-between items-center mb-4 pb-3">
                        <h3 id="currentCategoryName" class="text-lg font-medium"></h3>
                        <a id="viewAllLink" href="#" class="text-sm text-gray-600 hover:text-gray-900 flex items-center gap-1">
                            View all
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    <!-- Subcategories list -->
                    <div id="subcategoriesList" class="space-y-2">
                        <!-- Populated by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Overlay for closing menu when clicking outside -->
<div id="menuOverlay" class="hidden fixed inset-0 bg-black/30 z-40"></div>