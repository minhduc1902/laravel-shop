<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Online Shop :: Administrative Panel</title>
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('admin-assets/css/adminlte.min.css') }}">

<link rel="stylesheet" href="{{ asset('admin-assets/plugins/summernote/summernote-bs4.min.css') }}">

<link rel="stylesheet" href="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.css') }}">

<link rel="stylesheet" href="{{ asset('admin-assets/css/custom.css') }}">

<link rel="stylesheet" href="{{ asset('admin-assets/plugins/select2/css/select2.min.css') }}">

<meta name="csrf-token" content="{{ csrf_token() }}" />
@yield('css')
