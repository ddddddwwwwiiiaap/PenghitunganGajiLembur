<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests; // authorizesrequests digunakan untuk membatasi hak akses, dispatchesjobs digunakan untuk mengatur job yang akan dijalankan, validatesrequests digunakan untuk memvalidasi request yang masuk
}
