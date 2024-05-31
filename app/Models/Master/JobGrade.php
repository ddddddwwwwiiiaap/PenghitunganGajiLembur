<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class JobGrade extends Model
{
    protected $table = 'tb_jobgrade';
    protected $fillable = ['name', 'salary_jobgrade'];

    public function getNameAttribute($name)
    {
        return strtoupper($name);
    }
}
