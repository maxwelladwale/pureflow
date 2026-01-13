<?php
/**
 * WooCommerce Archive Template (Shop Page)
 *
 * @package PureFlow
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<div class="mx-auto max-w-7xl">

    <!-- Breadcrumbs -->
    <?php if (function_exists('woocommerce_breadcrumb')): ?>
        <nav class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 mb-6">
            <?php
            woocommerce_breadcrumb(array(
                'delimiter' => '<span class="material-symbols-outlined text-xs">chevron_right</span>',
                'wrap_before' => '',
                'wrap_after' => '',
                'before' => '',
                'after' => '',
                'home' => 'Home',
            ));
            ?>
        </nav>
    <?php endif; ?>

    <div class="flex gap-8">
        <!-- Sidebar Filters -->
        <aside class="w-64 shrink-0 hidden lg:block">
            <div class="flex flex-col gap-8">
                <!-- Categories -->
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 dark:text-white mb-4">
                        Categories</h3>
                    <div class="flex flex-col gap-1">
                        <?php
                        $product_categories = get_terms(array(
                            'taxonomy' => 'product_cat',
                            'hide_empty' => true,
                        ));

                        if (!empty($product_categories)):
                            foreach ($product_categories as $category):
                                $is_current = is_product_category($category->slug);
                                $class = $is_current
                                    ? 'flex items-center justify-between px-3 py-2 rounded-lg bg-primary/10 text-primary font-medium'
                                    : 'flex items-center justify-between px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400';
                                ?>
                                <a class="<?php echo esc_attr($class); ?>"
                                    href="<?php echo esc_url(get_term_link($category)); ?>">
                                    <span class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-sm">category</span>
                                        <?php echo esc_html($category->name); ?>
                                    </span>
                                    <span class="text-xs"><?php echo esc_html($category->count); ?></span>
                                </a>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>

                <!-- Price Filter -->
                <?php if (is_active_sidebar('shop-sidebar')): ?>
                    <?php dynamic_sidebar('shop-sidebar'); ?>
                <?php else: ?>
                    <div>
                        <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 dark:text-white mb-4">Price
                            Range</h3>
                        <?php the_widget('WC_Widget_Price_Filter'); ?>
                    </div>
                <?php endif; ?>

                <!-- WooCommerce Layered Nav (for attributes like Brand) -->
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 dark:text-white mb-4">Filters
                    </h3>
                    <?php the_widget('WC_Widget_Layered_Nav', array('attribute' => 'pa_brand', 'title' => 'Brand')); ?>
                </div>
            </div>
        </aside>

        <!-- Main Products Area -->
        <div class="flex-1">
            <!-- Sorting and View Options -->
            <div class="mb-6 flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center gap-4">
                    <p class="text-sm text-slate-500">
                        <?php
                        $total = wc_get_loop_prop('total');
                        printf(esc_html__('Showing %d products', 'pureflow'), $total);
                        ?>
                    </p>
                </div>

                <?php woocommerce_catalog_ordering(); ?>
            </div>

            <?php if (woocommerce_product_loop()): ?>

                <!-- Product Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    <?php
                    if (wc_get_loop_prop('total')) {
                        while (have_posts()) {
                            the_post();
                            wc_get_template_part('content', 'product');
                        }
                    }
                    ?>
                </div>

                <!-- Pagination -->
                <?php
                /**
                 * Hook: woocommerce_after_shop_loop.
                 */
                do_action('woocommerce_after_shop_loop');
                ?>

            <?php else: ?>

                <div class="text-center py-12">
                    <p class="text-slate-500"><?php esc_html_e('No products found', 'pureflow'); ?></p>
                </div>

            <?php endif; ?>
        </div>
    </div>
</div>

<?php
get_footer();
