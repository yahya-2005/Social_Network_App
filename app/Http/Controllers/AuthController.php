<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
   public function showR(){
    return view('auth.register');
   }
   public function register(Request $req){
    $name = $req->input('name') ;
    $email = $req->input('email') ;
    $password = $req->input('password') ;
    if(empty($name) || empty($email) || empty($password)){
        return back()->with('error','all fields are required');
    }
    
    
    
    
    
    
    
    $existingUser = null;
    $users =User::all();
    foreach($users as $user){
        if($user->email == $email){
            $existingUser  = $user;
            break;
        }
    }
      
    
    
    
    if ($existingUser) {
            return back()->with('error', 'this email address is already in use');
        }
        $user = new user();
            $user->name = $name;
        $user->email = $email;
        $user->password = password_hash($password,PASSWORD_DEFAULT);
            $user->save();
        return redirect('/login')->with('success', 'account successfully created'); 
   }


    public function showL(){
        return view('auth.login');
    }



    public function login(Request $req){

    $email = $req->input('email');
    $password = $req->input('password');


    $foundUser = null ;

    $users = User::all();
    
    
    foreach ($users as $user) {
            if ($user->email == $email) {
        $foundUser = $user;
                break;
            }
    };
    


if($foundUser && password_verify($password , $foundUser -> password)){
    session(['user_id' => $foundUser->id]);
    session(['user_name' => $foundUser->name]);

    return redirect('/posts');
}
   return back()->with('error', 'incorrect email or password');

    }
    public function logout()
    {
        session()->forget('user_id');
        session()->forget('user_name');
        return redirect('/');
    }
}
