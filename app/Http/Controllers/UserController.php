<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    //
    public function login(Request $request){
        if(User::where('email',$request->input('email'))->count()){
            $user=User::where('email',$request->input('email'))->first();
            //return bcrypt('12345678');
            if($user->password==$request->input('passowrd'))
            return  $user;
        }
        return 0;
    }
    public function register(Request $request){
        
        $user= new User;
        $user->firstName=$request->input('firstName');
        $user->lastName=$request->input('lastName');
        $user->email=$request->input('email');
        $user->password=$request->input('password');
        $user->type='normal';
        //return $request->input('password');
        try{
            $user->save();
            return $user;
        }
        catch(\Exception $e){
            // do task when error
            return $e->getMessage();   // insert query
            
         }
    }
}
