/**
 * PureFlow Theme Scripts
 */

(function($) {
    'use strict';

    // Update cart count on AJAX add to cart
    $(document.body).on('added_to_cart', function(event, fragments, cart_hash, button) {
        // Cart count is already updated by WooCommerce fragments
        console.log('Product added to cart');
    });

    // Mobile menu toggle (if you add one later)
    $('.mobile-menu-toggle').on('click', function() {
        $('.mobile-menu').toggleClass('hidden');
    });

    // Dark mode toggle (if you want to add this feature)
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function() {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
        });

        // Check for saved dark mode preference
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark');
        }
    }

    // Smooth scroll for anchor links
    $('a[href^="#"]').on('click', function(e) {
        const target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 100
            }, 600);
        }
    });

    // Add to cart button enhancement
    $('.add_to_cart_button').on('click', function() {
        $(this).addClass('loading');
    });

    $(document.body).on('added_to_cart removed_from_cart', function() {
        $('.add_to_cart_button').removeClass('loading');
    });

})(jQuery);
