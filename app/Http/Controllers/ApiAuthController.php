<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

//use Symfony\Component\VarDumper\VarDumper;
class ApiAuthController extends Controller
{
    
    function logout(){
		auth()->user()->tokens->each(function($token){
			$token->delete();
		});
		return response()->json('logout successfully',200);
	}
   
 public function login(Request $request)
    {
        
      $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;



                        return response()->json([
                            'user'=>$user,

                            'token' => $token,
                            'message'=>"success"

                        ], 200);


       
    }
    public function register(Request $request)
    {
        //return $request;
        $user = User::create([
            'mobile' => $request['mobile'],

            'first_name' => $request['first_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
                 $token = $user->createToken('myapptoken')->plainTextToken;



                        return response()->json([
                            'user'=>$user,

                            'token' => $token,
                            'message'=>"success"

                        ], 200);
    }

    public function current()
    {
        return new UserResource(auth()->user());
    }

    
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->id()
        ]);
        $user = User::find(auth()->id());
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];

        $user->save();
        return new UserResource($user);
    }

}
