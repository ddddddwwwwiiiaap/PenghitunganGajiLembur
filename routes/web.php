<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/help', function () {
    return view('help');
})->name('help');


Route::namespace('Auth')->group(function () {
    Route::get('/login', 'LoginController@showLoginForm')->middleware('guest')->name('login');
    Route::post('/login', 'LoginController@login')->middleware('guest');
    Route::post('/logout', 'LoginController@logout')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home/getStaffPremium', 'HomeController@getStaffPremium');
    Route::get('/home/getStaffJobGrade', 'HomeController@getStaffJobGrade');

    //personal karyawan
    Route::get('/users/account/{id}/edit', 'UsersController@editAccount')->name('users.account.edit');
    Route::patch('/users/{id}/updateAccount', 'UsersController@updateAccount')->name('users.account.update');
    // profile
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/profile/{id}/edit', 'ProfileController@editProfile')->name('profile.edit');
    Route::patch('/profile/{id}/update', 'ProfileController@updateProfile')->name('profile.update');
    Route::patch('/profile/upload', 'ProfileController@uploadPhoto')->name('profile.upload');

    Route::middleware('role:admin|superadmin')->group(function () {
        Route::get('/users', 'UsersController@index')->name('users.index');
        Route::patch('/users/{id}/update', 'UsersController@update')->name('users.update');
        Route::get('/users/{id}', 'UsersController@destroy')->name('users.destroy');

        Route::get('/roles', 'RolesController@index')->name('roles.index');
        Route::get('/roles/create', 'RolesController@create')->name('roles.create');
        Route::post('/roles', 'RolesController@store')->name('roles.store');
        Route::get('/roles/{roles}/edit', 'RolesController@edit')->name('roles.edit');
        Route::patch('/roles/{roles}/update', 'RolesController@update')->name('roles.update');
        Route::get('/roles/{id}', 'RolesController@destroy')->name('roles.destroy');
    });

    Route::middleware('role:admin|accounting|supervisor')->group(function () {
        Route::namespace('Master')->prefix('master')->name('master.')->group(function () {
            Route::get('premium', 'PremiumController@index')->name('premium.index');
            Route::middleware('role:admin|accounting')->group(function () {
                Route::get('premium/create', 'PremiumController@create')->name('premium.create');
                Route::post('premium', 'PremiumController@store')->name('premium.store');
                Route::get('premium/{premium}/edit', 'PremiumController@edit')->name('premium.edit');
                Route::patch('premium/{premium}/update', 'PremiumController@update')->name('premium.update');
                Route::get('premium/{id}', 'PremiumController@destroy')->name('premium.destroy');
            });

            Route::get('jobgrade', 'JobGradeController@index')->name('jobgrade.index');
            Route::get('staff', 'StaffController@index')->name('staff.index');
            Route::middleware('role:admin|accounting')->group(function () {
                Route::get('jobgrade/create', 'JobGradeController@create')->name('jobgrade.create');
                Route::post('jobgrade', 'JobGradeController@store')->name('jobgrade.store');
                Route::get('jobgrade/{jobgrade}/edit', 'JobGradeController@edit')->name('jobgrade.edit');
                Route::patch('jobgrade/{jobgrade}/update', 'JobGradeController@update')->name('jobgrade.update');
                Route::get('jobgrade/{id}', 'JobGradeController@destroy')->name('jobgrade.destroy');

                Route::get('staff/create', 'StaffController@create')->name('staff.create');
                Route::post('staff', 'StaffController@store')->name('staff.store');
                Route::get('staff/{staff}/edit', 'StaffController@edit')->name('staff.edit');
                Route::patch('staff/{staff}/update', 'StaffController@update')->name('staff.update');
                Route::get('staff/{id}', 'StaffController@destroy')->name('staff.destroy');
            });
        });

        Route::get('salary', 'SalaryController@index')->name('salary.index');
        Route::get('salary/detail/id={id}', 'SalaryController@show')->name('salary.show');
        Route::get('overtime', 'OvertimeController@index')->name('overtime.index');

        Route::middleware('role:admin|accounting')->group(function () {
            Route::get('salary/create', 'SalaryController@create')->name('salary.create');
            Route::post('salary/detail/create', 'SalaryController@store')->name('salary.store');
            Route::post('salary/detail.edit', 'SalaryController@storeedit')->name('salary.storeedit');
            Route::post('salary/detail/create/store', 'SalaryController@storeDetail')->name('salary.detail.store');
            Route::get('salary/detail/{salary}/edit', 'SalaryController@edit')->name('salary.edit');
            //salary editDetail
            Route::get('salary/detail/{salary}/editDetail', 'SalaryController@editDetail')->name('salary.editDetail');

            Route::patch('salary/{salary}/update', 'SalaryController@update')->name('salary.update');
            //updateStatus
            Route::get('salary/{salary}/updateStatus', 'SalaryController@updateStatus')->name('salary.updateStatus');
            //updateStatusGaji
            Route::get('salary/{salary}/statusgaji', 'SalaryController@statusgaji')->name('salary.statusgaji');
            Route::get('staff/get_salary', 'SalaryController@getSalary');
            Route::get('salary/{id}', 'SalaryController@destroyDetail')->name('salary.destroyDetail');
            Route::get('salary/export/excel/id={id}/filter={filter}', 'SalaryController@excel')->name('salary.export.excel');
        });

        Route::namespace('MasterLembur')->prefix('masterlembur')->name('masterlembur.')->group(function () {
            Route::get('lembur_pegawai', 'lembur_pegawaiController@show')->name('lembur_pegawai.show');
            Route::middleware('role:admin|accounting')->group(function () {
                Route::get('lembur_pegawai/create', 'lembur_pegawaiController@create')->name('lembur_pegawai.create');
                Route::post('lembur_pegawai/', 'lembur_pegawaiController@store')->name('lembur_pegawai.store');
                Route::get('lembur_pegawai/{lembur_pegawai}/edit', 'lembur_pegawaiController@edit')->name('lembur_pegawai.edit');
                Route::patch('lembur_pegawai/{lembur_pegawai}/update', 'lembur_pegawaiController@update')->name('lembur_pegawai.update');
                Route::get('lembur_pegawai/{id}', 'lembur_pegawaiController@destroy')->name('lembur_pegawai.destroy');
                Route::get('lembur_pegawai/export/excel/filter={filter}', 'lembur_pegawaiController@excel')->name('lembur_pegawai.export.excel');
            });
        });
    });

    Route::namespace('Master')->prefix('master')->name('master.')->group(function () {
        Route::get('premium', 'PremiumController@index')->name('premium.index');
        Route::get('premium/create', 'PremiumController@create')->name('premium.create');
        Route::post('premium', 'PremiumController@store')->name('premium.store');
        Route::get('premium/{premium}/edit', 'PremiumController@edit')->name('premium.edit');
        Route::patch('premium/{premium}/update', 'PremiumController@update')->name('premium.update');
        Route::get('premium/{id}', 'PremiumController@destroy')->name('premium.destroy');

        Route::get('jobgrade', 'JobGradeController@index')->name('jobgrade.index');
        Route::get('staff', 'StaffController@index')->name('staff.index');
        Route::get('jobgrade/create', 'JobGradeController@create')->name('jobgrade.create');
        Route::post('jobgrade', 'JobGradeController@store')->name('jobgrade.store');
        Route::get('jobgrade/{jobgrade}/edit', 'JobGradeController@edit')->name('jobgrade.edit');
        Route::patch('jobgrade/{jobgrade}/update', 'JobGradeController@update')->name('jobgrade.update');
        Route::get('jobgrade/{id}', 'JobGradeController@destroy')->name('jobgrade.destroy');

        Route::get('staff/create', 'StaffController@create')->name('staff.create');
        Route::post('staff', 'StaffController@store')->name('staff.store');
        Route::get('staff/{staff}/edit', 'StaffController@edit')->name('staff.edit');
        Route::patch('staff/{staff}/update', 'StaffController@update')->name('staff.update');
        Route::get('staff/{id}', 'StaffController@destroy')->name('staff.destroy');
    });


    Route::get('salary', 'SalaryController@index')->name('salary.index');
    Route::get('salary/detail/id={id}', 'SalaryController@show')->name('salary.show');
    Route::get('overtime', 'OvertimeController@index')->name('overtime.index');

    Route::get('salary/create', 'SalaryController@create')->name('salary.create');
    Route::post('salary/detail/create', 'SalaryController@store')->name('salary.store');
    Route::post('salary/detail/create/store', 'SalaryController@storeDetail')->name('salary.detail.store');
    Route::get('salary/detail/{salary}/edit', 'SalaryController@edit')->name('salary.detail.edit');

    Route::patch('salary/{salary}/update', 'SalaryController@update')->name('salary.update');
    Route::get('staff/get_salary', 'SalaryController@getSalary');
    Route::get('salary/{id}', 'SalaryController@destroyDetail')->name('salary.destroyDetail');
    Route::get('salary/export/excel/id={id}/filter={filter}', 'SalaryController@excel')->name('salary.export.excel');

    Route::namespace('MasterLembur')->prefix('masterlembur')->name('masterlembur.')->group(function () {
        Route::get('lembur_pegawai', 'lembur_pegawaiController@show')->name('lembur_pegawai.show');
        Route::get('lembur_pegawai', 'lembur_pegawaiController@index')->name('lembur_pegawai.index');
        Route::get('lembur_pegawai/create', 'lembur_pegawaiController@create')->name('lembur_pegawai.create');
        Route::post('lembur_pegawai/', 'lembur_pegawaiController@store')->name('lembur_pegawai.store');
        Route::get('lembur_pegawai/{lembur_pegawai}/edit', 'lembur_pegawaiController@edit')->name('lembur_pegawai.edit');
        Route::patch('lembur_pegawai/{lembur_pegawai}/update', 'lembur_pegawaiController@update')->name('lembur_pegawai.update');
        Route::get('lembur_pegawai/{id}', 'lembur_pegawaiController@destroy')->name('lembur_pegawai.destroy');
        Route::get('lembur_pegawai/export/excel/filter={filter}', 'lembur_pegawaiController@excel')->name('lembur_pegawai.export.excel');
    });


    Route::get('salary', 'SalaryController@index')->name('salary.index');
    Route::get('salary/detail/id={id}', 'SalaryController@show')->name('salary.show');
    Route::get('overtime', 'OvertimeController@index')->name('overtime.index');

    Route::get('salary/create', 'SalaryController@create')->name('salary.create');
    Route::post('salary/detail/create', 'SalaryController@store')->name('salary.store');
    Route::post('salary/detail/create/store', 'SalaryController@storeDetail')->name('salary.detail.store');
    Route::get('salary/detail/{salary}/edit', 'SalaryController@edit')->name('salary.detail.edit');

    Route::patch('salary/{salary}/update', 'SalaryController@update')->name('salary.update');
    Route::get('staff/get_salary', 'SalaryController@getSalary');
    Route::get('salary/{id}', 'SalaryController@destroyDetail')->name('salary.destroyDetail');
    Route::get('salary/export/excel/id={id}/filter={filter}', 'SalaryController@excel')->name('salary.export.excel');
});
