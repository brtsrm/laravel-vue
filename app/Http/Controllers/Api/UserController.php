<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserResource::collection(User::orderByDesc('id')->paginate(5));
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = FacadesValidator::make($request->all(), [
            "name" => "required|string|max:50",
            "email" => "required|string|email|unique:users",
            "password" => "required|string",
        ]);
        if ($validation->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Bir Hata oluştu",
                "errors" => $validation->errors(),
            ], 422);
        }

        $data = $request->only("name", "email", "password");
        $data["password"] = bcrypt($data["password"]);
        User::create($data);

        return response()->json([
            "success" => true,
            "message" => "Başarılı şekilde veri kayıt edilmiştir.",
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return User::find($id);
        $users = new UserResource(User::find($id));
        // return response()->json(["users" => $users],200);
        return response()->json($users, 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $validation = FacadesValidator::make($request->all(),
            [
                'name' => 'required|max:50',
                "email" => "required|email|unique:users,email," . $user->id,
                "password" => "required|min:6",
            ]);

        if ($validation->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Güncelleme sırasında bir hata oluştu",
                "erros" => $validation->errors(),
            ], 422);
        }

        $data = $request->only("name", "email", "password");
        $data["password"] = bcrypt($data["password"]);

        $user->update($data);

        return response()->json([
            "success" => true,
            "message" => "Güncellendi",
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        $user->delete();
        return response()->json([
            "success" => true,
            "message" => "Silindi",
        ]);

    }
}
