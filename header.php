<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header class="site-header">
        <div class="w-full max-w-screen-2xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="w-1/3 relative">
                    <!-- Hamburger Button -->
                    <button id="categoryMenuBtn" class="flex items-center gap-2 text-lg font-medium hover:opacity-70 transition-opacity">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <span>Categories</span>
                    </button>

                    <!-- Category Dropdown Menu -->
                    <div id="categoryMenu" class="hidden absolute top-full left-0 mt-2 bg-white shadow-lg rounded-lg min-w-[300px] z-50">
                        <?php if (class_exists('WooCommerce')) :
                            $parent_categories = get_terms(array(
                                'taxonomy' => 'product_cat',
                                'parent' => 0,
                                'hide_empty' => false,
                                'number' => 3
                            ));

                            if ($parent_categories && !is_wp_error($parent_categories)) :
                                foreach ($parent_categories as $parent_cat) :
                                    $subcategories = get_terms(array(
                                        'taxonomy' => 'product_cat',
                                        'parent' => $parent_cat->term_id,
                                        'hide_empty' => false
                                    ));
                        ?>
                            <div class="border-b last:border-b-0">
                                <button class="category-toggle w-full px-6 py-4 text-left font-medium hover:bg-gray-50 flex justify-between items-center" data-category="<?php echo esc_attr($parent_cat->term_id); ?>">
                                    <a href="<?php echo esc_url(get_term_link($parent_cat)); ?>" class="flex-1">
                                        <?php echo esc_html($parent_cat->name); ?>
                                    </a>
                                    <?php if ($subcategories && !is_wp_error($subcategories) && count($subcategories) > 0) : ?>
                                        <svg class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    <?php endif; ?>
                                </button>

                                <?php if ($subcategories && !is_wp_error($subcategories) && count($subcategories) > 0) : ?>
                                    <div class="subcategory-menu hidden bg-gray-50 px-6 py-2" data-parent="<?php echo esc_attr($parent_cat->term_id); ?>">
                                        <?php foreach ($subcategories as $subcat) : ?>
                                            <a href="<?php echo esc_url(get_term_link($subcat)); ?>" class="block py-2 px-4 hover:bg-gray-100 rounded">
                                                <?php echo esc_html($subcat->name); ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php
                                endforeach;
                            endif;
                        else : ?>
                            <div class="px-6 py-4 text-gray-500">
                                Please install and activate WooCommerce to display product categories.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="w-1/3">
                    <div class="site-branding text-center">
                        <h1 class="site-title text-4xl font-bold uppercase">
                            <a href="<?php echo esc_url(home_url('/')); ?>">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h1>
                    </div>
                </div>
                <div class="w-1/3">
                    <div class="text-end">test</div>
                </div>
            </div>
        </div>
    </header>