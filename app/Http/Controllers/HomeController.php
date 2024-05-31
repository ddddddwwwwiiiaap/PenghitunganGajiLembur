<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Master\Staff;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $data['salary'] = Salary::count();
        $data['staff'] = Staff::count();
        return view('home', $data);
    }

    public function getStaffPremium()
    {
        $data = DB::table('tb_staff', 'a')
            ->groupBy('a.premium_id')
            ->orderBy('name_premium', 'asc')
            ->select(DB::raw('count(a.premium_id) as count, tb_premium.name as name_premium'))
            // ->where('periode', $id)
            ->join('tb_premium', 'tb_premium.id', '=', 'a.premium_id')
            ->get();
        return response()->json($data);
    }

    public function getStaffJobGrade()
    {
        $data = DB::table('tb_staff', 'a')
            ->groupBy('a.jobgrade_id')
            ->orderBy('name_jobgrade', 'asc')
            ->select(DB::raw('count(a.jobgrade_id) as count, tb_jobgrade.name as name_jobgrade'))
            // ->where('periode', $id)
            ->join('tb_jobgrade', 'tb_jobgrade.id', '=', 'a.jobgrade_id')
            ->get();
        return response()->json($data);
    }
}
