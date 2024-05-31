<?php

namespace App\Models\MasterLembur;

use Illuminate\Database\Eloquent\Model;

class Lembur_Pegawai extends Model
{
    protected $table = 'tb_lembur_pegawai';
    protected $fillable = ['staff_id', 'periode', 'mulai_lembur', 'selesai_lembur', 'jumlah_jam', 'total_uang_lembur', 'tanggal_lembur', 'jumlah_upah_lembur', 'pembulatan'];
    protected $dates = ['deleted_at'];

    public function staff()
    {
        return $this->belongsTo('App\Models\Master\Staff', 'staff_id');
    }
}
    