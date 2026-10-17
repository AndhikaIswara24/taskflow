
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TaskFlow') }}</title>

        <!-- Font -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link
            href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap"
            rel="stylesheet"
        />

        <!-- CSS dan JavaScript Laravel -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased text-gray-800">
        <div class="min-h-screen bg-slate-50">

            <!-- Navigasi -->
            @include('layouts.navigation')

            <!-- Judul Halaman -->
            @isset($header)
                <header class="border-b border-gray-200 bg-white">
                    <div class="mx-auto max-w-7xl px-4 py-5 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Konten Utama -->
            <main class="py-6 sm:py-8">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                    <!-- Notifikasi Sukses -->
                    @if (session('success'))
                        <div
                            role="status"
                            class="mb-5 flex items-start justify-between gap-4 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800"
                        >
                            <div class="flex items-start gap-3">
                                <span class="font-bold text-green-600">✓</span>
                                <p>{{ session('success') }}</p>
                            </div>

                            <button
                                type="button"
                                aria-label="Tutup notifikasi"
                                onclick="this.parentElement.remove()"
                                class="text-lg font-semibold text-green-700 hover:text-green-900"
                            >
                                &times;
                            </button>
                        </div>
                    @endif

                    <!-- Notifikasi Informasi -->
                    @if (session('info'))
                        <div
                            role="status"
                            class="mb-5 rounded-xl border border-blue-200 bg-blue-50 p-4 text-sm text-blue-800"
                        >
                            {{ session('info') }}
                        </div>
                    @endif

                    <!-- Notifikasi Validasi -->
                    @if ($errors->any())
                        <div
                            role="alert"
                            class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800"
                        >
                            <p class="font-semibold">
                                Periksa kembali data yang kamu masukkan:
                            </p>

                            <ul class="mt-2 list-inside list-disc space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Konten Halaman -->
                    {{ $slot }}

                </div>
            </main>
        </div>
    </body>
</html>
