<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\OutcomeController;

// Home route (dashboard)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);

// Resource routes
Route::resource('programs', ProgramController::class);
Route::resource('facilities', FacilityController::class);
Route::resource('services', ServiceController::class);
Route::resource('equipment', EquipmentController::class);
Route::resource('projects', ProjectController::class);
Route::resource('participants', ParticipantController::class);
Route::resource('outcomes', OutcomeController::class);
