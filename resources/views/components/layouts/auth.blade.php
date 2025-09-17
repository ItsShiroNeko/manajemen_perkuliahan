<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Auth' }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-blue-500 via-white to-purple-500 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md">
        <div class="text-center mb-8">

            {{-- Placeholder Foto --}}
<div class="flex justify-center mb-4 mt-6">
    <img src="{{ asset('images/logo.jpeg') }}" 
         alt="Logo"
         class="w-30 h-30 rounded-full shadow-lg object-cover">
</div>


            {{-- Headline --}}
            <h1 class="text-3xl font-bold text-blue-600 font-heading">Manajemen Perkuliahan</h1>
            <p class="text-gray-700 font-heading">Sistem Informasi Akademik</p>
        </div>

        {{ $slot }}
    </div>

</body>
</html>
