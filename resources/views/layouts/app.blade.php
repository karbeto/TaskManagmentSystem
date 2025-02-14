<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Task Management System')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navigation Bar -->
    <nav class="bg-blue-600 text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('projects.index') }}" class="text-lg font-semibold">Task Manager</a>
            <div>
                <a href="{{ route('projects.index') }}" class="px-4">Projects</a>
                <a href="{{ route('categories.index') }}" class="px-4">Categories</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto py-6">
        @yield('content')
    </div>

</body>
</html>
