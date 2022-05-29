<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'role' => '1',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('admin'),
                'status_id' => '1',
            ],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@mail.com',
                'role' => '2',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('admin'),
                'status_id' => '1',
            ],
        ];

        foreach ($user as $users => $value) {
            User::create($value);
        }
    }
}
