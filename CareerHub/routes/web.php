<?php

use App\Http\Controllers\AuthorizedUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserExperienceController;
use App\Http\Controllers\UserEducationController;
use App\Http\Controllers\UserCertificateController;
use App\Http\Controllers\UserProjectsController;
use App\Http\Controllers\UserSkillsController;
use App\Http\Controllers\ShowDashboard;
use Illuminate\Support\Facades\Route;

//Guest routes (not authenticated or not signed in)
Route::middleware('guest')->group(function () {
  Route::view('/login', 'auth.login');
  Route::view('/register', 'auth.register');
  Route::post('/register', [UserController::class, 'register'])->name('register');
  Route::post('/login', [AuthorizedUserController::class, 'login'])->name('login');
});

//Authenticated user routes (logged in ignoring roles)
Route::middleware('auth')->group(function () {
  Route::get('/', ShowDashboard::class)->name('dashboard');
  Route::get('/jobDetail/{id}', [AuthorizedUserController::class, 'jobDetail'])->name('jobDetail');
  Route::get('/logout', [AuthorizedUserController::class, 'logout'])->name('logout');
  Route::get('/profile', [AuthorizedUserController::class, 'profile'])->name('profile');
  Route::post('/updateProfile', [AuthorizedUserController::class, 'updateProfile'])->name('updateProfile');
  Route::post('/changePassword', [AuthorizedUserController::class, 'changePassword'])->name('changePassword');

  Route::get('/search', [SearchController::class, 'search'])->name('search');
  Route::get('/moreCompanies', [CompanyController::class, 'moreCompanies'])->name('moreCompanies');
  Route::get('/moreJobs', [JobController::class, 'moreJobs'])->name('moreJobs');
  Route::get('/company/{company}', [CompanyController::class, 'show'])->name('companyDetail');
});

//Authenticated user with employee role routes
Route::middleware(['auth', 'role:Employee'])->group(function () {
  Route::post('/createExperience', [UserExperienceController::class, 'create'])->name('createExperience');
  Route::post('/updateExperience/{id}', [UserExperienceController::class, 'update'])->name('updateExperience');
  Route::post('/createProject', [UserProjectsController::class, 'create'])->name('createProject');
  Route::post('/updateProject/{id}', [UserProjectsController::class, 'update'])->name('updateProject');
  Route::post('/createSkill', [UserSkillsController::class, 'create'])->name('createSkill');
  Route::post('/updateSkill/{id}', [UserSkillsController::class, 'update'])->name('updateSkill');
  Route::post('/createEducation', [UserEducationController::class, 'create'])->name('createEducation');
  Route::post('/updateEducation/{id}', [UserEducationController::class, 'update'])->name('updateEducation');
  Route::post('/createCertificate', [UserCertificateController::class, 'create'])->name('createCertificate');
  Route::post('/updateCertificate/{id}', [UserCertificateController::class, 'update'])->name('updateCertificate');
  Route::post('/applyJob/{id}', [JobApplicationController::class, 'create'])->name('applyJob');
});

//Authenticated user with company role routes
Route::middleware(['auth', 'role:Company'])->group(function () {
  Route::post('/updateCompanyProfile', [CompanyController::class, 'update'])->name('updateCompanyProfile');
  Route::post('/addJob', [JobController::class, 'create'])->name('addJob');
  Route::post('/deleteJob', [JobController::class, 'delete'])->name('deleteJob');
  Route::post('/updateJob/{id}', [JobController::class, 'update'])->name('updateJob');
  Route::post('/updateJobApplicationStatus/{job_id}/{user_id}', [JobApplicationController::class, 'update'])->name('updateJobApplicationStatus');
});
