<?php
/**
 * Front Page Template - Home Page
 *
 * @package PureFlow
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main class="max-w-[1280px] mx-auto px-4 md:px-10 pb-20">
    <!-- Trust Bar -->
    <div
        class="flex flex-wrap items-center justify-center gap-8 py-6 border-b border-slate-200 dark:border-slate-800 opacity-60 grayscale hover:grayscale-0 transition-all">
        <div class="flex items-center gap-2"><span class="material-symbols-outlined text-primary">verified</span><span
                class="text-xs font-bold uppercase tracking-widest">NSF Certified</span></div>
        <div class="flex items-center gap-2"><span
                class="material-symbols-outlined text-primary">local_shipping</span><span
                class="text-xs font-bold uppercase tracking-widest">Free Shipping Over $150</span></div>
        <div class="flex items-center gap-2"><span
                class="material-symbols-outlined text-primary">engineering</span><span
                class="text-xs font-bold uppercase tracking-widest">Expert Tech Support</span></div>
        <div class="flex items-center gap-2"><span
                class="material-symbols-outlined text-primary">inventory_2</span><span
                class="text-xs font-bold uppercase tracking-widest">ISO 9001 Compliant</span></div>
    </div>

    <!-- Hero Section -->
    <section class="py-10">
        <div
            class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center bg-white dark:bg-slate-900 rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="p-8 md:p-16 flex flex-col gap-8">
                <div class="flex flex-col gap-4">
                    <span class="text-primary font-bold tracking-widest uppercase text-xs">Industrial-Grade
                        Reliability</span>
                    <h1
                        class="text-4xl md:text-5xl lg:text-6xl font-black leading-[1.1] tracking-tight text-slate-900 dark:text-white">
                        Engineered for Purity.
                    </h1>
                    <p class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed">
                        Your trusted global source for high-performance RO membranes, commercial filter housings, and
                        industrial-grade water pumps.
                    </p>
                </div>
                <div class="flex flex-wrap gap-4">
                    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>"
                        class="bg-primary hover:bg-primary/90 text-white font-bold py-4 px-8 rounded-lg shadow-lg shadow-primary/20 transition-all flex items-center gap-2">
                        Browse Catalog <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                    <a href="#contact"
                        class="bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-900 dark:text-white font-bold py-4 px-8 rounded-lg transition-all">
                        Request Quote
                    </a>
                </div>
            </div>
            <div class="relative h-[400px] lg:h-full min-h-[500px] bg-cover bg-center"
                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDgA5AzmhwtbHDcJ69zpiEI968zMNcJ4j4F_8Q3HuR0CpcRMzh3gzXcKsZYEbB1R8eDx0fQPJ5DXaROqhmNx9oUmZm-ds1c8JWm7cnk4Nq6gXcS_7dVd8ratyJCthI27rG6Ku9WqjoelQIgTHC62q6Xf5_QwuLTExsA4KpItemo5gdPivy7fkDfiAZUyLM3Ndonioq3LnxuslEW-NPTCJyZ69TcdpKvJOVOe5NkCZ1LuqLoz9qiYPCV9M8MWXQbwLp0W27yV22lHPZ8");'>
                <div
                    class="absolute inset-0 bg-gradient-to-r from-white dark:from-slate-900 via-transparent to-transparent lg:block hidden">
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-12">
        <div class="flex items-center justify-between mb-8 px-2">
            <h2 class="text-3xl font-bold tracking-tight">Shop by Category</h2>
            <a class="text-primary font-bold text-sm flex items-center gap-1 hover:underline"
                href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">View All Categories <span
                    class="material-symbols-outlined text-sm">open_in_new</span></a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <?php
            // Get product categories
            $categories = get_terms(array(
                'taxonomy' => 'product_cat',
                'hide_empty' => true,
                'number' => 4,
                'orderby' => 'count',
                'order' => 'DESC',
            ));

            if (!empty($categories) && !is_wp_error($categories)):
                foreach ($categories as $category):
                    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                    $image_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : 'https://via.placeholder.com/400';
                    ?>
                    <a href="<?php echo esc_url(get_term_link($category)); ?>"
                        class="group relative overflow-hidden rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-2 hover:shadow-xl transition-all">
                        <div class="aspect-square rounded-lg overflow-hidden bg-slate-100 dark:bg-slate-800 mb-4 bg-cover bg-center transition-transform group-hover:scale-105"
                            style='background-image: url("<?php echo esc_url($image_url); ?>");'></div>
                        <div class="p-3">
                            <h3 class="font-bold text-lg mb-1">
                                <?php echo esc_html($category->name); ?>
                            </h3>
                            <p class="text-xs text-slate-500">
                                <?php echo esc_html($category->count); ?> Products
                            </p>
                        </div>
                    </a>
                    <?php
                endforeach;
            else:
                // Fallback static categories if no WooCommerce categories exist
                ?>
                <div
                    class="group relative overflow-hidden rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-2 hover:shadow-xl transition-all">
                    <div class="aspect-square rounded-lg overflow-hidden bg-slate-100 dark:bg-slate-800 mb-4 bg-cover bg-center transition-transform group-hover:scale-105"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCQXfIkhzZnNLiGVOm8-ZMWYFdqCGOzk7mx3YbIrBkLQYsWGhjPFddZf8tqlA6zjuVqm9ghDj-ypv_1VGNcn4HWOVa5W7R6nPvpCV1nC6NrD83DPbsplzcj6w21xmWBfqYMFgG3pUbwUMCBvGE-ZyBIuTGsEF82kT4I441QIcXtqTGf_FtuGHjFJszhF2jbVQfL7oMexgE4pcVXqtHeWK750Qyhn9iffjYyrfsLMiMZfIw5Wv6ju8Sre9kgssoKyKjdUbpbvL0qe2b6");'>
                    </div>
                    <div class="p-3">
                        <h3 class="font-bold text-lg mb-1">RO Membranes</h3>
                        <p class="text-xs text-slate-500">100+ Models in Stock</p>
                    </div>
                </div>
                <div
                    class="group relative overflow-hidden rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-2 hover:shadow-xl transition-all">
                    <div class="aspect-square rounded-lg overflow-hidden bg-slate-100 dark:bg-slate-800 mb-4 bg-cover bg-center transition-transform group-hover:scale-105"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAKeVhcU70yrmazriW6LGxmbZY8w9yDnJJnJ88FMyK9krcE6oFpPHqVNLVB8bqzf5rsSCaw1nOPLSZtYzJ3IDVSotfSzj7NZs7Og47C2aqVuMrJHu_hwbsUK3ZrrxY0X_BD0NcUeqieiXS2ZWx58N5hhXyyiZu65XDl1LMdXXxMycry-Ey0RfCFYRL-t-0xwDBtqVAr7TupYvyxD_71gwbvofKUEA8IgtC8mbthhT-S13BFBO-y3MfFe27tOKJj_nztR7-Po6Gu41kf");'>
                    </div>
                    <div class="p-3">
                        <h3 class="font-bold text-lg mb-1">Filter Housings</h3>
                        <p class="text-xs text-slate-500">Standard & Big Blue</p>
                    </div>
                </div>
                <div
                    class="group relative overflow-hidden rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-2 hover:shadow-xl transition-all">
                    <div class="aspect-square rounded-lg overflow-hidden bg-slate-100 dark:bg-slate-800 mb-4 bg-cover bg-center transition-transform group-hover:scale-105"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC_wLgZwISq_ysib_RCHK1o4xWKCEoxr0XF_-9-lAL9uAyixUm4Nl1UTygiCgKFBiDnLLzin2oznEbRniCFC9ALd-WHf8BQDMBeOWw8Y4UZ7MH5ADshiPpqbz58mBr_x9XKzCF6R2jjzY82LBb3AsEdH5KdWMESlerPRwohfKE0Ygn8o3UAvlstevknWUhPuDe6EO3p7WS8_DgeAUufGQEx4QR0c7ITJR6Qlj1wL373CcsCT4tVMFRwuwb7p7vteXqAzsoJr2TSXtm");'>
                    </div>
                    <div class="p-3">
                        <h3 class="font-bold text-lg mb-1">Pumps</h3>
                        <p class="text-xs text-slate-500">Booster & Metering</p>
                    </div>
                </div>
                <div
                    class="group relative overflow-hidden rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-2 hover:shadow-xl transition-all">
                    <div class="aspect-square rounded-lg overflow-hidden bg-slate-100 dark:bg-slate-800 mb-4 bg-cover bg-center transition-transform group-hover:scale-105"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA0clr0IFZjhmPu7SgRGSWtke-c_ICci5_M0vUmKxJdOFYdAJzO76_vwH6_P8MDHeT9KtKpz4AHwd3mMNgKDvgGXH8aJiW70RkUG9KE4lUJZ4HUJ_sfL18ZWCvhdm1hQ6Fe3LbA09dyLawt48ufdyKMfYXrOLx_howM4XE_ZicoUtSKPT7tsam3yFj3UrTT_E_jqOldYuN1fye4iEquA1mSTkqQ4fXC4VCfdakiq3zy6V-k7mNC-41kC0W7Xdq8O-RQXF1PZMPfn2IY");'>
                    </div>
                    <div class="p-3">
                        <h3 class="font-bold text-lg mb-1">Testers & Meters</h3>
                        <p class="text-xs text-slate-500">TDS, pH & ORP</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Top Rated Parts -->
    <section class="py-12">
        <div class="bg-slate-900 dark:bg-slate-950 rounded-3xl p-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
                <div class="flex flex-col gap-2">
                    <h2 class="text-3xl font-bold text-white">Top Rated Parts</h2>
                    <p class="text-slate-400">High-performance components tested by industry professionals.</p>
                </div>
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>"
                    class="bg-white hover:bg-slate-100 text-slate-900 px-6 py-2.5 rounded-lg font-bold text-sm transition-all">View
                    All Rated</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                // Get top rated products
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 3,
                    'meta_key' => '_wc_average_rating',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC',
                );
                $top_rated = new WP_Query($args);

                if ($top_rated->have_posts()):
                    while ($top_rated->have_posts()):
                        $top_rated->the_post();
                        global $product;
                        $rating = $product->get_average_rating();
                        $review_count = $product->get_review_count();
                        ?>
                        <div class="bg-white dark:bg-slate-900 rounded-2xl p-4 flex flex-col gap-4">
                            <a href="<?php echo esc_url(get_permalink()); ?>"
                                class="h-48 rounded-xl bg-slate-100 dark:bg-slate-800 bg-cover bg-center"
                                style='background-image: url("<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>");'></a>
                            <div class="flex flex-col flex-1 gap-2">
                                <div class="flex items-center gap-1 text-amber-500">
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= floor($rating)) {
                                            echo '<span class="material-symbols-outlined text-sm">star</span>';
                                        } elseif ($i - 0.5 <= $rating) {
                                            echo '<span class="material-symbols-outlined text-sm">star_half</span>';
                                        } else {
                                            echo '<span class="material-symbols-outlined text-sm opacity-30">star</span>';
                                        }
                                    }
                                    ?>
                                    <span class="text-xs text-slate-400 ml-1">(
                                        <?php echo esc_html($review_count); ?> Reviews)
                                    </span>
                                </div>
                                <h3 class="font-bold text-lg text-slate-900 dark:text-white">
                                    <a href="<?php echo esc_url(get_permalink()); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <p class="text-sm text-slate-500 dark:text-slate-400 line-clamp-2">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                </p>
                                <div class="mt-auto flex items-center justify-between pt-4">
                                    <span class="text-2xl font-black text-slate-900 dark:text-white">
                                        <?php echo $product->get_price_html(); ?>
                                    </span>
                                    <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                                        class="bg-primary hover:bg-primary/90 text-white p-2 rounded-lg"
                                        data-product_id="<?php echo esc_attr($product->get_id()); ?>">
                                        <span class="material-symbols-outlined">add_shopping_cart</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    // Fallback static products
                    ?>
                    <div class="bg-white dark:bg-slate-900 rounded-2xl p-4 flex flex-col gap-4">
                        <div class="h-48 rounded-xl bg-slate-100 dark:bg-slate-800 bg-cover bg-center"
                            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBHw6-Z3ux5_5c2584xbiFKLhZHfpPpBuY0P-HKPjbNYYlllBe6_MIJo7y5R2Jhcl5nHX8ULZXv-nWY6CC5ojgJcunGlHR0hLsoWtbZfbu4Shif9OKXxkfE-fXptR1QS5k103_fzOeVZWaiv8jqWD-gX_D-S0H5fF2vru_umbuC_ZacSFIJpcwRqK_y-BjP8aKC4JTDwSHBuQ7MBw7vijt-1NIjM_klJTOJlV--7QAAG7hN6TPBbw3kz54CPvurYYYGbDQggEYxo_67");'>
                        </div>
                        <div class="flex flex-col flex-1 gap-2">
                            <div class="flex items-center gap-1 text-amber-500">
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="text-xs text-slate-400 ml-1">(48 Reviews)</span>
                            </div>
                            <h3 class="font-bold text-lg text-slate-900 dark:text-white">PureForce 4040 LP Membrane</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400 line-clamp-2">Low pressure industrial
                                membrane designed for high flux and superior rejection rates.</p>
                            <div class="mt-auto flex items-center justify-between pt-4">
                                <span class="text-2xl font-black text-slate-900 dark:text-white">$245.00</span>
                                <button class="bg-primary hover:bg-primary/90 text-white p-2 rounded-lg">
                                    <span class="material-symbols-outlined">add_shopping_cart</span>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Expert Advice Section -->
    <section class="py-12">
        <div class="flex flex-col gap-2 mb-8 text-center max-w-2xl mx-auto">
            <h2 class="text-3xl font-bold tracking-tight">Expert Advice & Guides</h2>
            <p class="text-slate-500">Resources to help you maintain and optimize your filtration systems.</p>
        </div>
        <?php
        $blog_posts = new WP_Query(array(
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ));

        if ($blog_posts->have_posts()) : ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php while ($blog_posts->have_posts()) : $blog_posts->the_post();
                    $categories = get_the_category();
                    $category_name = !empty($categories) ? $categories[0]->name : 'Article';
                    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                    $placeholder_url = 'https://placehold.co/600x400/e2e8f0/64748b?text=No+Image';
                ?>
                    <a href="<?php the_permalink(); ?>" class="flex flex-col gap-4 group">
                        <div class="aspect-video rounded-xl bg-slate-200 overflow-hidden relative"
                            style='background-image: url("<?php echo esc_url($thumbnail_url ? $thumbnail_url : $placeholder_url); ?>"); background-size: cover; background-position: center;'>
                            <div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="bg-white text-primary font-bold px-4 py-2 rounded-lg">Read Post</span>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <span class="text-primary font-bold text-xs uppercase tracking-widest"><?php echo esc_html($category_name); ?></span>
                            <h3 class="text-xl font-bold group-hover:text-primary transition-colors"><?php the_title(); ?></h3>
                            <p class="text-slate-500 text-sm leading-relaxed"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <div class="text-center py-12">
                <p class="text-slate-500">No blog posts found. Add some posts in WordPress admin to display them here.</p>
            </div>
        <?php endif;
        wp_reset_postdata();
        ?>
    </section>

    <!-- CTA Section -->
    <section class="py-12">
        <div
            class="bg-primary rounded-3xl p-8 md:p-16 flex flex-col md:flex-row items-center gap-10 text-white relative overflow-hidden">
            <div class="relative z-10 flex-1 flex flex-col gap-6">
                <h2 class="text-3xl md:text-5xl font-black leading-tight">Need a Custom <br />Industrial Setup?</h2>
                <p class="text-lg text-white/80 max-w-md">Our engineers can help design a complete filtration skid
                    tailored to your specific water quality requirements.</p>
                <div class="flex gap-4">
                    <a href="#contact"
                        class="bg-white text-primary font-black py-4 px-10 rounded-xl hover:bg-slate-50 transition-all">Get
                        a Free Consultation</a>
                </div>
            </div>
            <div
                class="relative z-10 w-full max-w-xs aspect-square bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-8 flex flex-col items-center justify-center text-center gap-4">
                <span class="material-symbols-outlined text-6xl">support_agent</span>
                <h4 class="text-xl font-bold">24/7 Tech Support</h4>
                <p class="text-sm opacity-80">Live engineers ready to assist with your technical questions.</p>
                <a class="font-bold text-lg hover:underline" href="tel:1-800-PURE">1-800-PURE-STR</a>
            </div>
            <!-- Decorative background elements -->
            <div class="absolute -right-20 -bottom-20 size-80 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -left-20 -top-20 size-80 bg-white/5 rounded-full blur-3xl"></div>
        </div>
    </section>
</main>

<?php
get_footer();
