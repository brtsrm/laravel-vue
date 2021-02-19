<?php

use App\Models\User;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/users", function () {
    return Factory::create();
    
    // return
    // [
    //     ["id" => 1,"name" => "Berat","email" => "doqtor9101@gmail.com"],
    //     ["id" => 1,"name" => "BrtSrm","email" => "doqtor9101@gmail.com"],
    // ];
});
