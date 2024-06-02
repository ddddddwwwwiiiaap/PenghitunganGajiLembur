<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Keterangan extends Model
{

    public $status = [
        'Staff',
        'Daily Worker',
    ];

}
