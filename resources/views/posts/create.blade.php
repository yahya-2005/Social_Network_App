@extends('layouts.app')

@section('content')
    <h1>Créer un nouveau post</h1>
    
    <form action="/posts" method="POST" style="background: white; padding: 20px; border-radius: 5px;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div style="margin-bottom: 15px;">
            <label>Titre:</label>
            <input type="text" name="title" style="width: 100%; padding: 8px;">
        </div>
        
        <div style="margin-bottom: 15px;">
            <label>Contenu:</label>
            <textarea name="content" rows="5" style="width: 100%; padding: 8px;"></textarea>
        </div>
        
        <button type="submit">Publier</button>
    </form>
@endsection