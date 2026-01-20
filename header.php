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
    <header id="siteHeader" class="site-header fixed w-full top-0 z-50 transition-all duration-300">
        <div class="w-full max-w-screen-2xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="w-1/3 relative">
                    <?php get_template_part('template-parts/navigation/category-menu'); ?>
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
                    <?php get_template_part('template-parts/header/header-actions'); ?>
                </div>
            </div>
        </div>
    </header>