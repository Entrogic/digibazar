# Facebook Pixel & Google Analytics Integration - Implementation Guide

## Overview

A complete tracking module has been added to the admin panel that allows administrators to manage Facebook Pixel and Google Analytics tracking codes for the website.

## What Was Implemented

### 1. Database Settings

Created tracking settings in the database with the following fields:

-   **Facebook Pixel ID**: Text field to enter the Facebook Pixel ID
-   **Facebook Pixel Enabled**: Toggle to enable/disable Facebook Pixel
-   **Google Analytics ID**: Text field to enter the Google Analytics Measurement ID
-   **Google Analytics Enabled**: Toggle to enable/disable Google Analytics

### 2. Files Created/Modified

#### Created Files:

1. **database/seeders/FacebookPixelSeeder.php**

    - Seeder to add tracking settings to the database
    - Run with: `php artisan db:seed --class=FacebookPixelSeeder`

2. **resources/views/partials/tracking-scripts.blade.php**
    - Partial view that conditionally loads tracking scripts
    - Includes Facebook Pixel and Google Analytics code
    - Only loads when enabled in settings

#### Modified Files:

1. **resources/views/layouts/app.blade.php**
    - Added tracking scripts partial to the head section
    - Scripts will now load on all frontend pages

### 3. How It Works

#### Admin Side:

1. Admin logs into the admin panel
2. Navigates to **Settings** page (`/admin/settings`)
3. Scrolls to the **Tracking** section
4. Enters Facebook Pixel ID (e.g., `1234567890123456`)
5. Enables Facebook Pixel by checking the toggle
6. Optionally adds Google Analytics ID (e.g., `G-XXXXXXXXXX`)
7. Saves settings

#### Frontend Side:

-   When a user visits any page on the website
-   The system checks if tracking is enabled
-   If enabled and ID is provided, the tracking code is injected
-   Facebook Pixel tracks PageView events automatically
-   Google Analytics tracks page views and user behavior

## Usage Instructions

### Step 1: Access Admin Settings

1. Log in to admin panel: `http://127.0.0.1:8000/login`
2. Navigate to: `http://127.0.0.1:8000/admin/settings`

### Step 2: Configure Facebook Pixel

1. Scroll to the **Tracking** section
2. Enter your Facebook Pixel ID in the "Facebook Pixel ID" field
3. Check the "Enable Facebook Pixel" checkbox
4. Click "Save Settings"

### Step 3: Configure Google Analytics (Optional)

1. Enter your Google Analytics Measurement ID in the "Google Analytics ID" field
2. Check the "Enable Google Analytics" checkbox
3. Click "Save Settings"

### Step 4: Verify Installation

1. Visit your website frontend
2. Open browser Developer Tools (F12)
3. Go to Network tab
4. Look for requests to:
    - `facebook.net/en_US/fbevents.js` (Facebook Pixel)
    - `googletagmanager.com/gtag/js` (Google Analytics)

## Facebook Pixel Events

The implementation currently tracks:

-   **PageView**: Automatically tracked on every page load

### Adding Custom Events

To track custom events (e.g., Purchase, AddToCart), you can add them to your Blade templates:

```blade
<script>
fbq('track', 'Purchase', {
    value: {{ $order->order_total }},
    currency: 'BDT'
});
</script>
```

Common events:

-   `ViewContent`: When viewing a product
-   `AddToCart`: When adding to cart
-   `InitiateCheckout`: When starting checkout
-   `Purchase`: When completing an order

## Settings Structure

### Database Table: `settings`

```
id | setting_key              | value | type    | group_name | label                    | description
---|--------------------------|-------|---------|------------|--------------------------|-------------
1  | facebook_pixel_id        |       | text    | tracking   | Facebook Pixel ID        | Enter your...
2  | facebook_pixel_enabled   | 0     | boolean | tracking   | Enable Facebook Pixel    | Enable or...
3  | google_analytics_id      |       | text    | tracking   | Google Analytics ID      | Enter your...
4  | google_analytics_enabled | 0     | boolean | tracking   | Enable Google Analytics  | Enable or...
```

## Benefits

1. **Easy Management**: No code changes needed to update tracking IDs
2. **Toggle Control**: Enable/disable tracking without removing IDs
3. **Multiple Platforms**: Support for both Facebook and Google Analytics
4. **Cached Settings**: Settings are cached for better performance
5. **Automatic Loading**: Scripts load automatically on all pages when enabled

## Troubleshooting

### Tracking Not Working?

1. Check if tracking is enabled in admin settings
2. Verify the Pixel/Analytics ID is correct
3. Clear browser cache and reload
4. Check browser console for errors
5. Use Facebook Pixel Helper Chrome extension

### Settings Not Saving?

1. Check file permissions on storage directory
2. Clear application cache: `php artisan cache:clear`
3. Check database connection

## Future Enhancements

Possible additions:

-   Google Tag Manager support
-   TikTok Pixel integration
-   Custom event tracking interface
-   Conversion tracking dashboard
-   A/B testing integration

## Support

For issues or questions:

-   Check Laravel logs: `storage/logs/laravel.log`
-   Clear cache: `php artisan cache:clear`
-   Re-run seeder if settings missing: `php artisan db:seed --class=FacebookPixelSeeder`
