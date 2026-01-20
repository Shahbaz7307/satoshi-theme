<?php

use SimplePie\Category;

get_header();



?>

<div class="">
    <main id="main-content">
        <?php get_template_part('template-parts/content/home/hero'); ?>

        <?php get_template_part('template-parts/content/home/product-category'); ?>

        <?php get_template_part('template-parts/content/home/trending-product'); ?>

        <?php get_template_part('template-parts/content/home/fall-collection'); ?>
    </main>
</div>

<?php
get_footer();
?>