{{-- 
    Facebook Pixel Event Helper
    
    Usage: @include('partials.fb-pixel-event', ['event' => 'Purchase', 'data' => ['value' => 100, 'currency' => 'BDT']])
--}}

@php
    $fbPixelEnabled = \App\Models\Setting::get('facebook_pixel_enabled', '0');
@endphp

@if($fbPixelEnabled == '1' && isset($event))
<script>
fbq('track', '{{ $event }}'@if(isset($data) && !empty($data)), {!! json_encode($data) !!}@endif);
</script>
@endif
