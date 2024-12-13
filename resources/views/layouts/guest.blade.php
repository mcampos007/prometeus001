<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Layout</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
</head>

<body>

    <div class="container">
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>
        <h1>Bienvenido</h1>
        <div class="form-container">
            {{ $slot }}
        </div>
    </div>

</body>

</html>
