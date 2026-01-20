/**
 * Satoshi Theme Main JavaScript
 *
 * @package Satoshi_Theme
 */

(function () {
  "use strict";

  /**
   * Mega Menu Navigation with GSAP
   */
  document.addEventListener("DOMContentLoaded", function () {
    const menuBtn = document.getElementById("categoryMenuBtn");
    const menu = document.getElementById("categoryMenu");
    const menuOverlay = document.getElementById("menuOverlay");
    const subcategoriesColumn = document.getElementById("subcategoriesColumn");
    const hamburgerIcon = document.getElementById("hamburgerIcon");
    const closeIcon = document.getElementById("closeIcon");
    const menuText = document.getElementById("menuText");
    const categoryItems = document.querySelectorAll(".category-item");
    const subcategoriesList = document.getElementById("subcategoriesList");
    const currentCategoryName = document.getElementById("currentCategoryName");
    const viewAllLink = document.getElementById("viewAllLink");

    if (!menuBtn || !menu) return;

    /**
     * Toggle menu open/close
     */
    function toggleMenu() {
      const isHidden = menu.classList.contains("hidden");

      if (isHidden) {
        openMenu();
      } else {
        closeMenu();
      }
    }

    /**
     * Open menu with GSAP
     */
    function openMenu() {
      menu.classList.remove("hidden");
      menuOverlay.classList.remove("hidden");

      const tl = gsap.timeline();

      tl.fromTo(
        menuOverlay,
        { opacity: 0 },
        { opacity: 1, duration: 0.2, ease: "power2.out" }
      )
        .fromTo(
          menu,
          { opacity: 0, y: -10, scale: 0.95 },
          { opacity: 1, y: 0, scale: 1, duration: 0.3, ease: "power2.out" },
          "-=0.1"
        )
        .fromTo(
          categoryItems,
          { opacity: 0, x: -20 },
          {
            opacity: 1,
            x: 0,
            duration: 0.4,
            stagger: 0.1,
            ease: "power2.out",
          },
          "-=0.2"
        );

      gsap.to(hamburgerIcon, {
        opacity: 0,
        duration: 0.2,
        onComplete: () => hamburgerIcon.classList.add("hidden"),
      });
      gsap.fromTo(
        closeIcon,
        { opacity: 0, scale: 0.8, rotation: -90 },
        {
          opacity: 1,
          scale: 1,
          rotation: 0,
          duration: 0.3,
          ease: "back.out(1.4)",
          onStart: () => closeIcon.classList.remove("hidden"),
        }
      );

      menuText.textContent = "Close";
      collapseSubcategories();
    }

    /**
     * Close menu with GSAP
     */
    function closeMenu() {
      const tl = gsap.timeline({
        onComplete: () => {
          menu.classList.add("hidden");
          menuOverlay.classList.add("hidden");
        },
      });

      tl.to(menu, { opacity: 0, y: -10, duration: 0.2, ease: "power2.in" }).to(
        menuOverlay,
        { opacity: 0, duration: 0.15, ease: "power2.in" },
        "-=0.1"
      );

      gsap.to(closeIcon, {
        opacity: 0,
        duration: 0.2,
        onComplete: () => closeIcon.classList.add("hidden"),
      });
      gsap.fromTo(
        hamburgerIcon,
        { opacity: 0, scale: 0.8 },
        {
          opacity: 1,
          scale: 1,
          duration: 0.3,
          onStart: () => hamburgerIcon.classList.remove("hidden"),
        }
      );

      menuText.textContent = "Menu";
      collapseSubcategories();
    }

    /**
     * Collapse subcategories column with GSAP
     */
    function collapseSubcategories() {
      gsap.to(subcategoriesColumn, {
        width: 0,
        duration: 0.3,
        ease: "power2.inOut",
      });
      categoryItems.forEach((item) =>
        item.classList.remove("bg-gray-50", "category-item-active")
      );
    }

    /**
     * Expand to show subcategories with GSAP
     */
    function expandSubcategories() {
      gsap.to(subcategoriesColumn, {
        width: "320px", // w-80 = 20rem = 320px
        duration: 0.3,
        ease: "power2.inOut",
      });
    }

    /**
     * Load subcategories for a category
     */
    function loadCategorySubcategories(categoryElement) {
      const categoryId = categoryElement.getAttribute("data-category");
      const categoryName = categoryElement.getAttribute("data-category-name");
      const categoryLink = categoryElement.getAttribute("data-category-link");
      const hasSubcategories =
        categoryElement.getAttribute("data-has-subcategories") === "true";
      const subcategoryList = document.querySelector(
        `.subcategory-list[data-parent="${categoryId}"]`
      );

      // If no subcategories, just navigate to the category
      if (!hasSubcategories) {
        window.location.href = categoryLink;
        return;
      }

      // Update active state
      categoryItems.forEach((item) => {
        item.classList.remove("bg-gray-50", "category-item-active");
      });
      categoryElement.classList.add("bg-gray-50", "category-item-active");

      // Expand to two columns
      expandSubcategories();

      // Update category name and view all link
      currentCategoryName.textContent = categoryName;
      viewAllLink.href = categoryLink;

      // Clear and populate subcategories
      subcategoriesList.innerHTML = "";

      if (subcategoryList) {
        const subcategoryLinks =
          subcategoryList.querySelectorAll(".subcategory-link");

        subcategoryLinks.forEach((link) => {
          const subcatName = link.getAttribute("data-name");
          const subcatHref = link.href;

          const subcatElement = document.createElement("a");
          subcatElement.href = subcatHref;
          subcatElement.className =
            "block py-2 px-3 text-gray-700 hover:bg-gray-100 rounded transition-colors";
          subcatElement.textContent = subcatName;
          subcatElement.style.opacity = "0";

          subcategoriesList.appendChild(subcatElement);
        });

        // Animate subcategories with stagger
        gsap.fromTo(
          subcategoriesList.children,
          { opacity: 0, x: -10 },
          {
            opacity: 1,
            x: 0,
            duration: 0.3,
            stagger: 0.05,
            ease: "power2.out",
            delay: 0.1,
          }
        );
      }
    }

    // Menu button click
    menuBtn.addEventListener("click", function (e) {
      e.stopPropagation();
      toggleMenu();
    });

    // Category item click
    categoryItems.forEach((item) => {
      item.addEventListener("click", function (e) {
        e.preventDefault();
        loadCategorySubcategories(this);
      });
    });

    // Close menu when clicking overlay
    if (menuOverlay) {
      menuOverlay.addEventListener("click", function () {
        toggleMenu();
      });
    }

    // Close menu with Escape key
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && !menu.classList.contains("hidden")) {
        toggleMenu();
      }
    });
  });

  /**
   * Sticky Header with Shadow on Scroll
   */
  document.addEventListener("DOMContentLoaded", function () {
    const header = document.getElementById("siteHeader");
    let lastScrollTop = 0;

    if (header) {
      window.addEventListener(
        "scroll",
        function () {
          const scrollTop =
            window.pageYOffset || document.documentElement.scrollTop;

          if (scrollTop > 50) {
            header.classList.add("header-scrolled");
          } else {
            header.classList.remove("header-scrolled");
          }

          lastScrollTop = scrollTop;
        },
        { passive: true }
      );
    }
  });

  /**
   * Header Actions - Search, Account, Cart
   */
  document.addEventListener("DOMContentLoaded", function () {
    const headerOverlay = document.getElementById("headerOverlay");

    // Search Functionality with GSAP
    const searchToggle = document.getElementById("searchToggle");
    const searchBar = document.getElementById("searchBar");
    const searchClose = document.getElementById("searchClose");
    const searchInput = document.getElementById("searchInput");

    if (searchToggle && searchBar) {
      searchToggle.addEventListener("click", function () {
        searchBar.classList.remove("hidden");
        if (headerOverlay) headerOverlay.classList.remove("hidden");

        const tl = gsap.timeline();

        tl.fromTo(
          headerOverlay,
          { opacity: 0 },
          { opacity: 1, duration: 0.2, ease: "power2.out" }
        ).fromTo(
          searchBar,
          { opacity: 0, y: -20 },
          {
            opacity: 1,
            y: 0,
            duration: 0.3,
            ease: "power3.out",
            onComplete: () => searchInput.focus(),
          },
          "-=0.1"
        );
      });

      if (searchClose) {
        searchClose.addEventListener("click", function () {
          const tl = gsap.timeline({
            onComplete: () => {
              searchBar.classList.add("hidden");
              if (headerOverlay) headerOverlay.classList.add("hidden");
              searchInput.value = "";
            },
          });

          tl.to(searchBar, {
            opacity: 0,
            y: -20,
            duration: 0.2,
            ease: "power2.in",
          }).to(
            headerOverlay,
            { opacity: 0, duration: 0.15, ease: "power2.in" },
            "-=0.1"
          );
        });
      }
    }

    // Account Dropdown with GSAP
    const accountToggle = document.getElementById("accountToggle");
    const accountDropdown = document.getElementById("accountDropdown");

    if (accountToggle && accountDropdown) {
      accountToggle.addEventListener("click", function (e) {
        e.stopPropagation();
        const isHidden = accountDropdown.classList.contains("hidden");

        // Close other dropdowns
        closeAllDropdowns();

        if (isHidden) {
          accountDropdown.classList.remove("hidden");
          if (headerOverlay) headerOverlay.classList.remove("hidden");

          const tl = gsap.timeline();

          tl.fromTo(
            headerOverlay,
            { opacity: 0 },
            { opacity: 1, duration: 0.2, ease: "power2.out" }
          ).fromTo(
            accountDropdown,
            { opacity: 0, y: -10, scale: 0.95 },
            {
              opacity: 1,
              y: 0,
              scale: 1,
              duration: 0.25,
              ease: "back.out(1.4)",
            },
            "-=0.1"
          );
        }
      });
    }

    // Cart Dropdown with GSAP
    const cartToggle = document.getElementById("cartToggle");
    const cartDropdown = document.getElementById("cartDropdown");

    if (cartToggle && cartDropdown) {
      cartToggle.addEventListener("click", function (e) {
        e.stopPropagation();
        const isHidden = cartDropdown.classList.contains("hidden");

        // Close other dropdowns
        closeAllDropdowns();

        if (isHidden) {
          cartDropdown.classList.remove("hidden");
          if (headerOverlay) headerOverlay.classList.remove("hidden");

          const tl = gsap.timeline();

          tl.fromTo(
            headerOverlay,
            { opacity: 0 },
            { opacity: 1, duration: 0.2, ease: "power2.out" }
          ).fromTo(
            cartDropdown,
            { opacity: 0, y: -10, scale: 0.95 },
            {
              opacity: 1,
              y: 0,
              scale: 1,
              duration: 0.25,
              ease: "back.out(1.4)",
            },
            "-=0.1"
          );
        }
      });
    }

    // Close all dropdowns with GSAP animation
    function closeAllDropdowns(immediate = false) {
      if (immediate) {
        if (accountDropdown) accountDropdown.classList.add("hidden");
        if (cartDropdown) cartDropdown.classList.add("hidden");
        if (headerOverlay) headerOverlay.classList.add("hidden");
      } else {
        const dropdowns = [accountDropdown, cartDropdown].filter(
          (d) => d && !d.classList.contains("hidden")
        );

        if (dropdowns.length > 0) {
          const tl = gsap.timeline({
            onComplete: () => {
              dropdowns.forEach((dropdown) => dropdown.classList.add("hidden"));
              if (headerOverlay) headerOverlay.classList.add("hidden");
            },
          });

          tl.to(dropdowns, {
            opacity: 0,
            y: -10,
            scale: 0.95,
            duration: 0.2,
            ease: "power2.in",
          }).to(
            headerOverlay,
            {
              opacity: 0,
              duration: 0.15,
              ease: "power2.in",
            },
            "-=0.1"
          );
        }
      }
    }

    // Close all elements
    function closeAllElements() {
      closeAllDropdowns();
      if (searchBar && !searchBar.classList.contains("hidden")) {
        searchBar.classList.add("search-bar-exit");
        setTimeout(() => {
          searchBar.classList.add("hidden");
          searchBar.classList.remove("search-bar-enter", "search-bar-exit");
        }, 200);
      }
      if (searchInput) searchInput.value = "";
    }

    // Close dropdowns when clicking overlay
    if (headerOverlay) {
      headerOverlay.addEventListener("click", closeAllElements);
    }

    // Close dropdowns when pressing Escape
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape") {
        closeAllElements();
      }
    });

    // Handle search form submission
    if (searchInput) {
      searchInput.addEventListener("keypress", function (e) {
        if (e.key === "Enter") {
          e.preventDefault();
          const searchQuery = searchInput.value.trim();
          if (searchQuery) {
            const homeUrl = window.location.origin;
            window.location.href =
              homeUrl +
              "/?s=" +
              encodeURIComponent(searchQuery) +
              "&post_type=product";
          }
        }
      });
    }
  });

  /**
   * Button Hover Effects with GSAP
   */
  document.addEventListener("DOMContentLoaded", function () {
    const hoverButtons = document.querySelectorAll(".btn-hover-lift");

    hoverButtons.forEach((button) => {
      button.addEventListener("mouseenter", function () {
        gsap.to(this, {
          y: -2,
          scale: 1.05,
          duration: 0.2,
          ease: "power2.out",
        });
      });

      button.addEventListener("mouseleave", function () {
        gsap.to(this, {
          y: 0,
          scale: 1,
          duration: 0.2,
          ease: "power2.out",
        });
      });
    });
  });

  /**
   * Horizontal Scroll Navigation
   */
  document.addEventListener("DOMContentLoaded", function () {
    function initHorizontalSlider(section) {
      const container = section.querySelector(".sliderScroller");
      const leftBtn = section.querySelector(".ScrollLeft");
      const rightBtn = section.querySelector(".ScrollRight");

      if (!container || !leftBtn || !rightBtn) return;

      function getScrollAmount() {
        return container.clientWidth * 0.8;
      }

      function updateButtonStates() {
        const scrollLeft = container.scrollLeft;
        const maxScroll = container.scrollWidth - container.clientWidth;

        leftBtn.style.opacity = scrollLeft <= 5 ? "0.3" : "1";
        leftBtn.style.pointerEvents = scrollLeft <= 5 ? "none" : "auto";

        rightBtn.style.opacity = scrollLeft >= maxScroll - 5 ? "0.3" : "1";
        rightBtn.style.pointerEvents =
          scrollLeft >= maxScroll - 5 ? "none" : "auto";
      }

      leftBtn.addEventListener("click", (e) => {
        e.preventDefault();
        container.scrollBy({
          left: -getScrollAmount(),
          behavior: "smooth",
        });
      });

      rightBtn.addEventListener("click", (e) => {
        e.preventDefault();
        container.scrollBy({
          left: getScrollAmount(),
          behavior: "smooth",
        });
      });

      container.addEventListener("scroll", updateButtonStates);
      window.addEventListener("resize", updateButtonStates);

      updateButtonStates();
    }

    /* ===============================
     Initialize ALL sliders on page
     =============================== */
    document.querySelectorAll("section").forEach(initHorizontalSlider);
  });
})();
