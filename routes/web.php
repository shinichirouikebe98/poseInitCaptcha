<?php

use App\Http\Controllers\ConfigController;
use App\Http\Controllers\MetadatasController;
use App\Http\Controllers\PoseiconsController;
use App\Http\Controllers\PredatasController;
use App\Http\Controllers\ExperimentController;
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

Route::get('/', function () {
    return view('home');
});
// Route::get('/config', function () {
//     return view('config');
// });

Route::get('/config', [ConfigController::class, 'index']);
Route::get('/experiment', [ExperimentController::class, 'index']);


//icons
Route::post('/poseicon', [PoseiconsController::class, 'store']);
Route::get('/poseicon/req', [PoseiconsController::class, 'getIcons']);
Route::get('/poseicon/{poseicon}', [PoseiconsController::class, 'show']);
Route::delete('/poseicon/{poseicon}', [PoseiconsController::class, 'destroy']);
Route::get('/poseicon/search/{poseicon}', [PoseiconsController::class, 'search']);
Route::patch('/poseicon/update/{poseicon}', [PoseiconsController::class, 'update']);


//predata
Route::post('/predata', [PredatasController::class, 'store']);
Route::get('/predata/req', [PredatasController::class, 'getPredata']);
Route::get('/predata/{predata}', [PredatasController::class, 'show']);
Route::delete('/predata/{predata}', [PredatasController::class, 'destroy']);
Route::patch('/predata/update/{predata}', [PredatasController::class, 'update']);
Route::get('/predata/search/{predata}', [PredatasController::class, 'search']);


//predata train
Route::get('/predata/train/{predata}', [PredatasController::class, 'train']);

//metadata_get
Route::get('/experiment/metadata', [ExperimentController::class, 'getMetadata']);
Route::get('/experiment/predata/{predata}', [ExperimentController::class, 'getPredata']);

//metadata
Route::post('/metadata', [MetadatasController::class, 'store']);
Route::get('/metadata/req', [MetadatasController::class, 'getMeta']);
Route::get('/metadata/{metadata}', [MetadatasController::class, 'show']);
Route::get('/metadata/search/{metadata}', [MetadatasController::class, 'search']);
Route::delete('/metadata/{metadata}', [MetadatasController::class, 'destroy']);
Route::patch('/metadata/update/{metadata}', [MetadatasController::class, 'update']);
Route::get('/metadata/nums/{predata}', [MetadatasController::class, 'getNum']);
Route::patch('/metadata/active', [MetadatasController::class, 'active']);


