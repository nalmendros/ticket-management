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
        <div style="display: flex; align-items: center; gap: 50px; color: #01a76a; font-weight: 600;">
            <a style="font-size: 26px;" href="{{ route('ticket.index') }}">View Tickets</a>
            <a style="font-size: 26px;" href="{{ route('ticket.create') }}">Create Tickets</a>
        </div>
        @yield('content')
    </main>
</body>
</html>