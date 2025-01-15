<!DOCTYPE html>
<html dir="ltr" lang="bn">
<head>
    <!-- Google Tag Manager -->
    @isset($google_tag->gtag_header)
        <script>
            (function(w,d,s,l,i){
                w[l]=w[l]||[];
                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event:'gtm.js'
                });
                var f=d.getElementsByTagName(s)[0],
                    j=d.createElement(s),
                    dl=l!='dataLayer'?'&l='+l:'';
                j.async=true;
                j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
                f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-{{$google_tag->gtag_header}}');
        </script>
    @endisset

    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:title" content="{{$title ?? $site_info->title}}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset($share_image ?? $site_info->logo) }}">
    <meta property="og:description" content="{{$title ?? $site_info->title}}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{$title ?? $site_info->title}}">
    <meta name="twitter:image" content="{{ asset($share_image ?? $site_info->logo) }}">

    <!-- Title -->
    <title>{{$title ?? $site_info->title}}</title>

    <!-- Preconnect to External Domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Bangla Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@400..800&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/frontend/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/frontend/style.css">
    <style>
        .bottom-border{
            border-style: solid;
    --border-style: solid;
    border-width: 0 0 3px;
    --border-top-width: 0px;
    --border-right-width: 0px;
    --border-bottom-width: 2px;
    --border-left-width: 0px;
    border-color: #1d6ff1;
    --border-color: #1d6ff1;
        }
    </style>

    {{-- Tab icon  --}}
    <!-- or for PNG favicon -->
    <link rel="shortcut icon" href="/{{$image ?? $site_info->logo}}" type="image/png">
    @stack('css')
    <!-- Facebook Pixel Code -->
    @isset($pixel_tag)
        <script>
            !function(f,b,e,v,n,t,s){
                if(f.fbq)return;
                n=f.fbq=function(){
                    n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)
                };
                if(!f._fbq)f._fbq=n;
                n.push=n;n.loaded=!0;n.version='2.0';
                n.queue=[];
                t=b.createElement(e);t.async=!0;
                t.src=v;
                s=b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t,s)
            }(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{$pixel_tag->ptag_header}}');
            fbq('track', 'PageView');

        </script>
        <noscript>
            <img height="1" width="1" style="display:none"
                src="https://www.facebook.com/tr?id={{$pixel_tag->ptag_header}}&ev=PageView&noscript=1"
                alt="fb pixel"
            />
        </noscript>
    @endisset
    
</head>

<body>
    @isset($google_tag->gtag_header)
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-{{$google_tag->gtag_header}}"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endisset

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v21.0"></script>
