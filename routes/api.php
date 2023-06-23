<?php

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LeadController;
use App\Http\Controllers\API\ProjectController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{project:slug}', [ProjectController::class, 'show']);

/*
Route::get('/test', function () {

    // json
    // return response()->json([
    //     'success' => true,
    //     'name' =>'fabio',
    // ]);
    // array
    // return [
    //     'success' => true,
    //     'name' => 'fabio',
    // ];
    // collection
    //return Project::all();
}); */

Route::post('/contacts', [LeadController::class, 'store']);