<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Apotek')</title>
    
    @vite(['resources/css/app.css'])
</head>
<body class="bg-[#0f172a] antialiased m-0 p-0">
    
    @yield('content')

    @vite(['resources/js/app.js'])
</body>
</html>