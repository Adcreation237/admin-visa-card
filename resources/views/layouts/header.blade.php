<!DOCTYPE html>
<html lang="{{str_replace('_','-',app()->getLocale())}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN|VISA CARD</title>
    <link rel="shortcut icon" href="{{asset('img/cremin.png')}}" type="image/x-icon">

    <!-- Link -->
    <link rel="stylesheet" href="{{ asset('css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mycss.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('mdb/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('mdb/css/mdb.min.css') }}">
    <!-- Plugin file -->
    <link rel="stylesheet" href="{{ asset('mdb/css/addons/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('mdb/css/style.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">


</head>
<body>
    @yield('container')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/mdb.min.js') }}"></script>
    <script src="{{ asset('js/myjs.js') }}"></script>
    <script src="{{ asset('js/rapport_vente_1.js') }}"></script>

    <script type="text/javascript" src="{{ asset('mdb/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('mdb/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('mdb/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('mdb/js/mdb.min.js') }}"></script>
    <!-- Plugin file -->
    <script src="{{ asset('mdb/js/addons/datatables.min.js') }}"></script>

    <script type="text/javascript">
        setTimeout(function () {
            // Adding the class dynamically
            $('.alert').alert('close');
        }, 2000);


        $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });

        $(document).ready(function () {
            $('#dtBasicExample1').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
</body>
</html>
