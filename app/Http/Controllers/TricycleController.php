<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Tricycle;
use App\Models\User;

class TricycleController extends Controller
{
    public function index()
    {
        return \response(['drivers'=>Tricycle::all()]);
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'cpnum' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'name' => 'required|string|max:255',
            'license'=>'required|string|max:255',
            'plate_no'=>'required|string|max:255',
        ]);
        
        $user = User::create([
            'username' => $validatedData['username'],
            'cpnum' => $validatedData['cpnum'],
            'password' => Hash::make($validatedData['password']),
            'acctype' => 'driver',
        ]);
        if($user){
            $tri=new Tricycle([
                'user_id'=>$user->id,
                'name'=>$request->input('name'),
                'license'=>$request->input('license'),
                'plate_no'=>$request->input('plate_no'),
                'cpnum'=>$request->input('cpnum'),
            ]);
            $tri->save();
            return \response(['status'=>'success','message'=>'Driver Added']);
        }
    }
    
    public function activate(Tricycle $id)
    {
        $id->status='activated';
        $id->save();
        return \response(['status'=>'success','message'=>'Driver Activated']);
    }
    
    public function deactivate(Tricycle $id)
    {
        $id->status='deactivated';
        $id->save();
        return \response(['status'=>'success','message'=>'Driver Deactivated']);
    }
    
    public function setstatus(Request $request)
    {
        $driver=Tricycle::where('user_id',auth('sanctum')->user()->id)->first();
        $driver->status=$request->input('status');
        $driver->update();
        return \response(['status'=>'success','message'=>'Driver Deactivated','user'=>$driver]);
    }
}
