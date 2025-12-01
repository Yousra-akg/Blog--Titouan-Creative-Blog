<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Back-office Blog</title>
       @vite('resources/css/app.css')
   @vite('resources/js/app.js')
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow p-4">
        <div class="container mx-auto flex justify-between">
            <a href="{{ route('articles.index') }}" class="text-xl font-bold">Back-office Articles</a>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>