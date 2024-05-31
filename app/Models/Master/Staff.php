<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Users;

class Staff extends Model
{

    protected $table = 'tb_staff';
    protected $fillable = ['pn', 'premium_id', 'jobgrade_id', 'users_id', 'name', 'birth', 'address', 'startdate', 'phone', 'salary_staff', 'jumlah'];
    protected $dates = ['deleted_at'];

    public function getNameAttribute($name)
    {
        return strtoupper($name);
    }

    public function getAddresAttribute($name)
    {
        return ucfirst($name);
    }

    public function premium()
    {
        return $this->belongsTo(Premium::class);
    }

    public function jobgrade()
    {
        return $this->belongsTo(JobGrade::class);
    }

    public function users() {
        return $this->belongsTo(Users::class);
    }

    public function schedules() {
        return $this->hasMany(\App\Models\Schedule::class);
    }

    public function lembur_pegawai() {
        return $this->hasMany(\App\lembur_pegawai::class);
    }

    public function salary() {
        return $this->hasMany(\App\Models\Salary::class);
    }    
}
