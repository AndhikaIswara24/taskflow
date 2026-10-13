
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-xl font-bold text-gray-900">
                    Tambah Tugas Baru
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Catat tugas, tentukan prioritas, dan atur tenggat waktu.
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

            <div class="mb-6 rounded-xl border border-indigo-100 bg-indigo-50 p-5">
                <h3 class="font-semibold text-indigo-950">
                    Buat tugas baru
                </h3>
                <p class="mt-1 text-sm leading-6 text-indigo-800">
                    Isi informasi tugas di bawah ini. Kolom bertanda
                    <span class="font-semibold">*</span> wajib diisi.
                </p>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-8">

                @if ($errors->any())
                    <div role="alert"
                         class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                        <p class="font-semibold">
                            Tugas belum dapat disimpan.
                        </p>
                        <p class="mt-1">
                            Periksa kembali input yang ditandai di bawah.
                        </p>
                    </div>
                @endif

                <form method="POST"
                      action="{{ route('tasks.store') }}"
                      class="space-y-6">
                    @csrf

                    <div>
                        <label for="title"
                               class="block text-sm font-semibold text-gray-800">
                            Judul Tugas <span class="text-red-600">*</span>
                        </label>

                        <input id="title"
                               name="title"
                               type="text"
                               value="{{ old('title') }}"
                               placeholder="Contoh: Menyelesaikan laporan proyek"
                               autocomplete="off"
                               required
                               aria-invalid="{{ $errors->has('title') ? 'true' : 'false' }}"
                               class="mt-2 block min-h-11 w-full rounded-lg border-gray-300 text-sm shadow-sm transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500 @error('title') border-red-500 @enderror">

                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description"
                               class="block text-sm font-semibold text-gray-800">
                            Deskripsi
                        </label>

                        <textarea id="description"
                                  name="description"
                                  rows="4"
                                  placeholder="Tambahkan detail atau catatan tugas jika diperlukan."
                                  class="mt-2 block w-full rounded-lg border-gray-300 text-sm shadow-sm transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>

                        <p class="mt-1.5 text-xs text-gray-500">
                            Opsional. Jelaskan hal yang perlu dilakukan.
                        </p>

                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div>
                            <label for="status"
                                   class="block text-sm font-semibold text-gray-800">
                                Status <span class="text-red-600">*</span>
                            </label>

                            <select id="status"
                                    name="status"
                                    required
                                    class="mt-2 block min-h-11 w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('status') border-red-500 @enderror">
                                @foreach (['Belum Dikerjakan', 'Dikerjakan', 'Selesai'] as $status)
                                    <option value="{{ $status }}"
                                        @selected(old('status', 'Belum Dikerjakan') === $status)>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>

                            @error('status')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        
                        <div>
                            <label for="priority"
                                class="block text-sm font-semibold text-gray-800">
                                Prioritas <span class="text-red-600">*</span>
                            </label>

                            <select id="priority"
                                    name="priority"
                                    required
                                    class="mt-2 block min-h-11 w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('priority') border-red-500 @enderror">

                                @foreach (['Rendah', 'Sedang', 'Tinggi'] as $priority)
                                    <option value="{{ $priority }}"
                                        @selected(old('priority', 'Sedang') === $priority)>
                                        {{ $priority }}
                                    </option>
                                @endforeach

                            </select>

                            @error('priority')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    <div>
                        <label for="due_date"
                               class="block text-sm font-semibold text-gray-800">
                            Tanggal Tenggat
                        </label>

                        <input id="due_date"
                               name="due_date"
                               type="date"
                               value="{{ old('due_date') }}"
                               class="mt-2 block min-h-11 w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('due_date') border-red-500 @enderror">

                        <p class="mt-1.5 text-xs text-gray-500">
                            Boleh dikosongkan jika tugas tidak memiliki tenggat.
                        </p>

                        @error('due_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:justify-end">
                        <a href="{{ route('tasks.index') }}"
                           class="inline-flex min-h-11 items-center justify-center rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                            Batal
                        </a>

                        <button type="submit"
                                class="inline-flex min-h-11 items-center justify-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Simpan Tugas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
