<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $input = [];
        $input['user_name'] = "Mplussoft Technologies";
        $input['email'] = 'mplussoftesting@gmail.com';
        $input['password'] = Hash::make('12345678');
        $input['role_id'] = 1;

        DB::table('master_admins')->insert($input);
    }
}
