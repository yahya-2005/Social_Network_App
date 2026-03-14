@extends('layouts.app')

@section('content')
    <div style="text-align: center; padding: 50px; background: white; border-radius: 5px;">
        <h1>welcome to my social network</h1>
        
        <p style="font-size: 18px; margin: 30px 0;">
            Share your thoughts, like your friends' posts!
        </p>
        
        @if(!session('user_id'))
            <div>
                <a href="/login" style="background: #007bff; color: white; padding: 10px 20px; 
                   text-decoration: none; border-radius: 3px; margin-right: 10px;">
                    log in
                </a>
                <a href="/register" style="background: #28a745; color: white; padding: 10px 20px; 
                   text-decoration: none; border-radius: 3px;">
                    sign up
                </a>
            </div>
        @else
            <div>
                <a href="/posts" style="background: #007bff; color: white; padding: 10px 20px; 
                   text-decoration: none; border-radius: 3px;">
                    View posts
                </a>
            </div>
        @endif
    </div>
@endsection