<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_renders_user_tasks(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        Task::create([
            'user_id' => $user->id,
            'title' => 'Mengerjakan tugas utama',
            'description' => 'Deskripsi contoh task',
            'status' => 'Belum Dikerjakan',
            'priority' => 'Tinggi',
            'due_date' => now()->addDay(),
        ]);

        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertOk();
        $response->assertSee('Mengerjakan tugas utama');
        $response->assertSee('Daftar Tugas');
    }
}
