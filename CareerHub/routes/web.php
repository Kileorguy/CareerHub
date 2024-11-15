<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CompanySkillController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserExperienceController;
use App\Http\Middleware\isLoggedIn;
use App\Http\Middleware\isLoggedOut;
use Illuminate\Support\Facades\Route;

Route::middleware(isLoggedIn::class)->group(function () {
    Route::get('/', [CompanyController::class, 'getAllCompanies']);
    Route::get('/profile', [LoginUserController::class, 'profile']);
//    Route::view('profile', 'profile');
});

Route::middleware(isLoggedOut::class)->group(function () {
    Route::view('/login', 'login');
    Route::view('/register', 'register');
});



Route::post('/register', [RegisterUserController::class,'register'])->name('register');
Route::post('/login', [LoginUserController::class,'login'])->name('login');
Route::get('/logout', [LoginUserController::class,'logout'])->name('logout');

// Route::view('/search/{query}', 'search');
// Route::view('/profile', 'profile');
// Route::view('/company', 'company');

Route::get('/test', [RegisterUserController::class,'test']);

 Route::resource('/experience', UserExperienceController::class);
// Route::resource('/education', EducationController::class);
// Route::resource('/certificate', CertificateController::class);
// Route::resource('/award', AwardController::class);
// Route::resource('/userProject', UserProjectController::class);
// Route::resource('/userSkill', UserSkillController::class);
// Route::resource('/companySkill', CompanySkillController::class);
