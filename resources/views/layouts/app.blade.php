<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-light-100 dark:bg-light-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-light-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="min-h-screen">
                {{ $slot }}
            </main>

<footer class="bg-gray-800 text-white mt-10">
  <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col sm:flex-row items-center justify-between">
    <p class="text-sm">&copy; {{ date('Y') }} Loyalty Reward System</p>
    <p class="text-sm mt-2 sm:mt-0">All rights reserved.</p>
  </div>
</footer>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
        <script>
            function openCreateModal() {
                document.getElementById('createUserModal').classList.remove('hidden');
            }

            function closeCreateModal() {
                document.getElementById('createUserModal').classList.add('hidden');
            }

            function openModal(id) {
                document.getElementById(`editModal-${id}`).classList.remove('hidden');
            }

            function closeModal(id) {
                document.getElementById(`editModal-${id}`).classList.add('hidden');
            }
        </script>

        {{-- JS to open/close modal --}}
        <script>
        function openCreateRewardModal() { document.getElementById('createRewardModal').classList.remove('hidden'); }
        function closeCreateRewardModal() { document.getElementById('createRewardModal').classList.add('hidden'); }
        </script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    </body>
</html>
