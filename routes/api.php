<?php

use App\Http\Controllers\Api\UserController;
use App\Models\User;
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
/*
// Route::get("/users", function () {
//     // return new UserResource(User::find(1));
//     // return UserResource::collection(User::all());
//     // return UserResource::collection(User::paginate(10));
//     // if (rand(1, 10) < 3) {
//     //     abort(500, "İstek hatası");
//     // } else {

//     //     $user = User::factory()->count(10)->make();
//     //     return $user;

//     // }
//     // return response()->json(
//     // ["users" => User::resourece()->all()]
//     // ["users" => User::resourece()->all()]
//     // );
// });
 */

Route::apiResource("users", UserController::class);

// Route::get("/users",[UserController::class,"index"]);
