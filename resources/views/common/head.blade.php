<head>
    <title> HR SYSTEM</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Flask & Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords"
        content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Flask & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <link rel="apple-touch-icon-precomposed" sizes="57x57"
        href="{{ asset('assets/favicomatic/hrLogo.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{ asset('assets/favicomatic/hrLogo.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{ asset('assets/favicomatic/hrLogo.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{ asset('assets/favicomatic/hrLogo.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60"
        href="{{ asset('assets/favicomatic/hrLogo.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120"
        href="{{ asset('assets/favicomatic/hrLogo.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76"
        href="{{ asset('assets/favicomatic/hrLogo.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152"
        href="{{ asset('assets/favicomatic/hrLogo.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets/favicomatic/hrLogo.png') }}"
        sizes="196x196" />
    <link rel="icon" type="image/png" href="{{ asset('assets/favicomatic/hrLogo.png') }}" sizes="96x96" />
    <link rel="icon" type="image/png" href="{{ asset('assets/favicomatic/hrLogo.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('assets/favicomatic/hrLogo.png') }}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{ asset('assets/favicomatic/hrLogo.png') }}" sizes="128x128" />
    <meta name="application-name" content="&nbsp;" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{ asset('assets/favicomatic/hrLogo.png') }}" />
    <meta name="msapplication-square70x70logo" content="{{ asset('assets/favicomatic/hrLogo.png') }}" />
    <meta name="msapplication-square150x150logo" content="{{ asset('assets/favicomatic/hrLogo.png') }}" />
    <meta name="msapplication-wide310x150logo" content="{{ asset('assets/favicomatic/hrLogo.png') }}" />
    <meta name="msapplication-square310x310logo" content="{{ asset('assets/favicomatic/hrLogo.png') }}" />

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>

<style>
    body {
        background-image: url('assets/media/auth/bg10.jpeg');
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    [data-theme="dark"] body {
        background-image: url('assets/media/auth/bg10-dark.jpeg');
    }

    .centered-div {
        padding: 20px;
        border-radius: 8px;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        max-width: 600px;
    }

    .bg-body {
        background-color: white;
    }
</style>
