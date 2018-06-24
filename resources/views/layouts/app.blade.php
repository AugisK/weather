<!DOCTYPE html>
<html lang="en">
<head>
    <title>Weather APP</title>

    <!-- CSS And JavaScript -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <meta name="_token" content="{{csrf_token()}}" />
</head>

<body>
<section id="panel" class="align-middle">
@yield('content')
</section>
</body>
</html>