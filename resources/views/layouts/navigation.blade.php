<nav x-data="{ open: false, profileOpen: false }" class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Logo dan Menu Utama -->
            <div class="flex items-center gap-8">

                <!-- Logo TaskFlow -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 shrink-0">
                    <img
                        src="{{ asset('images/taskflow_logo.png') }}"
                        alt="Logo TaskFlow"
                        class="h-10 w-10 object-contain rounded-lg"
                    >

                    <span class="text-xl font-bold tracking-tight text-gray-900">
                        TaskFlow
                    </span>
                </a>

                <!-- Menu Desktop -->
                <div class="hidden sm:flex items-center gap-2">
                    <a
                        href="{{ route('dashboard') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition
                        {{ request()->routeIs('dashboard')
                            ? 'bg-indigo-50 text-indigo-700'
                            : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 3l9 7.5M5.5 9v11h13V9M9 20v-6h6v6"/>
                        </svg>
                        Dashboard
                    </a>

                    <a
                        href="{{ route('tasks.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition
                        {{ request()->routeIs('tasks.*')
                            ? 'bg-indigo-50 text-indigo-700'
                            : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                        </svg>
                        Daftar Tugas
                    </a>
                </div>
            </div>

            <!-- Profil Desktop -->
            <div class="hidden sm:flex items-center">
                <div class="relative" x-data="{ dropdownOpen: false }">
                    <button
                        type="button"
                        @click="dropdownOpen = !dropdownOpen"
                        @click.outside="dropdownOpen = false"
                        class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition"
                    >
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-100 text-indigo-700 font-semibold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>

                        <span>{{ Auth::user()->name }}</span>

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6"/>
                        </svg>
                    </button>

                    <div
                        x-show="dropdownOpen"
                        x-transition
                        @click.outside="dropdownOpen = false"
                        class="absolute right-0 z-50 mt-2 w-52 rounded-xl border border-gray-100 bg-white py-2 shadow-lg"
                        style="display: none;"
                    >
                        <div class="border-b border-gray-100 px-4 py-3">
                            <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="mt-1 truncate text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>

                        <a
                            href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-indigo-700"
                        >
                            Profil
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                type="submit"
                                class="block w-full px-4 py-2 text-left text-sm text-red-600 hover:bg-red-50"
                            >
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tombol Menu Mobile -->
            <div class="flex items-center sm:hidden">
                <button
                    type="button"
                    @click="open = !open"
                    class="inline-flex items-center justify-center rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700"
                    :aria-expanded="open.toString()"
                    aria-label="Buka menu navigasi"
                >
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>

                    <svg x-show="open" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Menu Mobile -->
    <div x-show="open" x-transition x-cloak class="sm:hidden border-t border-gray-100 bg-white">
        <div class="space-y-1 px-4 py-3">
            <a
                href="{{ route('dashboard') }}"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium
                {{ request()->routeIs('dashboard')
                    ? 'bg-indigo-50 text-indigo-700'
                    : 'text-gray-600 hover:bg-gray-50' }}"
            >
                Dashboard
            </a>

            <a
                href="{{ route('tasks.index') }}"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium
                {{ request()->routeIs('tasks.*')
                    ? 'bg-indigo-50 text-indigo-700'
                    : 'text-gray-600 hover:bg-gray-50' }}"
            >
                Daftar Tugas
            </a>
        </div>

        <div class="border-t border-gray-100 px-4 py-3">
            <div class="mb-3">
                <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                <p class="mt-1 break-all text-xs text-gray-500">{{ Auth::user()->email }}</p>
            </div>

            <div class="space-y-1">
                <a
                    href="{{ route('profile.edit') }}"
                    class="block rounded-lg px-3 py-2 text-sm text-gray-600 hover:bg-gray-50"
                >
                    Profil
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="block w-full rounded-lg px-3 py-2 text-left text-sm text-red-600 hover:bg-red-50"
                    >
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>