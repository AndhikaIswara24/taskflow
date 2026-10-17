<x-guest-layout>
    <!-- Logo dan Judul TaskFlow -->
    <div class="mb-6 flex flex-col items-center">
        <a href="{{ route('login') }}">
            <img
                src="{{ asset('images/taskflow_logo.png') }}"
                alt="Logo TaskFlow"
                class="h-20 w-auto object-contain"
            >
        </a>

        <h1 class="mt-3 text-2xl font-bold text-gray-800">
            Selamat Datang di TaskFlow
        </h1>

        <p class="mt-1 text-sm text-gray-600 text-center">
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
            <x-input-label for="email" value="Alamat Email" />

            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />
        </div>

        <!-- Kata Sandi -->
        <div class="mt-4">
            <x-input-label for="password" value="Kata Sandi" />

            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />
        </div>

        <!-- Ingat Saya -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    name="remember"
                >

                <span class="ms-2 text-sm text-gray-600">
                    Ingat saya
                </span>
            </label>
        </div>

        <!-- Tombol Login -->
        <div class="mt-6 flex items-center justify-end">
            @if (Route::has('password.request'))
                <a
                    class="text-sm text-gray-600 underline hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}"
                >
                    Lupa kata sandi?
                </a>
            @endif

            <x-primary-button class="ms-3">
                Masuk
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
