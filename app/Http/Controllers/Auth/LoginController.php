<?php

// digunakan untuk mengarahkan namespace sesuai dengan folder yang ada di dalam folder Controller
// namespace adalah sebuah cara untuk mengelompokkan class atau interface yang memiliki fungsi yang sama
namespace App\Http\Controllers\Auth; 

// use adalah perintah untuk mengimport namespace atau class lain
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class LoginController extends Controller
{
    use AuthenticatesUsers; // kenapa harus use AuthenticatesUsers? karena kita akan menggunakan trait AuthenticatesUsers yang sudah disediakan oleh Laravel

    protected $redirectTo = RouteServiceProvider::HOME;
    
    public function __construct() // method ini digunakan untuk membatasi hak akses, jika user sudah login maka tidak bisa mengakses halaman login lagi
    {
        $this->middleware('guest')->except('logout'); // digunakan untuk user yang sudah login agar tidak bisa mengakses halaman login
    }

    public function showLoginForm() // method ini digunakan untuk menampilkan form login
    {
        return view('auth.login');
    }

    public function login(Request $request) // request adalah parameter yang digunakan untuk mengambil data yang dikirim oleh form
    {
        $msg = [
            'username.*' => 'Username tidak boleh kosong !',
            'password.*' => 'Password tidak boleh kosong !'
        ];
        $request->validate([
            'username' => 'required|string',
            'password' => 'required'
        ], $msg);

        $credentials = request(['username', 'password']);
        if (!Auth::attempt($credentials)) {
            $message = [
                'username' => $request->username,
                'message' => 'Login gagal, masukan username dan password yang valid.',
            ];
            return redirect()->back()->with($message);
        }


        $message = [
            'success' => true,
            'alert-type' => 'success',
            'message' => 'Selamat datang ' . ucwords(Auth::user()->name) . ' di Sistem Informasi Pendataan dan Gaji Karyawan'
        ];
        return redirect()->route('home')->with($message); 
    }

    public function username() // method ini digunakan untuk mengubah field login dari email menjadi username, karena default login di Laravel adalah email
    {
        return 'username';
    }
}
