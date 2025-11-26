{{-- Facebook Pixel Code --}}
@php
    $fbPixelEnabled = \App\Models\Setting::get('facebook_pixel_enabled', '0');
    $fbPixelId = \App\Models\Setting::get('facebook_pixel_id', '');
@endphp

@if($fbPixelEnabled == '1' && !empty($fbPixelId))
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '{{ $fbPixelId }}');
fbq('track', 'PageView');
</script>
<noscript>
<img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id={{ $fbPixelId }}&ev=PageView&noscript=1"/>
</noscript>
<!-- End Meta Pixel Code -->
@endif

{{-- Google Analytics Code --}}
@php
    $gaEnabled = \App\Models\Setting::get('google_analytics_enabled', '0');
    $gaId = \App\Models\Setting::get('google_analytics_id', '');
@endphp

@if($gaEnabled == '1' && !empty($gaId))
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaId }}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '{{ $gaId }}');
</script>
<!-- End Google Analytics -->
@endif
