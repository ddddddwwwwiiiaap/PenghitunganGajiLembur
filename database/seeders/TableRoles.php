<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;

class TableRoles extends Seeder
{
    public function run()
    {
        $roles = [
            ['name'=>'admin', 'display_name'=>'Administrator'],
            ['name'=>'petugas', 'display_name'=>'petugas'],
        ];
        foreach($roles as $row)
        {
            Roles::create($row);
        }
    }
}
