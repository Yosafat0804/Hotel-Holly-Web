<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $user = [
            [
                'name' => 'Adm. Hotel H', 
                'email' => 'adminhotels@gmail.com',
                'phone' => '081234567890',
                'password' => bcrypt('adminhotelsh#29'),
                'role' => 'admin',
                'rating' => 'Baik',
            ],
            [
                'name' => 'Noel',
                'email' => 'Noel12@gmail.com',
                'phone' => '-',
                'role' => 'customer',
                'password' => bcrypt('noel12'),
            ],
            [
                'name' => 'Resepsionis',
                'email' => 'resepsionis@gmail.com',
                'phone' => '0812345678901',
                'role' => 'resepsionis',
                'password' => bcrypt('resepsionis'),
            ],
            [
                'name' => 'Maintenance',
                'email' => 'maintenance@gmail.com',
                'phone' => '0812345678901',
                'role' => 'maintenance',
                'password' => bcrypt('maintenance'),
            ],
            [
                'name' => 'Supervisor',
                'email' => 'supervisor@gmail.com',
                'phone' => '0812345678901',
                'role' => 'supervisor',
                'password' => bcrypt('supervisor'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
