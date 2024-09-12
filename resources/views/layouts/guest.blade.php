<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('/images/Innovato_logo.png') }}" type="image/png">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="header header-custom-design text-white py-4 flex flex-col md:flex-row items-center justify-center text-center">
        <!-- Logo -->
        <img src="{{asset('/images/Innovato_logo.png')}}" alt="Company Logo" class="h-10 w-auto mb-2 md:mb-0 md:mr-4">
        <!-- Header Text -->
        <h1 class="text-xl md:text-3xl font-spectral font-semibold text-custom-blue leading-tight">
            INNOVATO INFORMATION TECHNOLOGY SOLUTIONS
        </h1>
    </div>

    <div class=" flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-custom-design min-h-screen">

        <div>

        </div>

        <div class="w-full md:max-w-xl h-102 px-6 py-4 bg-custom-white  shadow-2xl overflow-hidden sm:rounded-lg border border-gray-200 ">

            {{ $slot }}
        </div>
    </div>
</body>

</html>