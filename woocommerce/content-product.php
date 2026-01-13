<?php
/**
 * The template for displaying product content within loops
 *
 * @package PureFlow
 */

if (!defined('ABSPATH')) {
    exit;
}

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
?>

<div <?php wc_product_class('bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden flex flex-col group transition-all hover:shadow-xl hover:shadow-slate-200/50 dark:hover:shadow-none', $product); ?>>
    
    <!-- Product Image -->
    <div class="relative aspect-square p-6 flex items-center justify-center bg-white">
        <a href="<?php echo esc_url($product->get_permalink()); ?>">
            <?php echo $product->get_image('woocommerce_thumbnail', array('class' => 'max-h-full object-contain mix-blend-multiply')); ?>
        </a>
        
        <!-- Stock Badge -->
        <?php if ($product->is_in_stock()) : ?>
            <span class="absolute top-4 left-4 bg-emerald-500 text-white text-[10px] font-bold px-2 py-0.5 rounded">
                IN STOCK
            </span>
        <?php else : ?>
            <span class="absolute top-4 left-4 bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded">
                OUT OF STOCK
            </span>
        <?php endif; ?>
        
        <!-- Sale Badge -->
        <?php if ($product->is_on_sale()) : ?>
            <span class="absolute top-4 right-4 bg-orange-500 text-white text-[10px] font-bold px-2 py-0.5 rounded">
                SALE
            </span>
        <?php endif; ?>
    </div>
    
    <!-- Product Info -->
    <div class="p-5 flex-1 flex flex-col">
        <div class="mb-1">
            <?php
            $categories = wp_get_post_terms($product->get_id(), 'product_cat');
            if (!empty($categories)) :
            ?>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                    <?php echo esc_html($categories[0]->name); ?>
                </span>
            <?php endif; ?>
            
            <h3 class="font-bold text-slate-900 dark:text-white leading-tight group-hover:text-primary transition-colors">
                <a href="<?php echo esc_url($product->get_permalink()); ?>">
                    <?php echo esc_html($product->get_name()); ?>
                </a>
            </h3>
            
            <p class="text-[11px] font-mono text-slate-500 mt-1">
                SKU: <?php echo $product->get_sku() ? esc_html($product->get_sku()) : 'N/A'; ?>
            </p>
        </div>
        
        <!-- Product Attributes/Specs -->
        <div class="my-4 space-y-2">
            <?php
            $attributes = $product->get_attributes();
            $count = 0;
            foreach ($attributes as $attribute) :
                if ($count >= 3) break; // Show max 3 attributes
                
                $values = array();
                if ($attribute->is_taxonomy()) {
                    $terms = wp_get_post_terms($product->get_id(), $attribute->get_name());
                    foreach ($terms as $term) {
                        $values[] = $term->name;
                    }
                } else {
                    $values = $attribute->get_options();
                }
                
                if (!empty($values)) :
            ?>
                <div class="flex items-center justify-between text-xs">
                    <span class="text-slate-500"><?php echo esc_html(wc_attribute_label($attribute->get_name())); ?></span>
                    <span class="font-semibold"><?php echo esc_html(implode(', ', $values)); ?></span>
                </div>
            <?php
                    $count++;
                endif;
            endforeach;
            
            // If no attributes, show short description excerpt
            if ($count === 0 && $product->get_short_description()) :
                $excerpt = wp_trim_words($product->get_short_description(), 10);
            ?>
                <p class="text-xs text-slate-600 dark:text-slate-400">
                    <?php echo wp_kses_post($excerpt); ?>
                </p>
            <?php endif; ?>
        </div>
        
        <!-- Price and Add to Cart -->
        <div class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <div class="flex flex-col">
                <span class="text-xl font-bold text-slate-900 dark:text-white">
                    <?php echo $product->get_price_html(); ?>
                </span>
            </div>
            
            <?php if ($product->is_purchasable() && $product->is_in_stock()) : ?>
                <?php
                woocommerce_template_loop_add_to_cart(array(
                    'class' => 'bg-primary hover:bg-primary/90 text-white p-2.5 rounded-lg transition-colors flex items-center gap-2',
                ));
                ?>
            <?php else : ?>
                <a href="<?php echo esc_url($product->get_permalink()); ?>" class="bg-slate-400 text-white p-2.5 rounded-lg flex items-center gap-2">
                    <span class="material-symbols-outlined text-xl">visibility</span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
