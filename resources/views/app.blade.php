<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Property Rental and Sales</title>
        @vite('resources/js/app.js')
        @inertiaHead
        @routes
    </head>
    <body class="bg-[rgba(204,204,204,0.18)] dark:bg-gray-900 text-gray-800 dark:text-gray-300">
        @inertia
    </body>
</html>
