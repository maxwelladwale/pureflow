# PureFlow Water Parts - Custom WooCommerce Theme

A lightweight, performance-optimized custom WordPress theme for water treatment machinery parts e-commerce.

## Features

- ✅ Custom WooCommerce integration
- ✅ Tailwind CSS for styling
- ✅ Responsive design (mobile, tablet, desktop)
- ✅ Product filtering and search
- ✅ AJAX cart updates
- ✅ Dark mode support
- ✅ Material Icons
- ✅ Clean, modern UI matching your Figma design

## Installation

### 1. Upload Theme
- Download/zip the `pureflow-theme` folder
- Go to WordPress Admin → Appearance → Themes → Add New → Upload Theme
- Choose the zip file and click Install Now
- Activate the theme

### 2. Required Plugins
Install these plugins for full functionality:
- **WooCommerce** (required)
- **Contact Form 7** (optional, for contact forms)

### 3. WooCommerce Setup
1. Go to WooCommerce → Settings
2. Complete the setup wizard
3. Configure:
   - Currency: KES (Kenyan Shilling)
   - Payment methods (M-Pesa integration recommended)
   - Shipping zones and rates
   - Tax settings

### 4. Import Products
1. Go to Products → All Products → Import
2. Upload the `water_treatment_products.csv` file
3. Map columns and run import

### 5. Configure Menus
1. Go to Appearance → Menus
2. Create a new menu for "Primary Menu"
3. Add pages: Shop, Resources, Support
4. Assign to "Primary Menu" location

### 6. Configure Sidebar (Optional)
1. Go to Appearance → Widgets
2. Add widgets to "Shop Sidebar" for filtering

## Customization

### Colors
Edit colors in `functions.php` (line 50+) in the Tailwind config:
```javascript
colors: {
    "primary": "#137fec",        // Your brand color
    "background-light": "#f6f7f8",
    "background-dark": "#101922",
}
```

### Logo
Replace the water drop icon in `header.php` (line 45) with your own logo image

### Fonts
Current font: Inter
To change, update in `functions.php` (line 30) and Tailwind config

## File Structure

```
pureflow-theme/
├── assets/
│   ├── css/              # Custom CSS (if needed)
│   └── js/
│       └── scripts.js    # Custom JavaScript
├── woocommerce/
│   ├── archive-product.php   # Shop page template
│   └── content-product.php   # Product card template
├── functions.php         # Theme functions and WooCommerce setup
├── header.php           # Header template
├── footer.php           # Footer template
├── index.php            # Fallback template
└── style.css            # Theme metadata
```

## What's Next?

### Immediate Tasks (Already functional):
- ✅ Shop page with filtering
- ✅ Product cards with specs
- ✅ Cart integration
- ✅ Search functionality

### To Build Next (Estimated 10-12 hours):
1. **Single Product Page** (3-4 hours)
2. **Cart Page** (2 hours)
3. **Checkout Page** (3-4 hours)
4. **My Account Pages** (2-3 hours)

### Kenya-Specific Integrations:
- M-Pesa payment gateway
- WhatsApp Business integration
- KRA eTIMS compliance
- Mobile-first optimizations

## Performance Notes

### Current Setup (Development):
- Using Tailwind CDN (easy but not optimized)
- ~50KB CSS load

### Production Optimization:
Replace Tailwind CDN with compiled CSS:
1. Install Tailwind: `npm install -D tailwindcss`
2. Create `tailwind.config.js`
3. Build: `npx tailwindcss -o assets/css/style.css --minify`
4. Update `functions.php` to enqueue compiled CSS

This reduces CSS from ~50KB to ~8KB!

## Support

For customization or issues:
1. Check WooCommerce documentation
2. WordPress Codex for template hierarchy
3. Tailwind CSS documentation

## License

GPL v2 or later

---

## Quick Reference

### Adding New Product Attributes:
1. Products → Attributes
2. Create attribute (e.g., "Capacity", "Material")
3. Add terms (e.g., "75 GPD", "Stainless Steel")
4. Edit products to assign attributes
5. They'll automatically show in product cards

### Customizing Product Card:
Edit `woocommerce/content-product.php`

### Customizing Shop Layout:
Edit `woocommerce/archive-product.php`

### Changing Products Per Page:
Edit `functions.php` line 85 (currently set to 12)

### Changing Grid Columns:
Edit `functions.php` line 92 (currently 3 columns)
