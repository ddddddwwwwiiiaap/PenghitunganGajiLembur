<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Premium;

class PremiumController extends Controller
{
    public function index()
    {
        $data['premium'] = Premium::all();
        $data['count'] = Premium::count();
        return view('master.premium.index', $data);
    }

    public function create()
    {
        $data['title'] = "Buat premium";
        return view('master.premium.create', $data);
    }

    public function store(Request $request)
    {
        $request->merge([
            'salary_premium' => preg_replace('/\D/', '', $request->salary_premium),
        ]);

        $request->validate([
            'name' => 'required|max:100',
            'salary_premium' => 'required',
            'status' => 'required',
        ]);

        Premium::create($request->all());

        $message = [
            'alert-type' => 'success',
            'message' => 'Data premium created successfully'
        ];
        return redirect()->route('master.premium.index')->with($message);
    }

    public function edit(Premium $premium)
    {
        $data['title'] = "Edit Premium";
        $data['premium'] = $premium;
        return view('master.premium.edit', $data);
    }

    public function update(Request $request, Premium $premium)
    {
        $request->merge([
            'salary_premium' => preg_replace('/\D/', '', $request->salary_premium),
        ]);

        $request->validate([
            'name' => 'required|max:100',
            'salary_premium' => 'required',
            'status' => 'required',
        ]);

        $premium->update($request->all());

        $message = [
            'alert-type' => 'success',
            'message' => 'Data premium updated successfully'
        ];
        return redirect()->route('master.premium.index')->with($message);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $premium = Premium::find($id);
            if ($premium) {
                $premium->delete();
            }
            $count = Premium::count();
            $message = [
                'alert-type' => 'success',
                'message' => 'Data premium deleted successfully'
            ];
            return redirect()->route('master.premium.index')->with($message);
        }
    }
}
