<!-- Product Categories -->
<section class="py-20 w-full space-y-6 max-w-screen-2xl px-6 mx-auto">
    <?php
    $parent_cat  = get_term_by('slug', 'men', 'product_cat');

    $subcategories = get_terms([
        'taxonomy'   => 'product_cat',
        'hide_empty' => false,
        'parent'     => $parent_cat->term_id,
    ]);
    ?>

    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-bold">Explore the categories</h2>
        <div class="flex gap-2">
            <button id="categoryScrollLeft" class="ScrollLeft rotate-180 border rounded-md p-2 hover:bg-gray-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" width="24" height="24" role="img">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg>
            </button>
            <button id="categoryScrollRight" class="ScrollRight border rounded-md p-2 hover:bg-gray-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" width="24" height="24" role="img">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg>
            </button>
        </div>
    </div>

    <div id="categoryScroller" class="sliderScroller flex gap-5 whitespace-nowrap overflow-x-auto scrollbar-hide" style="scroll-behavior: smooth;">
        <!-- View All Link -->
        <a href="" class="px-5 py-2.5 border rounded-md rounded text-base text-gray-700">
            View All
        </a>

        <!-- Subcategories -->
        <?php if (!empty($subcategories) && !is_wp_error($subcategories)) : ?>
            <?php foreach ($subcategories as $subcategory) : ?>
                <a href="<?php echo esc_url(get_term_link($subcategory)); ?>"
                    class="px-5 py-2.5 border border-gray-200 rounded-md hover:border-gray-700 text-base text-gray-700">
                    <?php echo esc_html($subcategory->name); ?>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>