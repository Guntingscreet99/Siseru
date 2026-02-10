<link rel="icon" href="{{ asset('admin/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />

<!-- Fonts and icons -->
<script src="{{ asset('admin/js/plugin/webfont/webfont.min.js') }}"></script>
<script>
    WebFont.load({
        google: {
            families: ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["{{ asset('admin/css/fonts.min.css') }}"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
</script>

<!-- CSS Files -->
<link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/css/plugins.min.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/css/kaiadmin.min.css') }}" />

<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="{{ asset('admin/css/demo.css') }}" />

{{-- Icon --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

{{-- <style>
    @media (max-width: 991.98px) {
        .sidebar {
            position: fixed !important;
            z-index: 1050;
        }

        .main-panel {
            margin-left: 0 !important;
        }

        .wrapper.sidebar_minimize .main-panel {
            margin-left: 0 !important;
        }
    }

    /* Pastikan offcanvas punya lebar yang pas di tablet */
    @media (min-width: 576px) and (max-width: 991.98px) {
        .offcanvas-lg {
            width: 280px !important;
        }
    }
</style> --}}
