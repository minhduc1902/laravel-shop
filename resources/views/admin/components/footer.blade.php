{{--<footer class="main-footer">--}}

{{--    <strong>Copyright &copy; 2014-2022 AmazingShop All rights reserved.--}}
{{--</footer>--}}

<script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin-assets/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin-assets/js/demo.js') }}"></script>

<script src="{{ asset('admin-assets/plugins/summernote/summernote.min.js') }}"></script>

<script src="{{ asset('admin-assets/plugins/select2/js/select2.min.js') }}"></script>

<script src="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.js') }}"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $(".summernote").summernote({
            height: 250
        });
    });
</script>
@yield('js')
