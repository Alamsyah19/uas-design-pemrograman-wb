<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->confirm('truncate first ?', true);
        if (fn () => User::query()->truncate()) {
            $this->command->info('truncate success');
        }
        User::create([
            'name' => 'alam',
            'email' => 'alam@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
