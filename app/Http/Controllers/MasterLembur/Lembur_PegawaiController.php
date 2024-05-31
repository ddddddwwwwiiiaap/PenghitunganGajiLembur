<?php

namespace App\Http\Controllers\MasterLembur;

use App\Http\Controllers\Controller;
use App\Models\MasterLembur\Lembur_Pegawai;
use App\Models\Master\Staff;
use App\Models\Master\Premium;
use App\Models\Master\JobGrade;
use Illuminate\Http\Request;
use DB;

class Lembur_PegawaiController extends Controller
{

    public function index(Request $request)
    {
        $data['lembur_pegawai'] = Lembur_Pegawai::all();
        $data['staff'] = Staff::all();
        $data['count'] = Lembur_Pegawai::count();

        $f = $request->filter ?? null;
        //butkan filter berdasarkkan periode
        if ($f) {
            $data['lembur_pegawai'] = Lembur_Pegawai::where('periode', $f)->get();
        }

        $data['periode'] = Lembur_Pegawai::groupBy('periode')
            ->orderBy('periode')
            ->select(DB::raw('count(*) as count, periode'))
            ->get();
        $data['filter'] = $f;

        return view('masterlembur.lembur_pegawai.index', $data);
    }

    public function create()
    {
        $data['title'] = "Buat Lembur Pegawai";
        $data['staff'] = Staff::all();
        $data['premium'] = Premium::all();
        $data['jobgrade'] = JobGrade::all();
        return view('masterlembur.lembur_pegawai.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required',
            'mulai_lembur' => 'required',
            'selesai_lembur' => 'required',
            'jumlah_jam' => 'required',
            'tanggal_lembur' => 'required|date',
            'periode' => 'required',
        ]);

        //hitung 'jumlah upah lembur' yaitu 'jumlah' database dari tabel staff dikali 'jumlah jam' yang diinputkan user di kali '0.0058' dikali '2'
        $staff = Staff::where('id', $request->staff_id)->first();
        $jumlah_upah_lembur = $staff->jumlah * $request->jumlah_jam * (1/173) * 2;
        $request->request->add(['jumlah_upah_lembur' => $jumlah_upah_lembur]);

        //hitung jumlah upah lembur pegawai dengan pembulatan rupiah terdekat sesuai aturan bank
        $pembulatan = round($jumlah_upah_lembur, 0);
        $request->request->add(['pembulatan' => $pembulatan]);


        $data['request'] = $request->session()->get('salary');
        $data['premium'] = Premium::where('status', $request->status)->get();
        $data['staff'] = Staff::all();

        $lembur_pegawai = new Lembur_Pegawai;
        $lembur_pegawai->staff_id = $request->staff_id;
        $lembur_pegawai->periode = $request->periode;
        $lembur_pegawai->mulai_lembur = $request->mulai_lembur;
        $lembur_pegawai->selesai_lembur = $request->selesai_lembur;
        $lembur_pegawai->jumlah_jam = $request->jumlah_jam;
        $lembur_pegawai->tanggal_lembur = $request->tanggal_lembur;
        $lembur_pegawai->jumlah_upah_lembur = $request->jumlah_upah_lembur;
        $lembur_pegawai->pembulatan = $request->pembulatan;
        $lembur_pegawai->save();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data lembur_pegawai created successfully'
        ];
        return redirect()->route('masterlembur.lembur_pegawai.index', $data)->with($message);
    }

    public function edit(Lembur_Pegawai $lembur_pegawai)
    {
        $data['title'] = "Edit Lembur Pegawai";
        $data['lembur_pegawai'] = $lembur_pegawai;
        $data['staff'] = Staff::all();
        $data['premium'] = Premium::all();
        $data['jobgrade'] = JobGrade::all();
        return view('masterlembur.lembur_pegawai.edit', $data);
    }

    public function update(Request $request, Lembur_Pegawai $lembur_pegawai)
    {
        $request->validate([
            'staff_id' => 'required',
            'mulai_lembur' => 'required',
            'selesai_lembur' => 'required',
            'jumlah_jam' => 'required',
            'tanggal_lembur' => 'required|date',
            'periode' => 'required',
        ]);
        //update otomatis tabel jumlah_upah_lembur di dapet dengan 'jumlah' database dari tabel staff dikali 'jumlah jam' yang diinputkan user di kali '0.0058' dikali '2'
        $staff = Staff::where('id', $request->staff_id)->first();
        $jumlah_upah_lembur = $staff->jumlah * $request->jumlah_jam * (1/173) * 2;
        $request->request->add(['jumlah_upah_lembur' => $jumlah_upah_lembur]);

        //update otomatis tabel pembulatan di dapet dengan hitung jumlah upah lembur pegawai dengan pembulatan rupiah terdekat sesuai aturan bank
        $pembulatan = round($jumlah_upah_lembur, 0);
        $request->request->add(['pembulatan' => $pembulatan]);

        $lembur_pegawai->staff_id = $request->staff_id;
        $lembur_pegawai->periode = $request->periode;
        $lembur_pegawai->mulai_lembur = $request->mulai_lembur;
        $lembur_pegawai->selesai_lembur = $request->selesai_lembur;
        $lembur_pegawai->jumlah_jam = $request->jumlah_jam;
        $lembur_pegawai->tanggal_lembur = $request->tanggal_lembur;
        $lembur_pegawai->jumlah_upah_lembur = $request->jumlah_upah_lembur;
        $lembur_pegawai->pembulatan = $request->pembulatan;
        $lembur_pegawai->save();


        $message = [
            'alert-type' => 'success',
            'message' => 'Data lembur_pegawai updated successfully'
        ];
        return redirect()->route('masterlembur.lembur_pegawai.index')->with($message);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $lembur_pegawai = Lembur_Pegawai::find($id);
            if ($lembur_pegawai) {
                $lembur_pegawai->delete();
                $message = [
                    'alert-type' => 'success',
                    'message' => 'Data lembur_pegawai deleted successfully'
                ];
                return redirect()->route('lembur_pegawai.index')->with($message);
            } else {
                $message = [
                    'alert-type' => 'error',
                    'message' => 'Data lembur_pegawai not found'
                ];
                return redirect()->route('masterlembur.lembur_pegawai.index')->with($message);
            }
        }
    }

    public function excel($filter)
    {
        $f = $filter ?? 'all';
        if ($f == '' || $f == 'all') {
            $data['lembur_pegawai'] = Lembur_Pegawai::all();
        } else {
            $data['lembur_pegawai'] = Lembur_Pegawai::where('periode', $f)->get();
        }
        $data['periode'] = Lembur_Pegawai::groupBy('periode')
            ->orderBy('periode')
            ->select(DB::raw('count(*) as count, periode'))
            ->get();
        $data['filter'] = $f;
        return view('masterlembur.lembur_pegawai.excel', $data);
    }
}
