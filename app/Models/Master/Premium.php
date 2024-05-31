<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Premium extends Model
{
    protected $table = 'tb_premium';
    protected $fillable = ['name', 'salary_premium', 'status'];

    public function getNameAttribute($name)
    {
        return strtoupper($name);
    }

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }
}
