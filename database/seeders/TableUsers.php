<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Users;
use App\Models\Master\Staff;

class TableUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $petugas = DB::table('roles')->where('name', 'petugas')->get()->first()->id;
        $admin = DB::table('roles')->where('name', 'admin')->get()->first()->id;

        $useradmin = Users::create([
            'role_id'   => $admin,
            'name'      => 'Administrator',
            'email'     => 'admin@gmail.com',
            'username'  => 'admin',
            'password'  => bcrypt('admin'),
        ]);

        $userpetugas = Users::create([
            'role_id'   => $petugas,
            'name'      => 'Petugas',
            'email'     => 'petugas@gmail.com',
            'username'  => 'petugas',
            'password'  => bcrypt('petugas'),
        ]);

    }
}
