<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Tricycle;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = User::where("username", $request->username)->first();
        if(!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }
        return response()->json(['user' => $user, 'token' => $user->createToken($user->username)->plainTextToken]);
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'cpnum' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $user = User::create([
                'username' => $validatedData['username'],
                'cpnum' => $validatedData['cpnum'],
                'password' => Hash::make($validatedData['password']),
            ]);
        if($user){
            $profile=Profile::create([
                'user_id' => $user->id,
                'name' => $validatedData['name'],
                'address' => $validatedData['address'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
        
    }
    public function me()
    {
        if(auth('sanctum')->user()->acctype=='driver'){
            return response()->json([
                'user' => auth('sanctum')->user(),
                'profile' => Tricycle::where('user_id',auth('sanctum')->user()->id)->first(),
                'status' => 'success',
            ]);
        }
        return response()->json([
            'user' => auth('sanctum')->user(),
            'profile' => Profile::where('user_id',auth('sanctum')->user()->id)->first(),
            'status' => 'success',
        ]);
    }
    public function update(Request $request)
    {
        $user=User::find(auth('sanctum')->user()->id);
        $profile=Profile::where('user_id',auth('sanctum')->user()->id)->first()??new Profile(['user_id'=>auth('sanctum')->user()->id]);
        $user->username=$request->input('username');
        $user->cpnum=$request->input('cpnum');
        if($request->input('password')!='')
            $user->password=$request->input('password');
        $user->save();
        $profile->name=$request->input('name');
        $profile->address=$request->input('address');
        $profile->save();
        
        return \response(['status'=>'success']);

    }
}
