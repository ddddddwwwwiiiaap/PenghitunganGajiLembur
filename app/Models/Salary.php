<?php

namespace App\Models;

use App\Models\Master\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salary extends Model
{
    use SoftDeletes;

    protected $table = 'tb_salary';
    protected $fillable = ['staff_id', 'lembur_pegawai_id', 'salary', 'periode', 'jumlah_jam_lembur_periode', 'jumlah_upah_lembur_periode', 'status_gaji', 'tgl_salary', 'status'];
    protected $dates = ['deleted_at'];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function lemburPegawai()
    {
        return $this->belongsTo(LemburPegawai::class, 'lembur_pegawai_id');
    }

    public function updateStatus($id, $status)
    {
        //update status gaji
        $salary = Salary::find($id);
        $salary->status_gaji = $status;
        $salary->save();
    }
}

