<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>@yield("title")</title>
        <meta
            content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
            name="viewport"
        />
        <link rel="icon" href="{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/img/logo_b2f.png" type="image/x-icon" />

        <!-- Fonts and icons -->
        <script src="{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/js/plugin/webfont/webfont.min.js"></script>
        <script>
            WebFont.load({
                google: { families: ['Public Sans:300,400,500,600,700'] },
                custom: {
                    families: [
                        'Font Awesome 5 Solid',
                        'Font Awesome 5 Regular',
                        'Font Awesome 5 Brands',
                        'simple-line-icons',
                    ],
                    urls: ['{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/css/fonts.min.css'],
                },
                active: function () {
                    sessionStorage.fonts = true;
                },
            });
        </script>

        <!-- CSS Files -->
        <link rel="stylesheet" href="{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/css/plugins.min.css" />
        <link rel="stylesheet" href="{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/css/kaiadmin.min.css" />

        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link rel="stylesheet" href="{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/css/demo.css" />
        <style>
            .btn-b2f {
                background-color: #feb801 !important;
                border-color: #feb801 !important;
                color: white !important;
            }

            .btn-b2f:hover {
                background-color: #d69a00 !important;
                border-color: #d69a00 !important;
            }

            .text-b2f {
                color: #feb801 !important;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
