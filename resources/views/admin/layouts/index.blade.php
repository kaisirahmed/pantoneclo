<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    @include('admin.components.meta.meta')
    <title>@yield('title') | Pantoneclo</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/icon.png') }}">
    @include('admin.components.link.link')  
</head>

<body class="layout-default">
    <div class="preloader loader-primary"></div>
    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">

        <!-- Header -->

        <div id="header" class="mdk-header js-mdk-header m-0" data-fixed>
            <div class="mdk-header__content">
                @include('admin.components.header.header')
            </div>
        </div>

        <!-- // END Header -->

        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content bg-grey">

            <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
                <div class="mdk-drawer-layout__content page">


                    <!-- Main Container -->
                    @yield('content')
                    <!-- End Main Container -->


                </div>
                <!-- // END drawer-layout__content -->

                <div class="mdk-drawer  js-mdk-drawer" id="default-drawer" data-align="start">
                    <div class="mdk-drawer__content">
                        @include('admin.components.sidebar.leftsidebar')
                    </div>
                </div>
            </div>
            <!-- // END drawer-layout -->

        </div>
        <!-- // END header-layout__content -->

    </div>
    <!-- // END header-layout -->


    <div class="mdk-drawer js-mdk-drawer" id="events-drawer" data-align="end">
        <div class="mdk-drawer__content">
            @include('admin.components.sidebar.rightsidebar')
        </div>
    </div>

    @include('admin.ajax.modal')

    @include('admin.components.script.script')
    @yield('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>

</html>