@extends('layouts.app')

@section('content')
    <div style="text-align: center; padding: 50px; background: white; border-radius: 5px;">
        <h1>Welcome to My Social Network App</h1>
        
        
        
        @if(!session('user_id'))
            <div>
                <a href="/login" style="background: #007bff; color: white; padding: 10px 20px; 
                   text-decoration: none; border-radius: 3px; margin-right: 10px;">
                    Se connecter
                </a>
                <a href="/register" style="background: #28a745; color: white; padding: 10px 20px; 
                   text-decoration: none; border-radius: 3px;">
                    S'inscrire
                </a>
            </div>
        @else
            <div>
                <a href="/posts" style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 3px;">
                    Voir les posts
                </a>
            </div>
        @endif
    </div>
@endsection