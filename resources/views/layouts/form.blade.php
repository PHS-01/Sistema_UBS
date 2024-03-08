<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Title')</title>

    <style>
        .form{
            width: 25%;
            display: flex;
            flex-direction: column;
        };
    </style>
</head>
<body>
    <center>
        <h1>@yield('title', 'Title')</h1>
        <form class="form" @yield('url') @yield('method')>
            @csrf
            @yield('form', 'Form')
        </form>
    </center>
</body>
</html>