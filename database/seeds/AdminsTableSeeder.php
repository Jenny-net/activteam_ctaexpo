<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'admin_type' => 'SA',
            'profile_photo' => '',
            'phone' => '7894561230',
            'name' => 'ADMIN',
            'status' => '1',
            'password' => bcrypt('admin@123'),
        ]);
    }
}
