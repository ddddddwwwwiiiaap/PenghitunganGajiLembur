<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Staff;
use App\Models\Master\Premium;
use App\Models\Master\JobGrade;
use App\Models\Roles;
use App\Models\Users;

class StaffController extends Controller
{

    public function index()
    {
        $data['staff'] = Staff::all();
        $data['count'] = Staff::count();
        return view('master.staff.index', $data);
    }

    public function create()
    {
        $data['title'] = "Tambah Staff";
        $data['premium'] = Premium::all();
        $data['roles'] = Roles::all();
        $data['JobGrade'] = JobGrade::all();
        return view('master.staff.create', $data);
    }

    public function store(Request $request)
    {
        $request->merge([
            'salary_staff' => preg_replace('/\D/', '', $request->salary_staff),
        ]);

        // dd($request->all());
        $request->validate([
            'name' => 'required|max:100',
            'premium_id' => 'required',
            'jobgrade_id' => 'required',
            'pn' => 'required',
            'salary_staff' => 'required',
        ]);

        //message pn tidak boleh sama
        $pn = Staff::where('pn', $request->pn)->first();
        if ($pn) {
            $message = [
                'alert-type' => 'error',
                'message' => 'PN sudah ada'
            ];
            return redirect()->route('master.staff.index')->with($message);
        }

        //tabel jumlah di dapet dengan salary_staff + salary_premium + salary_jobgrade
        $premium = Premium::where('id', $request->premium_id)->first();
        $jobgrade = JobGrade::where('id', $request->jobgrade_id)->first();
        //perhitungan secara realtime jumlah di dapat di update
        $request->request->add(['jumlah' => $request->salary_staff + $premium->salary_premium + $jobgrade->salary_jobgrade]);

        if ($request->has('makeUserAccount')) {
            $msg = [
                'username.min' => 'Username harus terdiri dari minimal 6 karakter.',
                'username.unique' => 'Username sudah digunakan.'
            ];
            $request->validate([
                'username' => 'required|string|min:6|max:255|unique:users',
                'role_id' => 'required|integer',
            ], $msg);

            $user = Users::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => bcrypt($request->username),
                'role_id' => $request->role_id
            ]);
            $request->request->add(['users_id' => $user->id]);
        }

        Staff::create($request->all());

        $message = [
            'alert-type' => 'success',
            'message' => 'Data staff created successfully'
        ];
        return redirect()->route('master.staff.index')->with($message);
    }

    public function edit(Staff $staff)
    {
        $data['title'] = "Edit Staff";
        $data['premium'] = Premium::all();
        $data['roles'] = Roles::all();
        $data['JobGrade'] = JobGrade::all();
        $data['staff'] = $staff;
        return view('master.staff.edit', $data);
    }

    public function update(Request $request, Staff $staff)
    {
        $request->merge([
            'salary_staff' => preg_replace('/\D/', '', $request->salary_staff),
        ]);

        $request->validate([
            'name' => 'required|max:100',
            'premium_id' => 'required',
            'jobgrade_id' => 'required',
            'salary_staff' => 'required',
        ]);

        //update otomatis tabel jumlah di dapet dengan salary_staff + salary_premium + salary_jobgrade
        $premium = Premium::where('id', $request->premium_id)->first();
        $jobgrade = JobGrade::where('id', $request->jobgrade_id)->first();
        $jumlah = $request->salary_staff + $premium->salary_premium + $jobgrade->salary_jobgrade;
        $request->request->add(['jumlah' => $jumlah]);


        //message pn tidak boleh sama
        /*$pn = Staff::where('pn', $request->pn)->first();
        if ($pn) {
            $message = [
                'alert-type' => 'error',
                'message' => 'pn sudah ada'
            ];
            return redirect()->route('master.staff.index')->with($message);
        }*/

        if ($request->has('makeUserAccount')) {
            $msg = [
                'username.min' => 'Username harus terdiri dari minimal 6 karakter.',
                'username.unique' => 'Username sudah digunakan.'
            ];
            $request->validate([
                'username' => 'required|string|min:6|max:255|unique:users',
                'role_id' => 'required|integer',
            ], $msg);

            $user = Users::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => bcrypt($request->username),
                'role_id' => $request->role_id
            ]);
            $request->request->add(['users_id' => $user->id]);
        }

        $staff->update($request->all());

        $message = [
            'alert-type' => 'success',
            'message' => 'Data staff updated successfully'
        ];
        return redirect()->route('master.staff.index')->with($message);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $staff = Staff::find($id);
            if ($staff) {
                $staff->delete();
            }
            $count = Staff::count();
            $message = [
                'alert-type' => 'success',
                'count' => $count,
                'message' => 'Data staff deleted successfully'
            ];
            return response()->json($message);
        }
    }

    public function show(Staff $staff)
    {
        $data['title'] = "Detail Staff";
        $data['staff'] = $staff;
        return view('master.staff.show', $data);
    }
}
