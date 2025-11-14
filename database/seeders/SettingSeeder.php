<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            [
                'setting_key' => 'site_name',
                'value' => 'DiziBazar',
                'type' => 'text',
                'group_name' => 'general',
                'label' => 'Site Name',
                'description' => 'The name of your website',
                'sort_order' => 1,
            ],
            [
                'setting_key' => 'site_tagline',
                'value' => 'মুদি থেকে উৎস — সবকিছু পৌঁছে যাবে আপনার দরজায়',
                'type' => 'text',
                'group_name' => 'general',
                'label' => 'Site Tagline',
                'description' => 'A short description of your site',
                'sort_order' => 2,
            ],
            [
                'setting_key' => 'site_description',
                'value' => 'কাজকর্মে ব্যস্ততার মাঝে সময় বাঁচান',
                'type' => 'textarea',
                'group_name' => 'general',
                'label' => 'Site Description',
                'description' => 'A longer description of your website',
                'sort_order' => 3,
            ],

            // Appearance Settings
            [
                'setting_key' => 'logo',
                'value' => '/logo1.png',
                'type' => 'image',
                'group_name' => 'appearance',
                'label' => 'Logo',
                'description' => 'Your website logo',
                'sort_order' => 1,
            ],
            [
                'setting_key' => 'favicon',
                'value' => '/favicon.ico',
                'type' => 'image',
                'group_name' => 'appearance',
                'label' => 'Favicon',
                'description' => 'Website favicon (16x16 or 32x32 pixels)',
                'sort_order' => 2,
            ],
            [
                'setting_key' => 'header_bg_image',
                'value' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=1200',
                'type' => 'image',
                'group_name' => 'appearance',
                'label' => 'Header Background Image',
                'description' => 'Background image for hero section',
                'sort_order' => 3,
            ],

            // Contact Settings
            [
                'setting_key' => 'contact_phone',
                'value' => '০১৭১২৩৪৫৬৭৮',
                'type' => 'text',
                'group_name' => 'contact',
                'label' => 'Contact Phone',
                'description' => 'Primary contact phone number',
                'sort_order' => 1,
            ],
            [
                'setting_key' => 'contact_email',
                'value' => 'support@dizibazar.com',
                'type' => 'email',
                'group_name' => 'contact',
                'label' => 'Contact Email',
                'description' => 'Primary contact email address',
                'sort_order' => 2,
            ],
            [
                'setting_key' => 'contact_address',
                'value' => 'ঢাকা, বাংলাদেশ',
                'type' => 'textarea',
                'group_name' => 'contact',
                'label' => 'Contact Address',
                'description' => 'Business address',
                'sort_order' => 3,
            ],

            // Footer Settings
            [
                'setting_key' => 'footer_text',
                'value' => '© 2025 DiziBazar. সকল অধিকার সংরক্ষিত।',
                'type' => 'text',
                'group_name' => 'footer',
                'label' => 'Footer Copyright Text',
                'description' => 'Copyright text shown in footer',
                'sort_order' => 1,
            ],
            [
                'setting_key' => 'footer_description',
                'value' => 'DiziBazar হলো আপনার নির্ভরযোগ্য অনলাইন শপিং পার্টনার। আমরা তাজা ও মানসম্পন্ন পণ্য সরবরাহ করি।',
                'type' => 'textarea',
                'group_name' => 'footer',
                'label' => 'Footer Description',
                'description' => 'Description text shown in footer',
                'sort_order' => 2,
            ],

            // Social Media Settings
            [
                'setting_key' => 'facebook_url',
                'value' => '#',
                'type' => 'url',
                'group_name' => 'social',
                'label' => 'Facebook URL',
                'description' => 'Facebook page URL',
                'sort_order' => 1,
            ],
            [
                'setting_key' => 'instagram_url',
                'value' => '#',
                'type' => 'url',
                'group_name' => 'social',
                'label' => 'Instagram URL',
                'description' => 'Instagram page URL',
                'sort_order' => 2,
            ],
            [
                'setting_key' => 'youtube_url',
                'value' => '#',
                'type' => 'url',
                'group_name' => 'social',
                'label' => 'YouTube URL',
                'description' => 'YouTube channel URL',
                'sort_order' => 3,
            ],

            // Business Settings
            [
                'setting_key' => 'delivery_charge',
                'value' => '0',
                'type' => 'number',
                'group_name' => 'business',
                'label' => 'Delivery Charge',
                'description' => 'Default delivery charge (0 for free)',
                'sort_order' => 1,
            ],
            [
                'setting_key' => 'min_order_amount',
                'value' => '100',
                'type' => 'number',
                'group_name' => 'business',
                'label' => 'Minimum Order Amount',
                'description' => 'Minimum amount required for order',
                'sort_order' => 2,
            ],
            [
                'setting_key' => 'currency_symbol',
                'value' => '৳',
                'type' => 'text',
                'group_name' => 'business',
                'label' => 'Currency Symbol',
                'description' => 'Currency symbol to display',
                'sort_order' => 3,
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['setting_key' => $setting['setting_key']],
                $setting
            );
        }
    }
}
