<?php
/* Model ini mengatur kolom yang boleh diisi melalui mass 
assignment, mengonversi due_date menjadi objek tanggal, 
dan mendefinisikan relasi ke pengguna*/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
    ];

    public function casts(): array
    {
        return [
            'due_date' => 'date',
        ];
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
