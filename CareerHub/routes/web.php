<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CompanySkillController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserExperienceController;
use App\Http\Controllers\UserEducationController;
use App\Http\Controllers\UserCertificateController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ShowDashboard;
use App\Http\Middleware\isLoggedIn;
use App\Http\Middleware\isLoggedOut;
use Illuminate\Support\Facades\Route;

//Guest routes (not authenticated or not signed in)
Route::middleware('guest')->group(function () {
  Route::view('/login', 'auth.login');
  Route::view('/register', 'auth.register');
  Route::post('/register', [RegisterUserController::class, 'register'])->name('register');
  Route::post('/login', [LoginUserController::class, 'login'])->name('login');
});

//Authenticated user routes (looged in ignoring roles)
Route::middleware('auth')->group(function () {
  Route::get('/', ShowDashboard::class)->name('dashboard');
  Route::post('/changePassword', [LoginUserController::class, 'changePassword'])->name('changePassword');
  Route::get('/logout', [LoginUserController::class, 'logout'])->name('logout');

  Route::get('/profile', [LoginUserController::class, 'profile'])->name('profile');
  Route::post('/updateProfile', [LoginUserController::class, 'updateProfile'])->name('updateProfile');
});

//Authenticated user with employee role routes
Route::middleware(['auth', 'role:Employee'])->group(function () {
  Route::post('/insertExperience', [ExperienceController::class, 'InsertExperience'])->name('insertExperience');
  Route::post('/updateExperience/{id}', [ExperienceController::class, 'updateExperience'])->name('updateExperience');
  Route::post('/insertEducation', [UserEducationController::class, 'InsertEducation'])->name('insertEducation');
  Route::post('/updateEducation/{id}', [UserEducationController::class, 'updateEducation'])->name('updateEducation');
  Route::post('/insertCertificate', [UserCertificateController::class, 'InsertCertificate'])->name('insertCertificate');
  Route::post('/updateCertificate/{id}', [UserCertificateController::class, 'updateCertificate'])->name('updateCertificate');
});

//Authenticated user with company role routes
Route::middleware(['auth', 'role:Company'])->group(function () {});
// Route::view('/search/{query}', 'search');
// Route::view('/profile', 'profile');
// Route::view('/company', 'company');

Route::get('/test', [RegisterUserController::class, 'test']);

Route::resource('/experience', UserExperienceController::class);
// Route::resource('/education', EducationController::class);
// Route::resource('/certificate', CertificateController::class);
// Route::resource('/award', AwardController::class);
// Route::resource('/userProject', UserProjectController::class);
// Route::resource('/userSkill', UserSkillController::class);
// Route::resource('/companySkill', CompanySkillController::class);
