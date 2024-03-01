<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RickAndMortyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// characters routes
Route::get('/characters', [RickAndMortyController::class,'getAllCharacters']);
Route::get('/character/{ids}', [RickAndMortyController::class, 'getMultipleCharacter']);
Route::get('/character/{character_id}', [RickAndMortyController::class,'getASingleCharacter']);
Route::get('/character/', [RickAndMortyController::class,'filterCharacters']);

// location routes
Route::get('/locations', [RickAndMortyController::class,'getAllLocations']);
Route::get('/location/{ids}', [RickAndMortyController::class, 'getMultipleLocations']);
Route::get('/location/{location_id}', [RickAndMortyController::class,'getASingleLocation']);
Route::get('/location/', [RickAndMortyController::class,'filterLocations']);

// location episodes
Route::get('/episodes', [RickAndMortyController::class,'getAllEpisodes']);
Route::get('/episode/{ids}', [RickAndMortyController::class, 'getMultipleEpisodes']);
Route::get('/episode/{episode_id}', [RickAndMortyController::class,'getASingleEpisode']);
Route::get('/episode/', [RickAndMortyController::class,'filterEpisodes']);