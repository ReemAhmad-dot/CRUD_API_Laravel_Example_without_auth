<?php

use App\Http\Controllers\Api\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get("list-employees",[EmployeeController::class,"listEmployees"]);
Route::get("single-employee/{id}",[EmployeeController::class,"getSingleEmployee"]);
Route::post("add-employee",[EmployeeController::class,"createEmployee"]);
Route::put("edit-employee/{id}",[EmployeeController::class,"updateEmployee"]);
Route::delete("delete-employee/{id}",[EmployeeController::class,"destroyEmployee"]);
  

