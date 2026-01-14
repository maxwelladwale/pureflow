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
    wp_enqueue_style('pureflow-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap', array(), null);
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

/**
 * Theme Customizer - Global Button Styling
 */
function pureflow_customize_register($wp_customize) {
    // Add Theme Styling Section
    $wp_customize->add_section('pureflow_button_styling', array(
        'title'       => __('Button Styling', 'pureflow'),
        'description' => __('Customize button colors for the entire theme including WooCommerce buttons.', 'pureflow'),
        'priority'    => 130,
    ));

    // Primary Button Background Color
    $wp_customize->add_setting('primary_button_bg_color', array(
        'default'           => '#137fec',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_button_bg_color', array(
        'label'       => __('Primary Button Color', 'pureflow'),
        'description' => __('Background color for primary buttons (Add to Cart, Submit, etc.)', 'pureflow'),
        'section'     => 'pureflow_button_styling',
        'settings'    => 'primary_button_bg_color',
    )));

    // Primary Button Hover Color
    $wp_customize->add_setting('primary_button_hover_color', array(
        'default'           => '#0e6bc7',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_button_hover_color', array(
        'label'       => __('Primary Button Hover Color', 'pureflow'),
        'description' => __('Color when hovering over primary buttons', 'pureflow'),
        'section'     => 'pureflow_button_styling',
        'settings'    => 'primary_button_hover_color',
    )));

    // Primary Button Text Color
    $wp_customize->add_setting('primary_button_text_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_button_text_color', array(
        'label'       => __('Primary Button Text Color', 'pureflow'),
        'description' => __('Text color for primary buttons', 'pureflow'),
        'section'     => 'pureflow_button_styling',
        'settings'    => 'primary_button_text_color',
    )));

    // Secondary Button Background Color
    $wp_customize->add_setting('secondary_button_bg_color', array(
        'default'           => '#f1f5f9',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_button_bg_color', array(
        'label'       => __('Secondary Button Color', 'pureflow'),
        'description' => __('Background color for secondary buttons', 'pureflow'),
        'section'     => 'pureflow_button_styling',
        'settings'    => 'secondary_button_bg_color',
    )));

    // Secondary Button Hover Color
    $wp_customize->add_setting('secondary_button_hover_color', array(
        'default'           => '#e2e8f0',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_button_hover_color', array(
        'label'       => __('Secondary Button Hover Color', 'pureflow'),
        'description' => __('Color when hovering over secondary buttons', 'pureflow'),
        'section'     => 'pureflow_button_styling',
        'settings'    => 'secondary_button_hover_color',
    )));

    // Secondary Button Text Color
    $wp_customize->add_setting('secondary_button_text_color', array(
        'default'           => '#0f172a',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_button_text_color', array(
        'label'       => __('Secondary Button Text Color', 'pureflow'),
        'description' => __('Text color for secondary buttons', 'pureflow'),
        'section'     => 'pureflow_button_styling',
        'settings'    => 'secondary_button_text_color',
    )));

    // Button Border Radius
    $wp_customize->add_setting('button_border_radius', array(
        'default'           => '6',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('button_border_radius', array(
        'label'       => __('Button Border Radius (px)', 'pureflow'),
        'description' => __('Roundness of button corners', 'pureflow'),
        'section'     => 'pureflow_button_styling',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 50,
            'step' => 1,
        ),
    ));
}
add_action('customize_register', 'pureflow_customize_register');

/**
 * Output Global Button Custom Styles
 */
function pureflow_button_custom_styles() {
    // Primary Button Colors
    $primary_bg = get_theme_mod('primary_button_bg_color', '#137fec');
    $primary_hover = get_theme_mod('primary_button_hover_color', '#0e6bc7');
    $primary_text = get_theme_mod('primary_button_text_color', '#ffffff');

    // Secondary Button Colors
    $secondary_bg = get_theme_mod('secondary_button_bg_color', '#f1f5f9');
    $secondary_hover = get_theme_mod('secondary_button_hover_color', '#e2e8f0');
    $secondary_text = get_theme_mod('secondary_button_text_color', '#0f172a');

    // Border Radius
    $border_radius = get_theme_mod('button_border_radius', '6');
    ?>
    <style type="text/css">
        /* Primary Button Styles - WooCommerce & Theme */
        .single_add_to_cart_button,
        .woocommerce-page .single_add_to_cart_button,
        .woocommerce button.button.alt,
        .woocommerce button.button,
        .woocommerce a.button.alt,
        .woocommerce a.button,
        .woocommerce-page button.button,
        .woocommerce-page a.button,
        button.bg-primary,
        a.bg-primary,
        .button-primary,
        input[type="submit"] {
            background-color: <?php echo esc_attr($primary_bg); ?> !important;
            color: <?php echo esc_attr($primary_text); ?> !important;
            border: none !important;
            padding: 0.75rem 2rem !important;
            font-weight: 700 !important;
            border-radius: <?php echo esc_attr($border_radius); ?>px !important;
            cursor: pointer !important;
            transition: all 0.2s ease-in-out !important;
            font-size: 0.875rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.025em !important;
            display: inline-block !important;
            text-align: center !important;
        }

        .single_add_to_cart_button:hover,
        .woocommerce-page .single_add_to_cart_button:hover,
        .woocommerce button.button.alt:hover,
        .woocommerce button.button:hover,
        .woocommerce a.button.alt:hover,
        .woocommerce a.button:hover,
        .woocommerce-page button.button:hover,
        .woocommerce-page a.button:hover,
        button.bg-primary:hover,
        a.bg-primary:hover,
        .button-primary:hover,
        input[type="submit"]:hover {
            background-color: <?php echo esc_attr($primary_hover); ?> !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
        }

        /* Secondary Button Styles */
        .woocommerce button.button.secondary,
        .woocommerce a.button.secondary,
        button.bg-slate-100,
        a.bg-slate-100,
        .button-secondary {
            background-color: <?php echo esc_attr($secondary_bg); ?> !important;
            color: <?php echo esc_attr($secondary_text); ?> !important;
            border: none !important;
            padding: 0.75rem 2rem !important;
            font-weight: 700 !important;
            border-radius: <?php echo esc_attr($border_radius); ?>px !important;
            cursor: pointer !important;
            transition: all 0.2s ease-in-out !important;
            font-size: 0.875rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.025em !important;
            display: inline-block !important;
            text-align: center !important;
        }

        .woocommerce button.button.secondary:hover,
        .woocommerce a.button.secondary:hover,
        button.bg-slate-100:hover,
        a.bg-slate-100:hover,
        .button-secondary:hover {
            background-color: <?php echo esc_attr($secondary_hover); ?> !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important;
        }

        /* Disabled State */
        .single_add_to_cart_button:disabled,
        .woocommerce-page .single_add_to_cart_button:disabled,
        button:disabled,
        input[type="submit"]:disabled {
            background-color: #cbd5e1 !important;
            cursor: not-allowed !important;
            opacity: 0.6 !important;
            transform: none !important;
        }

        /* Dark Mode Support */
        .dark .woocommerce button.button.secondary,
        .dark button.bg-slate-100,
        .dark .button-secondary {
            background-color: #1e293b !important;
            color: #f8fafc !important;
        }

        .dark .woocommerce button.button.secondary:hover,
        .dark button.bg-slate-100:hover,
        .dark .button-secondary:hover {
            background-color: #334155 !important;
        }
    </style>
    <?php
}
add_action('wp_head', 'pureflow_button_custom_styles');
