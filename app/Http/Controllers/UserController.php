<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Grade;
use App\Models\Section;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    public function show(User $user)
    {
        try{
            $user = User::find($user);

            return response()->json($user);

        } catch(Exception $e){
            return response()->json($e->getMessage());
        }
    }
    public function users()
    {
        try{

            $users = User::all();

            return response()->json(['users' => $users]);

        } catch(Exception $e){
            return response()->json($e->getMessage());
        }
    }

    public function create(UserRequest $req)
    {
        try{
            // $user->save();
            // $user->grades()->attach($grade);
            $grade = Grade::find($req->grade_id);
            
            $user = User::create([
                'name' => $req->name,
                'lastname'=> $req->lastname,
                'email' => $req->email,
                'username' => $req->username,
                'password' => bcrypt($req->password),
                'role' => $req->role,
                'avatar' => $req->avatar,
                'section_id' => $req->section_id
            ]);

            $user->grades()->attach($grade);
            
            return response()->json([
                'message' => 'Usuario creado correctamente',
                $user
            ]);
        } catch(Exception $e){
            return response()->json($e->getMessage());
        }
    }

    public function update(UserRequest $req, User $user)
    {        
        try {

            $user->name = $req->name;
            $user->lastname = $req->lastname;
            $user->email = $req->email;
            $user->username = $req->username;
            $user->password = bcrypt($req->password);
            $user->role = $req->role;
            $user->avatar = $req->avatar;

            $user->save();

            return response()->json([
                'message' => 'Usuario actualizado correctamente',
                $user,
            ]);

        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function delete(User $user)
    {
        try {
            
            $user->delete();
            return response()->json([
                'message' => 'Usuario eliminado correctamente',
                $user,
            ]);
            
        } catch (Exception $e) {
            return response()->json( $e->getMessage(), 500);
        }
    }
}
