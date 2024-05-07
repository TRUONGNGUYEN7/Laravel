<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.elements.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('admin.elements.top-nav')
        @include('admin.elements.sidebar')
        <div class="content-wrapper">
            <div class="content-header">
            </div>
            <section class="content">
                <div class="container-fluid">
                    @yield('adcontent')
                </div>
            </section>
        </div>
        @include('admin.elements.footer')
    </div>
    @include('admin.elements.script')
</body>

</html>