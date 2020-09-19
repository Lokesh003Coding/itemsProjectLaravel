<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        li.item-selected {
            background: green;
            color: white;
        }
        .clickable {
            cursor: pointer;
        }
    </style>
    @stack('css')
</head>
<body class="antialiased">

@include('layouts.header')


<main role="main">
    <div class="container">
        @yield('content')
    </div>
    <hr>

    <!-- FOOTER -->
    @include('layouts.footer')
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>

@stack('js')
</body>
</html>
