<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // テストユーザー（固定）
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // ダミーユーザー（複数）
        User::factory(5)->create();

        // 商品データ
        $this->call(ItemsTableSeeder::class);
    }
}
