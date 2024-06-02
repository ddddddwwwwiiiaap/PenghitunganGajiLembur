<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\JobGrade;

class JobGradeController extends Controller
{
    public function index() // method index untuk menampilkan data jobgrade, kenapa index? karena index adalah method yang pertama kali dijalankan ketika membuka halaman
    {
        $data['jobgrade'] = JobGrade::all(); // digunakan untuk mengambil semua data dari tabel jobgrade
        $data['count'] = JobGrade::count(); // digunakan untuk menghitung jumlah data jobgrade
        return view('master.jobgrade.index', $data);
    }

    public function create()
    {
        return view('master.jobgrade.create', ['title' => 'Tambah Job Grade']);
    }

    public function store(Request $request)
    {
        $request->merge([ // merge digunakan untuk menggabungkan data yang sudah ada dengan data yang baru
            'salary_jobgrade' => preg_replace('/\D/', '', $request->salary_jobgrade), // preg_replace digunakan untuk menghapus karakter selain angka
        ]);

        $request->validate([
            'name' => 'required|max:100',
            'salary_jobgrade'=>'required',
        ]);

        JobGrade::create($request->all());

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Job Grade created successfully'
        ];
        return redirect()->route('master.jobgrade.index')->with($message);
    }

    public function edit(JobGrade $jobgrade)
    {
        $data['title'] = 'Edit Job Grade';
        $data['jobgrade'] = $jobgrade;
        return view('master.jobgrade.edit', $data);
    }

    public function update(Request $request, JobGrade $jobgrade)
    {
        $request->merge([
            'salary_jobgrade' => preg_replace('/\D/', '', $request->salary_jobgrade),
        ]);

        $request->validate([
            'name' => 'required|max:100',
            'salary_jobgrade'=>'required',
        ]);

        $jobgrade->update($request->all());

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Job Grade updated successfully'
        ];
        return redirect()->route('master.jobgrade.index')->with($message);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $jobgrade = JobGrade::find($id);
            if ($jobgrade) {
                $jobgrade->delete();
            }
            $count = JobGrade::count();
            $message = [
                'alert-type' => 'success',
                'count' => $count,
                'message' => 'Data Job Grade deleted successfully.'
            ];
            return response()->json($message);
        }
    }
}
