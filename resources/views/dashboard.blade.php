
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Dashboard TaskFlow
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Kelola dan pantau tugas harianmu.
                </p>
            </div>

            <a href="{{ route('tasks.create') }}"
               class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2
                      text-sm font-semibold text-white hover:bg-indigo-700">
                + Tambah Tugas
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        

        {{-- Ringkasan Tugas --}}
        <div class="mx-auto mb-6 max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-3 lg:grid-cols-3 xl:grid-cols-6">

                {{-- Total Tugas --}}
                <div class="dashboard-card rounded-lg border border-gray-200 bg-white p-3">
                    <p class="text-xs font-medium text-gray-500">Total Tugas</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        {{ $totalTasks }}
                    </p>
                    <p class="mt-1 text-xs text-gray-500">Semua tugas</p>
                </div>

                {{-- Belum Dikerjakan --}}
                <div class="dashboard-card rounded-lg border border-amber-200 bg-white p-3">
                    <p class="text-xs font-medium text-amber-700">Belum Dikerjakan</p>
                    <p class="mt-2 text-2xl font-bold text-amber-600">
                        {{ $pendingTasks }}
                    </p>
                    <p class="mt-1 text-xs text-gray-500">Menunggu dikerjakan</p>
                </div>

                {{-- Sedang Dikerjakan --}}
                <div class="dashboard-card rounded-lg border border-blue-200 bg-white p-3">
                    <p class="text-xs font-medium text-blue-700">Sedang Dikerjakan</p>
                    <p class="mt-2 text-2xl font-bold text-blue-600">
                        {{ $inProgressTasks }}
                    </p>
                    <p class="mt-1 text-xs text-gray-500">Dalam proses</p>
                </div>

                {{-- Selesai --}}
                <div class="dashboard-card rounded-lg border border-green-200 bg-white p-3">
                    <p class="text-xs font-medium text-green-700">Selesai</p>
                    <p class="mt-2 text-2xl font-bold text-green-600">
                        {{ $completedTasks }}
                    </p>
                    <p class="mt-1 text-xs text-gray-500">Telah selesai</p>
                </div>

                {{-- Tugas Terlambat --}}
                <div class="dashboard-card rounded-lg border border-red-200 bg-white p-3">
                    <p class="text-xs font-medium text-red-700">Tugas Terlambat</p>
                    <p class="mt-2 text-2xl font-bold text-red-600">
                        {{ $overdueTasks }}
                    </p>
                    <p class="mt-1 text-xs text-gray-500">Melewati tenggat</p>
                </div>

                {{-- Tenggat Hari Ini --}}
                <div class="dashboard-card rounded-lg border border-purple-200 bg-white p-3">
                    <p class="text-xs font-medium text-purple-700">Tenggat Hari Ini</p>
                    <p class="mt-2 text-2xl font-bold text-purple-600">
                        {{ $dueTodayTasks }}
                    </p>
                    <p class="mt-1 text-xs text-gray-500">Jatuh tempo hari ini</p>
                </div>

            </div>
        </div>

        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">

            <div class="dashboard-panel rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800">
                    Selamat datang di TaskFlow!
                </h3>

                <p class="mt-2 text-sm text-gray-600">
                    Gunakan TaskFlow untuk mencatat, mengatur prioritas,
                    dan memantau penyelesaian tugasmu.
                </p>

                <div class="mt-5">
                    <a href="{{ route('tasks.index') }}"
                       class="inline-flex items-center rounded-md border
                              border-gray-300 px-4 py-2 text-sm font-semibold
                              text-gray-700 hover:bg-gray-50">
                        Lihat Daftar Tugas
                    </a>
                </div>
            </div>

            <div class="dashboard-panel rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
                <div class="mb-4 flex items-center justify-between gap-3">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Daftar Tugas
                    </h3>
                    <a href="{{ route('tasks.index') }}"
                       class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                        Lihat semua
                    </a>
                </div>

                @if ($tasks->isNotEmpty())
                    <div class="space-y-3">
                        @foreach ($tasks as $task)
                            
<div class="rounded-xl border border-gray-200 p-4 transition hover:border-indigo-200 hover:shadow-sm">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">

        <div class="min-w-0">
            <h4 class="break-words font-semibold text-gray-900">
                {{ $task->title }}
            </h4>

            @if ($task->description)
                <p class="mt-2 whitespace-pre-line break-words text-sm text-gray-600">
                    {{ $task->description }}
                </p>
            @endif
        </div>

        <div class="flex flex-wrap gap-2">
            <span @class([
                'rounded-full px-3 py-1 text-xs font-semibold',
                'bg-amber-100 text-amber-800' => $task->status === 'Belum Dikerjakan',
                'bg-blue-100 text-blue-800' => $task->status === 'Dikerjakan',
                'bg-green-100 text-green-800' => $task->status === 'Selesai',
            ])>
                {{ $task->status }}
            </span>

            <span @class([
                'rounded-full px-3 py-1 text-xs font-semibold',
                'bg-green-100 text-green-800' => $task->priority === 'Rendah',
                'bg-yellow-100 text-yellow-800' => $task->priority === 'Sedang',
                'bg-red-100 text-red-800' => $task->priority === 'Tinggi',
            ])>
                Prioritas {{ $task->priority }}
            </span>
        </div>
    </div>

    <div class="mt-4 flex flex-wrap items-center justify-between gap-3 border-t border-gray-100 pt-3">
        <div class="text-sm text-gray-500">
            @if ($task->due_date)
                <span>Tenggat: {{ $task->due_date->format('d M Y') }}</span>

                @if ($task->status !== 'Selesai' && $task->due_date->lt(today()))
                    <span class="ml-2 inline-flex rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-700">
                        Terlambat
                    </span>
                @endif
            @else
                <span>Tidak ada tenggat waktu</span>
            @endif
        </div>

        <a href="{{ route('tasks.show', $task) }}"
           class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">
            Lihat detail &rarr;
        </a>
    </div>
</div>

                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500">
                        Belum ada tugas yang dibuat.
                    </p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
