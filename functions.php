<?php
/**
 * PureFlow Theme Functions
 *
 * @package PureFlow
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Theme Setup
 */
function pureflow_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    
    // WooCommerce support
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'pureflow'),
        'footer' => __('Footer Menu', 'pureflow'),
    ));
}
add_action('after_setup_theme', 'pureflow_setup');

/**
 * Enqueue Scripts and Styles
 */
function pureflow_enqueue_scripts() {
    // Google Fonts
    wp_enqueue_style('pureflow-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', array(), null);
    wp_enqueue_style('pureflow-material-icons', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap', array(), null);
    
    // Theme stylesheet
    wp_enqueue_style('pureflow-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Custom scripts
    wp_enqueue_script('pureflow-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'pureflow_enqueue_scripts');

/**
 * Add Tailwind CDN to head
 */
function pureflow_tailwind_cdn() {
    ?>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#137fec",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Inter"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <?php
}
add_action('wp_head', 'pureflow_tailwind_cdn', 1);

/**
 * Remove default WooCommerce wrappers
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/**
 * Add custom WooCommerce wrappers
 */
function pureflow_wrapper_start() {
    echo '<main class="max-w-[1440px] mx-auto px-6 py-6">';
}
add_action('woocommerce_before_main_content', 'pureflow_wrapper_start', 10);

function pureflow_wrapper_end() {
    echo '</main>';
}
add_action('woocommerce_after_main_content', 'pureflow_wrapper_end', 10);

/**
 * Modify WooCommerce products per page
 */
function pureflow_products_per_page() {
    return 12;
}
add_filter('loop_shop_per_page', 'pureflow_products_per_page', 20);

/**
 * Modify WooCommerce columns
 */
function pureflow_loop_columns() {
    return 3; // 3 columns for desktop
}
add_filter('loop_shop_columns', 'pureflow_loop_columns');

/**
 * Custom cart count for header
 */
function pureflow_cart_count() {
    if (function_exists('WC')) {
        return WC()->cart->get_cart_contents_count();
    }
    return 0;
}

/**
 * Update cart count via AJAX
 */
function pureflow_update_cart_count() {
    wp_send_json(array('count' => pureflow_cart_count()));
}
add_action('wp_ajax_pureflow_cart_count', 'pureflow_update_cart_count');
add_action('wp_ajax_nopriv_pureflow_cart_count', 'pureflow_update_cart_count');

/**
 * Add AJAX support for add to cart
 */
add_filter('woocommerce_add_to_cart_fragments', function($fragments) {
    $fragments['.cart-count'] = '<span class="cart-count absolute top-1 right-1 w-4 h-4 bg-primary text-white text-[10px] flex items-center justify-center rounded-full">' . pureflow_cart_count() . '</span>';
    return $fragments;
});
