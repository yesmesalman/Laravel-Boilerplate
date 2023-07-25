<!DOCTYPE html>
<html lang="en">

<head>
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <meta charset="utf-8" />
    <title>Laravel Boilerplate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="https://coderthemes.com/minton/layouts/assets/images/favicon.ico">

    <!-- App css -->
    <link href={{ asset('assets/css/default/bootstrap.min.css') }} rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />
    <link href={{ asset('assets/css/default/app.min.css') }} rel="stylesheet" type="text/css"
        id="app-default-stylesheet" />

    <link href={{ asset('assets/css/default/bootstrap-dark.min.css') }} rel="stylesheet" type="text/css"
        id="bs-dark-stylesheet" />
    <link href={{ asset('assets/css/default/app-dark.min.css') }} rel="stylesheet" type="text/css"
        id="app-dark-stylesheet" />

    <!-- icons -->
    <link href={{ asset('assets/css/icons.min.css') }} rel="stylesheet" type="text/css" />

</head>

@yield('content')

{{-- @section('footer_scripts') --}}
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<!-- DataTable -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
{{-- @endsection --}}

</html>
