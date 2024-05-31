<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Master\JobGrade;

class TableJobGrade extends Seeder
{
    public function run()
    {
        $jobgrade = [
        ];
        foreach($jobgrade as $row)
        {
            JobGrade::create($row);
        }
    }
}
