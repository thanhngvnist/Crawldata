<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrawlController;

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
Route::get('crawl-assets', [CrawlController::class, 'crawlAssets']);
Route::get('subnet3-cal', [CrawlController::class, 'subnet_3_calculate']);
Route::post('importData', [\App\Http\Controllers\ScoreBoardController::class, 'importData']);
Route::post('getLastDeploymentScenario', [\App\Http\Controllers\ScoreBoardController::class, 'getLastDeploymentScenario']);
