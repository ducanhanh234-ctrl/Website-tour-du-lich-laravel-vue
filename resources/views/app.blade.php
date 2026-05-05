<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/js/app.ts'])
    @routes
    @inertiaHead
</head>
<body>
    <div id="app" class="font-sans text-gray-900 antialiased">
        @inertia
    </div>
</body>
</html>
