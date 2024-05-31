<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Master\Premium;

class TablePremium extends Seeder
{
    public function run()
    {
        $premium = [
        ];
        foreach($premium as $row)
        {
            Premium::create($row);
        }
    }
}
