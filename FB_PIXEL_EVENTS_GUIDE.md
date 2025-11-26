# Facebook Pixel Events - Quick Reference

## How to Add Facebook Pixel Events

Use the helper partial to easily add events to any Blade template:

```blade
@include('partials.fb-pixel-event', [
    'event' => 'EventName',
    'data' => [
        'key' => 'value'
    ]
])
```

## Common E-commerce Events

### 1. ViewContent (Product Page)

**Where**: Product detail pages

```blade
@include('partials.fb-pixel-event', [
    'event' => 'ViewContent',
    'data' => [
        'content_name' => $product->name,
        'content_ids' => [$product->id],
        'content_type' => 'product',
        'value' => $product->price,
        'currency' => 'BDT'
    ]
])
```

### 2. AddToCart

**Where**: When user adds product to cart

```blade
@include('partials.fb-pixel-event', [
    'event' => 'AddToCart',
    'data' => [
        'content_name' => $product->name,
        'content_ids' => [$product->id],
        'content_type' => 'product',
        'value' => $product->price,
        'currency' => 'BDT'
    ]
])
```

### 3. InitiateCheckout

**Where**: Checkout page

```blade
@include('partials.fb-pixel-event', [
    'event' => 'InitiateCheckout',
    'data' => [
        'content_ids' => [$product->id],
        'content_type' => 'product',
        'value' => $total,
        'currency' => 'BDT',
        'num_items' => $quantity
    ]
])
```

### 4. Purchase (Already Implemented)

**Where**: Order success page

```blade
@include('partials.fb-pixel-event', [
    'event' => 'Purchase',
    'data' => [
        'value' => $order->order_total,
        'currency' => 'BDT',
        'content_type' => 'product',
        'content_ids' => [$order->order_item->product_id],
        'num_items' => $order->order_item->quantity
    ]
])
```

### 5. Search

**Where**: Search results page

```blade
@include('partials.fb-pixel-event', [
    'event' => 'Search',
    'data' => [
        'search_string' => $searchQuery,
        'content_category' => 'Products'
    ]
])
```

### 6. Lead

**Where**: Contact form submission

```blade
@include('partials.fb-pixel-event', [
    'event' => 'Lead',
    'data' => [
        'content_name' => 'Contact Form',
        'content_category' => 'Contact'
    ]
])
```

### 7. CompleteRegistration

**Where**: User registration success

```blade
@include('partials.fb-pixel-event', [
    'event' => 'CompleteRegistration',
    'data' => [
        'content_name' => 'User Registration',
        'status' => 'completed'
    ]
])
```

## Standard Event Parameters

### Required Parameters

-   `value`: Monetary value (number)
-   `currency`: Currency code (e.g., 'BDT', 'USD')

### Common Parameters

-   `content_name`: Product/content name
-   `content_ids`: Array of product IDs
-   `content_type`: Type of content ('product', 'product_group')
-   `num_items`: Number of items
-   `content_category`: Product category
-   `search_string`: Search query

## Example Implementation Locations

### Product Page (resources/views/products/show.blade.php)

Add ViewContent event at the bottom:

```blade
@section('content')
    <!-- Product details here -->
@endsection

@push('scripts')
    @include('partials.fb-pixel-event', [
        'event' => 'ViewContent',
        'data' => [
            'content_name' => $product->name,
            'content_ids' => [$product->id],
            'value' => $product->price,
            'currency' => 'BDT'
        ]
    ])
@endpush
```

### Checkout Page (resources/views/checkout/product.blade.php)

Add InitiateCheckout event:

```blade
@push('scripts')
    @include('partials.fb-pixel-event', [
        'event' => 'InitiateCheckout',
        'data' => [
            'content_ids' => [$product->id],
            'value' => $product->price,
            'currency' => 'BDT'
        ]
    ])
@endpush
```

## Testing Your Events

### 1. Facebook Pixel Helper (Chrome Extension)

-   Install from Chrome Web Store
-   Visit your website
-   Click the extension icon
-   See all fired events

### 2. Facebook Events Manager

-   Go to Facebook Events Manager
-   Select your Pixel
-   Click "Test Events"
-   Enter your website URL
-   Perform actions and see events in real-time

### 3. Browser Console

Open Developer Tools and check for:

```javascript
fbq('track', 'EventName', {...})
```

## Best Practices

1. **Don't Duplicate Events**: Only fire each event once per action
2. **Use Consistent IDs**: Always use the same product ID format
3. **Include Value**: Always include monetary value for conversion events
4. **Test Before Launch**: Use Test Events to verify tracking
5. **Monitor Performance**: Check Events Manager regularly

## Troubleshooting

### Event Not Firing?

1. Check if Facebook Pixel is enabled in admin settings
2. Verify Pixel ID is correct
3. Check browser console for errors
4. Use Facebook Pixel Helper to debug

### Wrong Data?

1. Verify variable names match your database
2. Check data types (numbers vs strings)
3. Ensure currency code is correct

## Additional Resources

-   [Facebook Pixel Documentation](https://developers.facebook.com/docs/meta-pixel)
-   [Standard Events Reference](https://developers.facebook.com/docs/meta-pixel/reference)
-   [Conversion Tracking Guide](https://www.facebook.com/business/help/742478679120153)
