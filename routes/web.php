<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('/');
});

Route::controller(EmployeeController::class)->group(function () {
    Route::post('/save-employee', 'saveEmployee')->name('save_employee');
    Route::get('/fetch-employees', 'fetchEmployees')->name('fetch_employees');
    Route::get('/edit-employee/{id}', 'editEmployee')->name('edit_employee');
    Route::post('/update-employee/{id}', 'updateEmployee')->name('update_employee');
    Route::delete('/delete-employee/{id}', 'deleteEmployee')->name('delete_employee');
});


// Route::get('/manage-employee', 'manageEmployee')->name('manage_employee');
