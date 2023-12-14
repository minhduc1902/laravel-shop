<!DOCTYPE html>
<html lang="en">

@include('admin.components.header')

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('admin.components.navbar')

        @include('admin.components.sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>

        @include('admin.components.footer')
    </div>

</body>

</html>
