<!-- trending products -->
<section class="py-20 w-full space-y-6 max-w-screen-2xl px-6 mx-auto">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-bold">Trending now</h2>
        <div class="flex gap-2">
            <button class="ScrollLeft rotate-180 border rounded-md p-2 hover:bg-gray-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" width="24" height="24" role="img">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg>
            </button>
            <button class="ScrollRight border rounded-md p-2 hover:bg-gray-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" width="24" height="24" role="img">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg>
            </button>
        </div>
    </div>
    <div class="flex gap-5 sliderScroller overflow-x-auto scrollbar-hide">
        <?php
        $args = array(
            'limit' => -1, // Retrieve all products
            'status' => 'publish' // Only published products
        );
        $products = wc_get_products($args);

        // echo '<pre>';
        // print_r($products);
        foreach ($products as $product) {
        ?>
            <div class="min-w-[300px]">
                <div class="rounded-md overflow-hidden">
                    <?php
                    $image_id = $product->get_image_id();
                    $image_url = wp_get_attachment_image_url($image_id, 'full');
                    ?>
                    <img src="<?php echo $image_url ?>" alt="product image">
                </div>
                <div>
                    <h4 class="text-xl text-gray-700"><?php echo $product->get_name() ?></h4>
                    <p>
                        <?php
                        $product_id = $product->get_id();
                        $terms = get_the_terms($product_id, 'product_cat');
                        $subcategories = [];
                        foreach ($terms as $term) {
                            // Only subcategories (parent != 0)
                            if ($term->parent != 0) {
                                $subcategories[] = esc_html($term->name);
                            }
                        }

                        if (!empty($subcategories)) {
                            echo implode(', ', $subcategories);
                        }

                        ?>
                    </p>
                    <div>
                        <?php
                        $product_attributes = $product->get_attributes();
                        $colors = $product_attributes['color']['options'];
                        foreach ($colors as $color) {
                            echo $color . ' ';
                        }
                        ?>
                    </div>
                    <p>As low as <?php echo wc_price($product->get_price()) ?></p>
                </div>
            </div>
        <?php } ?>

    </div>
</section>