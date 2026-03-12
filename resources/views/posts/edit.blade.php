@extends('layouts.app')

@section('content')
    <h1>Modifier le post</h1>
    
    <form action="/posts/{{ $post->id }}" method="POST" style="background: white; padding: 20px; border-radius: 5px;">
        <input type="hidden" name="_method" value="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div style="margin-bottom: 15px;">
            <label for="title">Titre:</label>
            <input type="text" name="title" id="title" value="{{ $post->title }}" required 
                   style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
        </div>
        
        <div style="margin-bottom: 15px;">
            <label for="content">Contenu:</label>
            <textarea name="content" id="content" rows="5" required 
                      style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">{{ $post->content }}</textarea>
        </div>
        
        <button type="submit" style="background: #ffc107; color: black; padding: 10px 20px; 
                border: none; border-radius: 3px; cursor: pointer;">
            Mettre à jour
        </button>
        
        <a href="/posts" style="background: #6c757d; color: white; padding: 10px 20px; 
           text-decoration: none; border-radius: 3px; margin-left: 10px;">
            Annuler
        </a>
    </form>
@endsection