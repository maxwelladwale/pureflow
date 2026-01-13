<?php
/**
 * The header template
 *
 * @package PureFlow
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="light">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen'); ?>>
<?php wp_body_open(); ?>

<!-- Top Navigation Bar -->
<header class="sticky top-0 z-50 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800">
    <div class="max-w-[1440px] mx-auto px-6 h-16 flex items-center justify-between gap-8">
        <div class="flex items-center gap-8 shrink-0">
            <div class="flex items-center gap-2">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-2">
                    <div class="bg-primary text-white p-1 rounded">
                        <span class="material-symbols-outlined block">water_drop</span>
                    </div>
                    <h1 class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">
                        <?php bloginfo('name'); ?>
                    </h1>
                </a>
            </div>
            <nav class="hidden md:flex items-center gap-6">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'items_wrap' => '%3$s',
                    'fallback_cb' => function() {
                        echo '<a class="text-sm font-medium text-primary" href="' . esc_url(get_permalink(wc_get_page_id('shop'))) . '">Shop</a>';
                        echo '<a class="text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-primary" href="#">Resources</a>';
                        echo '<a class="text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-primary" href="#">Support</a>';
                    },
                ));
                ?>
            </nav>
        </div>
        
        <div class="flex-1 max-w-xl">
            <?php if (function_exists('get_product_search_form')) : ?>
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">search</span>
                    <form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="search" 
                               name="s" 
                               class="w-full bg-slate-100 dark:bg-slate-800 border-none rounded-lg py-2 pl-10 pr-4 text-sm focus:ring-2 focus:ring-primary/50 placeholder:text-slate-400" 
                               placeholder="Search by SKU, part name, or technical spec..." 
                               value="<?php echo get_search_query(); ?>">
                        <input type="hidden" name="post_type" value="product">
                    </form>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="flex items-center gap-4 shrink-0">
            <?php if (function_exists('WC')) : ?>
                <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="p-2 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg relative">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <?php
                    $cart_count = WC()->cart->get_cart_contents_count();
                    if ($cart_count > 0) :
                    ?>
                        <span class="cart-count absolute top-1 right-1 w-4 h-4 bg-primary text-white text-[10px] flex items-center justify-center rounded-full">
                            <?php echo esc_html($cart_count); ?>
                        </span>
                    <?php endif; ?>
                </a>
            <?php endif; ?>
            
            <div class="h-8 w-px bg-slate-200 dark:bg-slate-700"></div>
            
            <div class="flex items-center gap-3">
                <?php if (is_user_logged_in()) : ?>
                    <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" class="flex items-center gap-3">
                        <div class="bg-slate-200 dark:bg-slate-700 h-8 w-8 rounded-full overflow-hidden flex items-center justify-center">
                            <?php echo get_avatar(get_current_user_id(), 32); ?>
                        </div>
                        <span class="hidden lg:block text-sm font-semibold">Account</span>
                    </a>
                <?php else : ?>
                    <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" class="flex items-center gap-3">
                        <div class="bg-slate-200 dark:bg-slate-700 h-8 w-8 rounded-full overflow-hidden flex items-center justify-center">
                            <span class="material-symbols-outlined text-slate-500">person</span>
                        </div>
                        <span class="hidden lg:block text-sm font-semibold">Login</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
