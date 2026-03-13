<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Afficher le formulaire d'inscription
    public function showRegister()
    {
        return view('auth.register');
    }

    // Traiter l'inscription
    public function register(Request $request)
    {
        // Validation simple
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        
        if (empty($name) || empty($email) || empty($password)) {
            return back()->with('error', 'Tous les champs sont obligatoires');
        }
        
        // Vérifier si l'email existe déjà
        $existingUser = null;
        $users = User::all();
        foreach ($users as $user) {
            if ($user->email == $email) {
                $existingUser = $user;
                break;
            }
        }
        
        if ($existingUser) {
            return back()->with('error', 'Cet email est déjà utilisé');
        }
        
        // Créer l'utilisateur
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = password_hash($password, PASSWORD_DEFAULT); // Hash simple
        $user->save();
        
        return redirect('/login')->with('success', 'Compte créé avec succès');
    }

    // Afficher le formulaire de connexion
    public function showLogin()
    {
        return view('auth.login');
    }

    // Traiter la connexion
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        
        // Chercher l'utilisateur
        $foundUser = null;
        $users = User::all();
        foreach ($users as $user) {
            if ($user->email == $email) {
                $foundUser = $user;
                break;
            }
        }
        
        if ($foundUser && password_verify($password, $foundUser->password)) {
            // Stocker l'ID dans la session
            session(['user_id' => $foundUser->id]);
            session(['user_name' => $foundUser->name]);
            
            return redirect('/posts');
        }
        
        return back()->with('error', 'Email ou mot de passe incorrect');
    }

    // Déconnexion
    public function logout()
    {
        session()->forget('user_id');
        session()->forget('user_name');
        return redirect('/');
    }
}