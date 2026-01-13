<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 */

defined('ABSPATH') || exit;

get_header(); ?>

<?php while (have_posts()): ?>
    <?php the_post(); ?>

    <?php
    global $product;

    // Get product data
    $product_id = get_the_ID();
    $product_name = get_the_title();
    $product_price = $product->get_price_html();
    $product_description = get_the_content();
    $product_short_description = $product->get_short_description();
    $product_sku = $product->get_sku();
    $product_categories = wc_get_product_category_list($product_id);
    $product_tags = wc_get_product_tag_list($product_id);
    $average_rating = $product->get_average_rating();
    $review_count = $product->get_review_count();
    $stock_status = $product->is_in_stock();
    ?>

    <!-- Breadcrumbs -->
    <div class="max-w-[1280px] mx-auto w-full px-6 py-8">
        <?php woocommerce_breadcrumb(array(
            'wrap_before' => '<nav aria-label="Breadcrumb" class="flex text-sm text-slate-500 dark:text-slate-400 mb-8"><ol class="flex list-none p-0">',
            'wrap_after' => '</ol></nav>',
            'before' => '<li class="flex items-center">',
            'after' => '</li>',
            'delimiter' => '<span class="mx-2 text-slate-300">/</span>',
        )); ?>
    </div>

    <!-- Product Summary Section -->
    <section class="max-w-[1280px] mx-auto w-full px-6 mb-8 flex flex-col lg:flex-row gap-8">
        <!-- Product Images - Left Column (3/4 width) -->
        <div class="w-full lg:w-3/4 flex-1">
            <div
                class="w-full aspect-video bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg overflow-hidden group relative">
                <?php
                $image_id = $product->get_image_id();
                if ($image_id) {
                    echo wp_get_attachment_image($image_id, 'full', false, array(
                        'class' => 'w-full h-full object-cover',
                        'alt' => esc_attr($product_name)
                    ));
                } else {
                    echo wc_placeholder_img('full', 'w-full h-full object-cover');
                }
                ?>
                <button
                    class="absolute top-4 right-4 bg-white dark:bg-slate-800 p-2 rounded-full shadow-md hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">zoom_in</span>
                </button>
            </div>

            <!-- Thumbnail Gallery -->
            <div class="flex gap-3 mt-4 overflow-x-auto pb-2">
                <?php
                $attachment_ids = $product->get_gallery_image_ids();

                // Add main image as first thumbnail
                if ($image_id) {
                    echo '<div class="aspect-square w-20 shrink-0 rounded border-2 border-primary overflow-hidden cursor-pointer">';
                    echo wp_get_attachment_image($image_id, 'thumbnail', false, array('class' => 'w-full h-full object-cover'));
                    echo '</div>';
                }

                // Add gallery images
                if ($attachment_ids) {
                    foreach ($attachment_ids as $attachment_id) {
                        echo '<div class="aspect-square w-20 shrink-0 rounded border border-slate-200 dark:border-slate-800 overflow-hidden cursor-pointer hover:border-primary transition-colors">';
                        echo wp_get_attachment_image($attachment_id, 'thumbnail', false, array('class' => 'w-full h-full object-cover'));
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>

        <!-- Product Info - Right Column (1/4 width) -->
        <div
            class="lg:w-1/4 flex flex-col justify-between p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg">
            <div class="flex flex-col">
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white mb-2 leading-tight">
                    <?php echo esc_html($product_name); ?>
                </h1>

                <!-- Rating -->
                <?php if ($review_count > 0): ?>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="flex text-amber-400">
                            <?php
                            $full_stars = floor($average_rating);
                            $half_star = ($average_rating - $full_stars) >= 0.5;

                            for ($i = 0; $i < $full_stars; $i++) {
                                echo '<span class="material-symbols-outlined fill-1 text-lg">star</span>';
                            }
                            if ($half_star) {
                                echo '<span class="material-symbols-outlined text-lg">star_half</span>';
                            }
                            $empty_stars = 5 - $full_stars - ($half_star ? 1 : 0);
                            for ($i = 0; $i < $empty_stars; $i++) {
                                echo '<span class="material-symbols-outlined text-lg">star</span>';
                            }
                            ?>
                        </div>
                        <a class="text-sm text-primary hover:underline" href="#reviews">(<?php echo esc_html($review_count); ?>
                            customer reviews)</a>
                    </div>
                <?php endif; ?>

                <!-- Price -->
                <div class="mb-6">
                    <div class="text-3xl font-bold text-slate-900 dark:text-white">
                        <?php echo $product_price; ?>
                    </div>
                </div>

                <!-- Stock Status -->
                <div class="flex items-center gap-2 mb-6">
                    <?php if ($stock_status): ?>
                        <span class="material-symbols-outlined text-green-500 text-lg">check_circle</span>
                        <span class="text-slate-700 dark:text-slate-300 font-medium">In stock</span>
                    <?php else: ?>
                        <span class="material-symbols-outlined text-red-500 text-lg">cancel</span>
                        <span class="text-slate-700 dark:text-slate-300 font-medium">Out of stock</span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Add to Cart Form -->
            <?php woocommerce_template_single_add_to_cart(); ?>

            <!-- Product Meta -->
            <div class="pt-6 border-t border-slate-100 dark:border-slate-800 mt-6 flex flex-col gap-2">
                <?php if ($product_sku): ?>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="font-semibold text-slate-700 dark:text-slate-300">SKU:</span>
                        <span class="text-slate-500 dark:text-slate-400"><?php echo esc_html($product_sku); ?></span>
                    </div>
                <?php endif; ?>

                <?php if ($product_categories): ?>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="font-semibold text-slate-700 dark:text-slate-300">Category:</span>
                        <div class="text-primary"><?php echo wp_kses_post($product_categories); ?></div>
                    </div>
                <?php endif; ?>

                <?php if ($product_tags): ?>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="font-semibold text-slate-700 dark:text-slate-300">Tags:</span>
                        <div class="flex gap-2 text-slate-500">
                            <?php echo wp_kses_post($product_tags); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Product Details Tabs -->
    <div class="max-w-[1280px] mx-auto w-full px-6 py-8">
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-6">Description</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <div class="lg:col-span-2 prose prose-slate dark:prose-invert max-w-none">
                    <?php echo apply_filters('the_content', $product_description); ?>
                </div>
            </div>
        </section>

        <!-- Additional Information -->
        <?php if ($product->has_attributes() || $product->has_dimensions() || $product->has_weight()): ?>
            <section class="mb-16">
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-6">Additional Information</h2>
                <div class="not-prose overflow-hidden rounded-lg border border-slate-200 dark:border-slate-800">
                    <table class="w-full text-sm text-left">
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            <?php
                            $attributes = $product->get_attributes();
                            $row_class = true;

                            foreach ($attributes as $attribute):
                                if (!$attribute->get_visible())
                                    continue;
                                ?>
                                <tr class="<?php echo $row_class ? 'bg-slate-50 dark:bg-slate-900/50' : ''; ?>">
                                    <th class="px-4 py-3 font-semibold text-slate-600 dark:text-slate-300 w-1/3 italic">
                                        <?php echo wc_attribute_label($attribute->get_name()); ?>
                                    </th>
                                    <td class="px-4 py-3 text-slate-600 dark:text-slate-400">
                                        <?php
                                        if ($attribute->is_taxonomy()) {
                                            $values = wc_get_product_terms($product_id, $attribute->get_name(), array('fields' => 'names'));
                                            echo esc_html(implode(', ', $values));
                                        } else {
                                            echo esc_html(implode(', ', $attribute->get_options()));
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                $row_class = !$row_class;
                            endforeach;

                            // Add weight and dimensions if available
                            if ($product->has_weight()):
                                ?>
                                <tr class="<?php echo $row_class ? 'bg-slate-50 dark:bg-slate-900/50' : ''; ?>">
                                    <th class="px-4 py-3 font-semibold text-slate-600 dark:text-slate-300 italic">Weight</th>
                                    <td class="px-4 py-3 text-slate-600 dark:text-slate-400">
                                        <?php echo esc_html($product->get_weight() . ' ' . get_option('woocommerce_weight_unit')); ?>
                                    </td>
                                </tr>
                                <?php
                                $row_class = !$row_class;
                            endif;

                            if ($product->has_dimensions()):
                                ?>
                                <tr class="<?php echo $row_class ? 'bg-slate-50 dark:bg-slate-900/50' : ''; ?>">
                                    <th class="px-4 py-3 font-semibold text-slate-600 dark:text-slate-300 italic">Dimensions</th>
                                    <td class="px-4 py-3 text-slate-600 dark:text-slate-400">
                                        <?php echo esc_html(wc_format_dimensions($product->get_dimensions(false))); ?>
                                    </td>
                                </tr>
                                <?php
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        <?php endif; ?>

        <!-- Reviews -->
        <?php if (comments_open() || get_comments_number()): ?>
            <section class="mb-16" id="reviews">
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-6">Reviews
                    (<?php echo esc_html($review_count); ?>)</h2>
                <div class="prose prose-slate dark:prose-invert max-w-none">
                    <?php comments_template(); ?>
                </div>
            </section>
        <?php endif; ?>

        <!-- Related Products -->
        <?php
        $related_products = wc_get_related_products($product_id, 4);
        if (!empty($related_products)):
            ?>
            <section class="border-t border-slate-200 dark:border-slate-800 pt-16">
                <h2 class="text-2xl font-bold mb-8">Related Products</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <?php
                    foreach ($related_products as $related_product_id):
                        $related_product = wc_get_product($related_product_id);
                        if (!$related_product)
                            continue;

                        $related_image_id = $related_product->get_image_id();
                        $related_categories = wc_get_product_category_list($related_product_id);
                        ?>
                        <div
                            class="group bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg overflow-hidden flex flex-col">
                            <div class="relative aspect-square overflow-hidden bg-slate-50 dark:bg-slate-800/30">
                                <a href="<?php echo esc_url(get_permalink($related_product_id)); ?>">
                                    <?php
                                    if ($related_image_id) {
                                        echo wp_get_attachment_image($related_image_id, 'medium', false, array(
                                            'class' => 'w-full h-full object-cover transition-transform duration-300 group-hover:scale-105',
                                            'alt' => esc_attr($related_product->get_name())
                                        ));
                                    } else {
                                        echo wc_placeholder_img('medium', 'w-full h-full object-cover transition-transform duration-300 group-hover:scale-105');
                                    }
                                    ?>
                                </a>
                                <div class="absolute inset-0 bg-black/5 group-hover:bg-black/0 transition-colors"></div>
                            </div>
                            <div class="p-4 flex flex-col flex-1">
                                <?php if ($related_categories): ?>
                                    <div class="text-sm text-slate-500 dark:text-slate-400 hover:text-primary mb-1">
                                        <?php echo wp_kses_post($related_categories); ?>
                                    </div>
                                <?php endif; ?>
                                <h3
                                    class="font-bold text-slate-900 dark:text-white mb-2 leading-snug hover:text-primary transition-colors">
                                    <a href="<?php echo esc_url(get_permalink($related_product_id)); ?>">
                                        <?php echo esc_html($related_product->get_name()); ?>
                                    </a>
                                </h3>
                                <div class="mt-auto">
                                    <p class="font-bold text-slate-900 dark:text-white mb-3">
                                        <?php echo $related_product->get_price_html(); ?>
                                    </p>
                                    <a href="<?php echo esc_url($related_product->add_to_cart_url()); ?>"
                                        class="block w-full py-2 bg-slate-100 dark:bg-slate-800 text-slate-900 dark:text-white text-xs font-bold rounded hover:bg-primary hover:text-white transition-all text-center">
                                        ADD TO CART
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
    </div>

<?php endwhile; ?>

<?php get_footer(); ?>