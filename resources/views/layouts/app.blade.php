<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- SCRIPTS -->

        {{-- Local  --}}
        
        @vite([
            'resources/css/app.css', 'resources/js/app.js', 'node_modules/flowbite/dist/flowbite.js', 'node_modules/flowbite/dist/datepicker.js'
        ]) 
        
        

        {{-- Produccion con conexion a internet --}}
        {{--
        @vite([
            'resources/css/app.css', 'resources/js/app.js',
        ])
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/flowbite.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/datepicker.min.js"></script>
        --}}
        
        {{-- Produccion sin conexion a internet (reemplazar scipts por los de la build) --}}
        {{--
        @vite([
        'resources/css/app.css', 'resources/js/app.js',
        ])
        <script src="{{ asset('build/assets/flowbite-86c0100a.js') }}"></script>
        <script src="{{ asset('build/assets/datepicker-57ab9720.js') }}"></script>  
        --}}
        
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        
        @livewireScripts
    </body>
</html>
