@extends('layouts.app')

@section('content')
    <h1>Connexion</h1>
    
    <div style="background: white; padding: 20px; border-radius: 5px; max-width: 400px; margin: auto;">
        <form action="/login" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; margin-bottom: 5px;">Email:</label>
                <input type="email" name="email" id="email" required 
                       style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label for="password" style="display: block; margin-bottom: 5px;">Mot de passe:</label>
                <input type="password" name="password" id="password" required 
                       style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
            </div>
            
            <button type="submit" style="background: #007bff; color: white; padding: 10px 20px; 
                    border: none; border-radius: 3px; cursor: pointer;">
                Se connecter
            </button>
        </form>
        
        <p style="margin-top: 15px; text-align: center;">
            Pas encore de compte? <a href="/register">S'inscrire</a>
        </p>
    </div>
@endsection