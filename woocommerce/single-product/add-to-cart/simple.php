<?php
/**
 * Simple product add to cart
 */

defined('ABSPATH') || exit;

global $product;

if (!$product->is_purchasable()) {
    return;
}

echo wc_get_stock_html($product);

if ($product->is_in_stock()): ?>

    <?php do_action('woocommerce_before_add_to_cart_form'); ?>

    <form class="cart flex flex-wrap gap-4 items-center"
        action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
        method="post" enctype='multipart/form-data'>
        <?php do_action('woocommerce_before_add_to_cart_button'); ?>

        <div class="flex items-center border border-slate-300 dark:border-slate-700 rounded-md">
            <button
                class="qty-minus w-10 h-12 flex items-center justify-center hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors border-r border-slate-300 dark:border-slate-700"
                type="button">
                <span class="material-symbols-outlined text-lg">remove</span>
            </button>
            <?php
            woocommerce_quantity_input(
                array(
                    'min_value' => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
                    'max_value' => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                    'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
                    'input_name' => 'quantity',
                    'classes' => array('input-text', 'qty', 'text', 'w-14', 'h-12', 'text-center', 'border-none', 'bg-transparent', 'focus:ring-0', 'font-bold', 'text-slate-900', 'dark:text-white'),
                ),
                $product
            );
            ?>
            <button
                class="qty-plus w-10 h-12 flex items-center justify-center hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors border-l border-slate-300 dark:border-slate-700"
                type="button">
                <span class="material-symbols-outlined text-lg">add</span>
            </button>
        </div>

        <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>"
            class="single_add_to_cart_button button alt bg-primary hover:bg-primary/90 text-white font-bold px-8 py-3 rounded-md transition-all flex-1 min-w-[150px] flex items-center justify-center gap-2 shadow-sm">
            <span class="material-symbols-outlined">shopping_cart</span>
            <?php echo esc_html($product->single_add_to_cart_text()); ?>
        </button>

        <?php do_action('woocommerce_after_add_to_cart_button'); ?>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Quantity increment/decrement
            document.querySelectorAll('.qty-plus').forEach(function (button) {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    var input = this.parentElement.querySelector('input[type="number"]');
                    var max = parseFloat(input.getAttribute('max')) || Infinity;
                    var currentVal = parseFloat(input.value) || 0;
                    if (currentVal < max) {
                        input.value = currentVal + 1;
                        input.dispatchEvent(new Event('change'));
                    }
                });
            });

            document.querySelectorAll('.qty-minus').forEach(function (button) {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    var input = this.parentElement.querySelector('input[type="number"]');
                    var min = parseFloat(input.getAttribute('min')) || 1;
                    var currentVal = parseFloat(input.value) || 0;
                    if (currentVal > min) {
                        input.value = currentVal - 1;
                        input.dispatchEvent(new Event('change'));
                    }
                });
            });
        });
    </script>

    <?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php endif; ?>