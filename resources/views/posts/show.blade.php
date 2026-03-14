@extends('layouts.app')

@section('content')
    <div style="background: white; padding: 20px; border-radius: 5px;">
        <h1>{{ $post->title }}</h1>
        
        <p style="color: #666; font-size: 14px;">
            by {{ $post->author_name }} - {{ $post->created_at }}
        </p>
        
        <div style="margin: 20px 0; line-height: 1.6;">
            {{ $post->content }}
        </div>
        
        <div>
            <span>{{ $post->likes_count }} likes</span>
        </div>
        
        <div style="margin-top: 20px;">
            <a href="/posts" style="background: #6c757d; color: white; padding: 8px 15px; 
               text-decoration: none; border-radius: 3px;">
                Retour
            </a>
            
            @if(session('user_id') == $post->user_id)
                <a href="/posts/{{ $post->id }}/edit" style="background: #ffc107; color: black; 
                   padding: 8px 15px; text-decoration: none; border-radius: 3px; margin-left: 10px;">
                    Modifier
                </a>
                
                <form action="/posts/{{ $post->id }}" method="POST" style="display: inline; margin-left: 10px;">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" onclick="return confirm('Supprimer ce post?')" 
                            style="background: #dc3545; color: white; padding: 8px 15px; 
                                   border: none; border-radius: 3px; cursor: pointer;">
                        Supprimer
                    </button>
                </form>
            @endif
        </div>
    </div>
@endsection