<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // dipanggil satu persatu class seeder yang sudah dibuat untuk dijalankan, karena seeder ini akan dijalankan secara otomatis ketika kita menjalankan perintah php artisan db:seed
        $this->call(TableRoles::class);
        // $this->call(TablePremium::class);
        // $this->call(TableJobGrade::class);
        $this->call(TableUsers::class);
    }
}
