<!DOCTYPE html>
<html>
{{-- NOTES: THIS IS THE BROWSER TAB --}}

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="G-Buy description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#100DD1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags-->
    <title>G-BUY</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap">
    <!-- Favicon-->
    <link rel="icon" href="../img/icons/icon-72x72.png">
    <!-- Apple Touch Icon-->
    <link rel="apple-touch-icon" href="../img/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../img/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="../img/icons/icon-167x167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/icons/icon-180x180.png">
    <!-- CSS Libraries-->
    <link href=" {{ mix('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href=" {{ mix('css/animate.css') }}" rel="stylesheet">
    <link href=" {{ mix('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href=" {{ mix('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href=" {{ mix('css/default/lineicons.min.css') }}" rel="stylesheet">
    <link href=" {{ mix('css/style.css') }}" rel="stylesheet">
    <link href=" {{ mix('css/app.css') }}" rel="stylesheet">


    <!-- Web App Manifest-->
    {{-- <link rel="manifest" href="manifest.json"> --}}


</head>

<body>
    <div id="app">
        <app></app>
    </div>
    {{-- to support app.js --}}
	<script src="{{ mix('js/bootstrap.js') }}"></script>

    {{-- user code - app.js --}}
	<script src="{{ mix('js/app.js') }}"></script>

	{{-- suha theme --}}
	<script src="{{ mix('js/bootstrap.bundle.min.js') }}"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.0/jquery.waypoints.js"></script>
    <script src="{{ mix('js/jquery.easing.min.js') }}"></script>
    <script src="{{ mix('js/owl.carousel.min.js') }}"></script>
    <script src="{{ mix('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ mix('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ mix('js/default/jquery.passwordstrength.js') }}"></script>
    <script src="{{ mix('js/default/dark-mode-switch.js') }}"></script>
    <script src="{{ mix('js/default/no-internet.js') }}"></script>
    <script src="{{ mix('js/default/active.js') }}"></script>
    <script src="{{ mix('js/pwa.js') }}"></script>


</body>

</html>
