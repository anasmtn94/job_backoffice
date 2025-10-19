<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\UserController;
use App\Models\JobApplication;
use App\Models\JobCategory;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','role:admin,company-owner'])->group(function () {

    Route::middleware('role:admin,company-owner')->group(function () {


         Route::get('/',[DashboardController::class,"index"])->name('dashboard');    
   
   
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/company',CompanyController::class);
    Route::put('/company/{id}/restore',[CompanyController::class,"restore"])->name("company.restore");
    Route::resource('/application',JobApplicationController::class);
    Route::put('/application/{id}/restore',[JobApplicationController::class,"restore"])->name("application.restore");
    
    Route::resource('/job-vacancy',JobVacancyController::class);
    Route::put("/job-vacancy/{id}/restore",[JobVacancyController::class,"restore"])->name("job-vacancy.restore");
    Route::resource('/category',controller: JobCategoryController::class);
    Route::put("/category/{id}/restore",[JobCategoryController::class,"restore"])->name("category.restore");
    Route::resource('/user',UserController::class);


    
    });


});

require __DIR__.'/auth.php';
