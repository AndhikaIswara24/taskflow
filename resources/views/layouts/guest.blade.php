<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TaskFlow') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-slate-800">
    <main class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-slate-100 lg:grid lg:grid-cols-2">

        <!-- Panel Branding -->
        <section class="relative hidden min-h-screen flex-col justify-between overflow-hidden bg-gradient-to-br from-blue-100 via-blue-50 to-slate-100 p-10 lg:flex xl:p-16">
            <div class="absolute -right-24 top-20 h-72 w-72 rounded-full bg-blue-200/40 blur-3xl"></div>
            <div class="absolute -bottom-24 -left-20 h-80 w-80 rounded-full bg-blue-300/30 blur-3xl"></div>

            <a href="{{ url('/') }}" class="relative z-10 inline-flex w-fit items-center">
                <img src="{{ asset('images/taskflow_logo.png') }}"
                     alt="TEAM Task Management"
                     class="h-auto w-64 object-contain">
            </a>

            <div class="relative z-10 max-w-lg">
                <p class="mb-4 text-sm font-bold uppercase tracking-[0.25em] text-blue-700">
                    TEAM Task Management
                </p>

                <h1 class="text-4xl font-bold leading-tight text-slate-900 xl:text-5xl">
                    Kelola Tugas
                    <span class="block text-blue-600">Lebih Mudah</span>
                </h1>

                <p class="mt-6 max-w-md text-lg leading-8 text-slate-600">
                    Atur, pantau, dan selesaikan tugas harianmu dengan lebih terstruktur.
                </p>

                <div class="mt-10 space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-600 text-lg font-bold text-white shadow-lg shadow-blue-600/20">
                            ✓
                        </div>
                        <div>
                            <h2 class="font-semibold text-slate-900">Pantau progres tugas</h2>
                            <p class="mt-1 text-sm leading-6 text-slate-600">
                                Lihat perkembangan tugas dengan lebih mudah.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-600 text-lg font-bold text-white shadow-lg shadow-blue-600/20">
                            ↗
                        </div>
                        <div>
                            <h2 class="font-semibold text-slate-900">Tingkatkan produktivitas</h2>
                            <p class="mt-1 text-sm leading-6 text-slate-600">
                                Kelola prioritas dan tenggat waktu secara teratur.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-600 text-lg font-bold text-white shadow-lg shadow-blue-600/20">
                            ◎
                        </div>
                        <div>
                            <h2 class="font-semibold text-slate-900">Akses dengan mudah</h2>
                            <p class="mt-1 text-sm leading-6 text-slate-600">
                                Buka daftar tugas kapan pun kamu membutuhkannya.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="relative z-10 text-sm text-slate-500">
                © {{ date('Y') }} TEAM Task Management
            </p>
        </section>

        <!-- Panel Form -->
        <section class="flex min-h-screen items-center justify-center px-4 py-10 sm:px-8 lg:px-10">
            <div class="w-full max-w-lg rounded-3xl border border-white bg-white/95 p-6 shadow-2xl shadow-blue-900/10 sm:p-10">

                <!-- Logo untuk layar kecil -->
                <div class="mb-8 text-center lg:hidden">
                    <a href="{{ url('/') }}" class="inline-flex justify-center">
                        <img src="{{ asset('images/taskflow_logo.png') }}"
                             alt="TEAM Task Management"
                             class="h-auto w-52 object-contain">
                    </a>
                </div>

                {{ $slot }}

            </div>
        </section>

    </main>
</body>
</html>