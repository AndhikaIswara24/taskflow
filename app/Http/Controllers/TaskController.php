<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * menampilkan daftar semua tugas yang dimiliki 
     * oleh pengguna yang sedang masuk.
     */
    public function index(Request $request)
    {
        $query = $request->user()->tasks();
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        if ($request->filled('priority')) {
            $query->where('priority', $request->input('priority'));
        }
         if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // pengurutan tugas
        $sort = $request->input('sort', 'terbaru');

        switch ($sort) {
            case 'tenggat':
                // tengat dekat didahulukan; tengat kosong diakhir
                $query->orderByRaw('due_date IS NULL')
                      ->orderBy('due_date', 'asc');
                break;
            case 'prioritas':
                // prioritas tinggi didahulukan
                $query->orderByRaw("
                    CASE priority
                        WHEN 'Tinggi' THEN 1
                        WHEN 'Sedang' THEN 2
                        WHEN 'Rendah' THEN 3
                        ELSE 4
                    END
                ");
                break;
            case 'judul':
                $query->orderBy('title', 'asc');
                break;
            case 'terbaru':
                $query->orderBy('created_at', 'desc');
                break;
        }
        $tasks = $query->paginate(10)->withQueryString();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * menampilkan formulir untuk membuat tugas baru.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * menyimpan tugas baru ke dalam database setelah
     * memvalidasi data yang diterima dari formulir.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:Belum Dikerjakan,Dikerjakan,Selesai'],
            'priority' => ['required', 'in:Rendah,Sedang,Tinggi'],
            'due_date' => ['nullable', 'date'],
        ]);

        $request->user()->tasks()->create($validated);

        return redirect()
        ->route('tasks.index')
        ->with('success', 'Tugas Berhasil Ditambahkan.');
    }

    /**
     * menampilkan detail dari tugas tertentu berdasarkan ID yang diberikan.
     */
    public function show(Request $request, int $task)
    {
        $task = $request->user()->tasks()->findOrFail($task);
        return view('tasks.show', compact('task'));
    }

    /**
     * menampilkan formulir untuk mengedit 
     * tugas tertentu berdasarkan ID yang diberikan.
     */
    public function edit(Request $request, string $task)
    {
        $task = $request->user()->tasks()->findOrFail($task);
        return view('tasks.edit', compact('task'));
    }

    /**
     * memperbarui tugas tertentu berdasarkan ID yang diberikan.
     */
    public function update(Request $request, string $task)
    {
        $task = $request->user()->tasks()->findOrFail($task);
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:Belum Dikerjakan,Dikerjakan,Selesai'],
            'priority' => ['required', 'in:Rendah,Sedang,Tinggi'],
            'due_date' => ['nullable', 'date'],
        ]);

        $task->update($validatedData);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tugas Berhasil Diperbarui.');
    }

    /**
     * menghapus tugas tertentu berdasarkan ID yang diberikan.
     */
    public function destroy(Request $request, int $task)
    {
        $task = $request->user()->tasks()->findOrFail($task);
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tugas Berhasil Dihapus.');
    }
}
