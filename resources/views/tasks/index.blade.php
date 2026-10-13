
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                Daftar Tugas
            </h2>

            <a href="{{ route('tasks.create') }}"
               class="rounded-md bg-indigo-600 px-4 py-2 text-sm
                      font-semibold text-white hover:bg-indigo-700">
                + Tambah Tugas
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            
            

            {{-- Form pencarian dan filter --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-gray-900">
                        Cari dan Filter Tugas
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Temukan tugas berdasarkan judul, status, atau prioritas.
                    </p>
                </div>

                <form method="GET"
                    action="{{ route('tasks.index') }}"
                    class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

                    <div>
                        <label for="search"
                            class="block text-sm font-semibold text-gray-700">
                            Judul Tugas
                        </label>

                        <input id="search"
                            name="search"
                            type="search"
                            value="{{ request('search') }}"
                            placeholder="Cari judul tugas..."
                            class="mt-2 block min-h-11 w-full rounded-lg border-gray-300 text-sm shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="status"
                            class="block text-sm font-semibold text-gray-700">
                            Status
                        </label>

                        <select id="status"
                                name="status"
                                class="mt-2 block min-h-11 w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua Status</option>

                            @foreach (['Belum Dikerjakan', 'Dikerjakan', 'Selesai'] as $status)
                                <option value="{{ $status }}"
                                    @selected(request('status') === $status)>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="priority"
                            class="block text-sm font-semibold text-gray-700">
                            Prioritas
                        </label>

                        <select id="priority"
                                name="priority"
                                class="mt-2 block min-h-11 w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua Prioritas</option>

                            @foreach (['Rendah', 'Sedang', 'Tinggi'] as $priority)
                                <option value="{{ $priority }}"
                                    @selected(request('priority') === $priority)>
                                    {{ $priority }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="sort"
                            class="block text-sm font-semibold text-gray-700">
                            Urutkan Berdasarkan
                        </label>

                        <select id="sort"
                                name="sort"
                                class="mt-2 block min-h-11 w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="terbaru"
                                @selected(request('sort', 'terbaru') === 'terbaru')>
                                Terbaru Dibuat
                            </option>

                            <option value="tenggat"
                                @selected(request('sort') === 'tenggat')>
                                Tenggat Terdekat
                            </option>

                            <option value="prioritas"
                                @selected(request('sort') === 'prioritas')>
                                Prioritas Tertinggi
                            </option>

                            <option value="judul"
                                @selected(request('sort') === 'judul')>
                                Judul A–Z
                            </option>
                        </select>
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit"
                                class="inline-flex min-h-11 flex-1 items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Cari Tugas
                        </button>

                        <a href="{{ route('tasks.index') }}"
                        class="inline-flex min-h-11 items-center justify-center rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            {{-- Tabel daftar tugas --}}
            <div class="overflow-hidden rounded-lg bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs
                                           font-semibold uppercase">
                                    Tugas
                                </th>
                                <th class="px-6 py-3 text-left text-xs
                                           font-semibold uppercase">
                                    Prioritas
                                </th>
                                <th class="px-6 py-3 text-left text-xs
                                           font-semibold uppercase">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs
                                           font-semibold uppercase">
                                    Tenggat
                                </th>
                                <th class="px-6 py-3 text-left text-xs
                                           font-semibold uppercase">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse ($tasks as $task)
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">
                                            {{ $task->title }}
                                        </div>
                                        <div class="mt-1 max-w-xs truncate
                                                    text-sm text-gray-500">
                                            {{ $task->description ?: 'Tidak ada deskripsi' }}
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span @class([
                                            'inline-flex rounded-full px-3 py-1 text-xs font-semibold',
                                            'bg-green-100 text-green-800' => $task->priority === 'Rendah',
                                            'bg-yellow-100 text-yellow-800' => $task->priority === 'Sedang',
                                            'bg-red-100 text-red-800' => $task->priority === 'Tinggi',
                                        ])>
                                            {{ $task->priority }}
                                        </span>
                                    </td>                                    
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span @class([
                                            'inline-flex rounded-full px-3 py-1 text-xs font-semibold',
                                            'bg-amber-100 text-amber-800' => $task->status === 'Belum Dikerjakan',
                                            'bg-blue-100 text-blue-800' => $task->status === 'Dikerjakan',
                                            'bg-green-100 text-green-800' => $task->status === 'Selesai',
                                        ])>
                                            {{ $task->status }}
                                        </span>
                                    </td>                                    
                                    <td class="whitespace-nowrap px-6 py-4 text-sm">
                                        @if ($task->due_date)
                                            <div class="font-medium text-gray-700">
                                                {{ $task->due_date->format('d-m-Y') }}
                                            </div>

                                            @if ($task->status !== 'Selesai' && $task->due_date->lt(today()))
                                                <span class="mt-1 inline-flex rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-700">
                                                    Terlambat
                                                </span>
                                            @endif
                                        @else
                                            <span class="text-gray-400">Tanpa tenggat</span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm">
                                        <a href="{{ route('tasks.show', $task) }}"
                                           class="text-indigo-600 hover:underline">
                                            Detail
                                        </a>

                                        <a href="{{ route('tasks.edit', $task) }}"
                                           class="ml-3 text-blue-600 hover:underline">
                                            Edit
                                        </a>

                                        <form action="{{ route('tasks.destroy', $task) }}"
                                              method="POST" class="mt-2"
                                              onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="text-red-600 hover:underline">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="px-6 py-10 text-center text-gray-500">
                                        Belum ada tugas. Klik Tambah Tugas untuk membuat tugas pertama.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-gray-200 px-6 py-4">
                    {{ $tasks->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
