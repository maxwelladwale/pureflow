<?php
/**
 * The footer template
 *
 * @package PureFlow
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<!-- Footer Area -->
<footer class="mt-20 border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 py-12">
    <div class="max-w-[1440px] mx-auto px-6 flex flex-col md:flex-row justify-between gap-8">
        <div class="max-w-xs">
            <div class="flex items-center gap-2 mb-4">
                <div class="bg-primary text-white p-1 rounded">
                    <span class="material-symbols-outlined block text-sm">water_drop</span>
                </div>
                <h2 class="text-lg font-bold tracking-tight text-slate-900 dark:text-white uppercase">
                    <?php bloginfo('name'); ?>
                </h2>
            </div>
            <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                <?php
                $description = get_bloginfo('description');
                echo $description ? esc_html($description) : 'Premium industrial and residential water treatment components. Trusted by technicians worldwide.';
                ?>
            </p>
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-12">
            <div>
                <h4 class="font-bold text-sm mb-4">Support</h4>
                <ul class="text-sm space-y-2 text-slate-500">
                    <li><a class="hover:text-primary" href="#">Help Center</a></li>
                    <li><a class="hover:text-primary" href="#">Contact Us</a></li>
                    <li><a class="hover:text-primary" href="#">Shipping Policy</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-bold text-sm mb-4">Account</h4>
                <ul class="text-sm space-y-2 text-slate-500">
                    <?php if (function_exists('WC')) : ?>
                        <li><a class="hover:text-primary" href="<?php echo esc_url(wc_get_account_endpoint_url('orders')); ?>">My Orders</a></li>
                        <li><a class="hover:text-primary" href="<?php echo esc_url(wc_get_account_endpoint_url('edit-address')); ?>">Addresses</a></li>
                        <li><a class="hover:text-primary" href="<?php echo esc_url(wc_get_account_endpoint_url('edit-account')); ?>">Account Details</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            
            <div class="col-span-2 sm:col-span-1">
                <h4 class="font-bold text-sm mb-4">Newsletter</h4>
                <div class="flex gap-2">
                    <input class="bg-slate-100 dark:bg-slate-800 border-none rounded-lg text-sm px-3 py-2 w-full" placeholder="Email address" type="email" id="newsletter-email">
                    <button class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-primary/90 transition-colors">Join</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="max-w-[1440px] mx-auto px-6 mt-12 pt-8 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row justify-between items-center gap-4 text-[11px] text-slate-400 font-medium">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
        <div class="flex gap-6">
            <a class="hover:text-primary" href="#">Privacy Policy</a>
            <a class="hover:text-primary" href="#">Terms of Service</a>
            <a class="hover:text-primary" href="#">Accessibility</a>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
