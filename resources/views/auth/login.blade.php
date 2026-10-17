
<x-guest-layout>
    <!-- Logo dan Judul TaskFlow -->
    <div class="mb-8 flex flex-col items-center text-center">
        <a href="{{ route('login') }}">
            <img
                src="{{ asset('images/taskflow_logo.png') }}"
                alt="Logo TaskFlow"
                class="h-20 w-auto object-contain"
            >
        </a>

        <h1 class="mt-4 text-2xl font-bold text-slate-900">
            Masuk ke TaskFlow
        </h1>

        <p class="mt-2 text-sm leading-6 text-slate-600">
            Masuk untuk mengelola dan memantau tugas harianmu.
        </p>
    </div>

    <!-- Status Login -->
    <x-auth-session-status
        class="mb-4"
        :status="session('status')"
    />

    <!-- Form Login -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label
                for="email"
                value="Alamat Email"
                class="font-medium text-slate-700"
            />

            <x-text-input
                id="email"
                class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                placeholder="nama@email.com"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />
        </div>

        <!-- Kata Sandi -->
        <div class="mt-5">
            <x-input-label
                for="password"
                value="Kata Sandi"
                class="font-medium text-slate-700"
            />

            <x-text-input
                id="password"
                class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Masukkan kata sandi"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />
        </div>

        <!-- Ingat Saya dan Lupa Kata Sandi -->
        <div class="mt-5 flex flex-wrap items-center justify-between gap-3">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    name="remember"
                >

                <span class="ms-2 text-sm text-slate-600">
                    Ingat saya
                </span>
            </label>

            @if (Route::has('password.request'))
                <a
                    class="text-sm font-medium text-indigo-600 hover:text-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 rounded-md"
                    href="{{ route('password.request') }}"
                >
                    Lupa kata sandi?
                </a>
            @endif
        </div>

        <!-- Tombol Login -->
        <div class="mt-6">
            <x-primary-button class="flex w-full justify-center rounded-xl bg-indigo-600 px-4 py-3 text-base font-semibold hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800">
                Masuk
            </x-primary-button>
        </div>
    </form>

    <!-- Tautan Registrasi -->
    <div class="mt-6 border-t border-slate-100 pt-5 text-center">
        <p class="text-sm text-slate-600">
            Belum punya akun?
            @if (Route::has('register'))
                <a
                    href="{{ route('register') }}"
                    class="font-semibold text-indigo-600 hover:text-indigo-800"
                >
                    Daftar sekarang
                </a>
            @endif
        </p>
    </div>
</x-guest-layout>
