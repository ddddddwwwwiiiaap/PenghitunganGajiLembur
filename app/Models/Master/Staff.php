<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model; // eloquent adalah ORM (Object Relational Mapping) yang digunakan untuk mengakses database
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Users;

class Staff extends Model
{

    protected $table = 'tb_staff';
    protected $fillable = ['pn', 'premium_id', 'jobgrade_id', 'users_id', 'name', 'birth', 'address', 'startdate', 'phone', 'salary_staff', 'jumlah'];
    protected $dates = ['deleted_at']; // kenapa dates = deleted_at? karena kita menggunakan soft delete, jadi data yang dihapus tidak benar-benar terhapus, hanya di soft delete. lalu maksud dates apa? dates adalah kolom yang berisi tanggal, jadi deleted_at adalah kolom yang berisi tanggal yang menandakan data tersebut dihapus pada tanggal berapa

    public function getNameAttribute($name)
    {
        return strtoupper($name); // kenapa strtoupper? karena kita ingin menampilkan nama dengan huruf kapital
    }

    public function getAddresAttribute($name)
    {
        return ucfirst($name); // kenapa ucfirst? karena kita ingin menampilkan alamat dengan huruf kapital di awal kalimat
    }

    public function premium()
    {
        return $this->belongsTo(Premium::class);
    }

    public function jobgrade()
    {
        return $this->belongsTo(JobGrade::class);
    }

    public function salary() {
        return $this->hasMany(\App\Models\Salary::class);
    }    
}
