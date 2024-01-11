<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="/admin/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet"  href="/lightslider/src/css/lightslider.css"/>
    <link rel="stylesheet"  href="/css/productslider.css"/>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="justify-content-center">
<div class="header">
    <div class="container">
            <div class="row w-100 justify-content-center">
                <div class="col-lg-4 col-xs-1 header_item">
                    <a href="/"><img class="header_img" src="/images/logo2.jpg" alt="DentClub.MD"/></a>
                </div>
                <div class="col-lg-4 col-xs-1 header_item">
                  <div class="header_phone"><i class="fas fa-phone-alt"></i><a href="tel:+37362143388"> +373 62143388</a></div>
                </div>
                <div class="col-lg-4 col-xs-1 header_item">
                    <div class="header_small_button">
                        <div class="header_link"><a href="#" target="_blank" title="Facebook"><i class="fab fa-facebook"></i></a></div>
                        <div class="header_link"><a href="#" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a></div>
                    </div>
                </div>
        </div>
    </div>
</div>
<div class="header_black_line">
@include('blocks.top_category')
</div>
<div class="content">
    @yield('content')
</div>
<div class="footer">
    <hr>
    &copy; 2024 DentClub.MD
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="/lightslider/src/js/lightslider.js"></script>
<script>
    $(document).ready(function() {
        $("#content-slider").lightSlider({
            loop:true,
            keyPress:true
        });
        $('#image-gallery').lightSlider({
            gallery:true,
            item:1,
            slideMargin: 0,
            speed:2000,
            auto:true,
            loop:true,
            onSliderLoad: function() {
                $('#image-gallery').removeClass('cS-hidden');
            }
        });
    });
</script>
</body>
</html>
