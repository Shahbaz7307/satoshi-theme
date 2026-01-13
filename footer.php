<footer class="site-footer">
        <!-- <div class="container">
            <div class="footer-content">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer-menu',
                        'container' => false,
                        'menu_class' => 'footer-menu',
                    )
                );
                ?>
            </div>
        </div> -->
    </footer>

    <script>
        // Category Menu Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.getElementById('categoryMenuBtn');
            const menu = document.getElementById('categoryMenu');
            const categoryToggles = document.querySelectorAll('.category-toggle');

            // Toggle main menu
            if (menuBtn && menu) {
                menuBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    menu.classList.toggle('hidden');
                });

                // Close menu when clicking outside
                document.addEventListener('click', function(e) {
                    if (!menu.contains(e.target) && !menuBtn.contains(e.target)) {
                        menu.classList.add('hidden');
                        // Close all subcategories
                        document.querySelectorAll('.subcategory-menu').forEach(sub => {
                            sub.classList.add('hidden');
                        });
                        document.querySelectorAll('.category-toggle svg').forEach(arrow => {
                            arrow.classList.remove('rotate-180');
                        });
                    }
                });
            }

            // Toggle subcategories
            categoryToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    const categoryId = this.getAttribute('data-category');
                    const submenu = document.querySelector(`.subcategory-menu[data-parent="${categoryId}"]`);
                    const arrow = this.querySelector('svg');

                    if (submenu) {
                        e.preventDefault();
                        e.stopPropagation();

                        // Close other subcategories
                        document.querySelectorAll('.subcategory-menu').forEach(sub => {
                            if (sub !== submenu) {
                                sub.classList.add('hidden');
                            }
                        });
                        document.querySelectorAll('.category-toggle svg').forEach(arr => {
                            if (arr !== arrow) {
                                arr.classList.remove('rotate-180');
                            }
                        });

                        // Toggle current subcategory
                        submenu.classList.toggle('hidden');
                        if (arrow) {
                            arrow.classList.toggle('rotate-180');
                        }
                    }
                });
            });
        });
    </script>

    <?php wp_footer(); ?>
</body>
</html>