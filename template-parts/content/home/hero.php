<?php
$hero_title = get_field('hero_title');
$hero_description = get_field('hero_description');
$hero_bg_image = get_field('hero_bg_image');
$hero_bg_video = get_field('hero_bg_video');
?>

<!-- hero section -->
<section class="h-[80vh] flex justify-start items-center relative overflow-hidden">

    <!-- Video background -->
    <?php if ($hero_bg_video) : ?>
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
            <source src="<?php echo esc_url($hero_bg_video['url']); ?>" type="video/mp4">
        </video>

        <!-- Image fallback -->
    <?php elseif ($hero_bg_image) : ?>
        <div class="absolute inset-0 bg-cover bg-center" style="background-image:url('<?php echo esc_url($hero_bg_image['url']); ?>')"></div>
    <?php endif; ?>

    <!-- Overlay -->
    <div class="bg-black/10 w-full h-full absolute inset-0 z-10"></div>

    <!-- Content -->
    <div class="w-full max-w-screen-2xl mx-auto space-y-6 z-20 px-6">
        <h1 class="text-5xl font-bold"><?php echo esc_html($hero_title); ?></h1>
        <p><?php echo esc_html($hero_description); ?></p>
        <a href="#" class="bg-white text-black p-4 rounded-md mt-5 inline-block">Shop now</a>
    </div>

</section>