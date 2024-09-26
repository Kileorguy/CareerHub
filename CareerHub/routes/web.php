<?php

use App\Http\Controllers\AwardController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CompanySkillController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\UserProjectController;
use App\Http\Controllers\UserSkillController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('/login', 'login');
Route::view('/register', 'register');

Route::post('/register', [RegisterUserController::class,'register'])->name('register');
Route::post('/login', [LoginUserController::class,'login'])->name('login');

Route::view('/search/{query}', 'search');
Route::view('/home', 'home');
Route::view('/profile', 'profile');
Route::view('/company', 'company');

Route::resource('/experience', ExperienceController::class);
Route::resource('/education', EducationController::class);
Route::resource('/certificate', CertificateController::class);
Route::resource('/award', AwardController::class);
Route::resource('/userProject', UserProjectController::class);
Route::resource('/userSkill', UserSkillController::class);
Route::resource('/companySkill', CompanySkillController::class);
