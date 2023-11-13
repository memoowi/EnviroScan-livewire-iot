<?php

use App\Livewire\SensorComponent;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/enviro',SensorComponent::class);
Route::get('/get-data', [SensorComponent::class, 'getData']);
Route::get('/update/{temperatureValue}/{humidityValue}',[SensorComponent::class,'update']);
Route::get('/create/{temperatureValue}/{humidityValue} ',[SensorComponent::class,'create']);

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/EnviroScan/public/livewire/update', $handle);
});
Livewire::setScriptRoute(function ($handle) {
    return Route::get('/EnviroScan/public/livewire/livewire.js', $handle);
});
