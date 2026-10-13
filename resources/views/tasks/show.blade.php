
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-xl font-bold text-gray-900">
                    Detail Tugas
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Lihat informasi lengkap dan kelola tugasmu.
                </p>
            </div>

            <a href="{{ route('tasks.index') }}"
               class="inline-flex min-h-10 items-center justify-center rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-50 py-8 sm:py-10">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

            {{-- Informasi utama tugas --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 p-5 sm:p-8">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-sm font-medium text-gray-500">
                            Detail tugas
                        </span>

                        <span class="text-gray-300">/</span>

                        <span class="text-sm text-gray-500">
                            #{{ $task->id }}
                        </span>
                    </div>

                    <h3 class="mt-3 break-words text-2xl font-bold text-gray-900 sm:text-3xl">
                        {{ $task->title }}
                    </h3>

                    <div class="mt-4 flex flex-wrap gap-2">
                        <span @class([
                            'inline-flex rounded-full px-3 py-1.5 text-xs font-semibold',
                            'bg-amber-100 text-amber-800' => $task->status === 'Belum Dikerjakan',
                            'bg-blue-100 text-blue-800' => $task->status === 'Dikerjakan',
                            'bg-green-100 text-green-800' => $task->status === 'Selesai',
                        ])>
                            {{ $task->status }}
                        </span>

                        <span @class([
                            'inline-flex rounded-full px-3 py-1.5 text-xs font-semibold',
                            'bg-green-100 text-green-800' => $task->priority === 'Rendah',
                            'bg-yellow-100 text-yellow-800' => $task->priority === 'Sedang',
                            'bg-red-100 text-red-800' => $task->priority === 'Tinggi',
                        ])>
                            Prioritas {{ $task->priority }}
                        </span>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="border-b border-gray-100 p-5 sm:p-8">
                    <h4 class="text-sm font-semibold text-gray-900">
                        Deskripsi Tugas
                    </h4>

                    <p class="mt-3 whitespace-pre-line break-words text-sm leading-7 text-gray-600">
                        {{ $task->description ?: 'Tidak ada deskripsi untuk tugas ini.' }}
                    </p>
                </div>

                {{-- Informasi tenggat --}}
                <div class="p-5 sm:p-8">
                    <h4 class="text-sm font-semibold text-gray-900">
                        Informasi Tenggat
                    </h4>

                    <div class="mt-4 rounded-xl border border-gray-200 bg-gray-50 p-4">
                        <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                            Tanggal Tenggat
                        </p>

                        @if ($task->due_date)
                            <p class="mt-2 font-semibold text-gray-900">
                                {{ $task->due_date->format('d-m-Y') }}
                            </p>

                            @if ($task->status !== 'Selesai' && $task->due_date->lt(today()))
                                <span class="mt-3 inline-flex rounded-full bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700">
                                    Terlambat
                                </span>
                            @elseif ($task->status === 'Selesai')
                                <p class="mt-2 text-sm text-green-700">
                                    Tugas telah selesai.
                                </p>
                            @elseif ($task->due_date->isToday())
                                <p class="mt-2 text-sm font-medium text-amber-700">
                                    Tenggat hari ini.
                                </p>
                            @else
                                <p class="mt-2 text-sm text-gray-500">
                                    Tenggat tugas belum terlewati.
                                </p>
                            @endif
                        @else
                            <p class="mt-2 font-medium text-gray-500">
                                Tidak ada tenggat waktu.
                            </p>
                        @endif
                    </div>
                </div>

                {{-- Tombol tindakan --}}
                <div class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50 p-5 sm:flex-row sm:justify-end sm:p-6">
                    <a href="{{ route('tasks.index') }}"
                       class="inline-flex min-h-11 items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-100">
                        Kembali
                    </a>

                    <a href="{{ route('tasks.edit', $task) }}"
                       class="inline-flex min-h-11 items-center justify-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Edit Tugas
                    </a>

                    <form method="POST"
                          action="{{ route('tasks.destroy', $task) }}"
                          onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="inline-flex min-h-11 w-full items-center justify-center rounded-lg bg-red-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            Hapus Tugas
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
