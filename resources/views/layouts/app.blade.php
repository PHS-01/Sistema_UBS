<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Title')</title>
</head>
<body>
    <center>{{--Temporario--}}
        <nav>@yield('navbar','Navbar')</nav>

        <h1>@yield('title','Title')</h1>

        <div class="container">
            @yield('container','Container')
        </div>
    </center>
</body>
</html>