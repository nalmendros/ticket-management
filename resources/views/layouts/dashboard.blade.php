<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <h1>Dashboard</h1>
    </header>
    <main>
        <a style="font-size: 26px;" href="{{ route('index') }}">View Tickets</a>
        <a style="font-size: 26px;" href="{{ route('create') }}">Create Tickets</a>
        @yield('content')
    </main>
</body>
</html>