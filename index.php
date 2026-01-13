<?php
get_header();
?>

<div class="container">
    <!-- <main id="main-content">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    </header>
                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
                <?php
            endwhile;

            the_posts_pagination();

        else :
            echo '<p>No posts found</p>';
        endif;
        ?>
    </main> -->
</div>

<?php
get_footer();
?>