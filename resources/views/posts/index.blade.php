@extends('layouts.app')

@section('content')
    <h1>Tous les posts</h1>
    
    @foreach($posts as $post)
        <div style="background: white; padding: 15px; margin-bottom: 15px; border-radius: 5px;">
            <h2><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h2>
            <p>{{ substr($post->content, 0, 100) }}...</p>
            <p>Par {{ $post->author_name }} - {{ $post->created_at }}</p>
            
            <div>
                <button class="like-btn" data-post-id="{{ $post->id }}">
                    {{ $post->liked_by_user ? 'Unlike' : 'Like' }}
                </button>
                <span class="likes-count">{{ $post->likes_count }}</span> likes
            </div>
            
            @if(session('user_id') == $post->user_id)
                <div style="margin-top: 10px;">
                    <a href="/posts/{{ $post->id }}/edit">Modifier</a>
                    <form action="/posts/{{ $post->id }}" method="POST" style="display: inline;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" onclick="return confirm('Supprimer ce post?')">Supprimer</button>
                    </form>
                </div>
            @endif
        </div>
    @endforeach
@endsection

@section('scripts')
<script>
    // Version AJAX simple
    document.querySelectorAll('.like-btn').forEach(button => {
        button.addEventListener('click', function() {
            const postId = this.dataset.postId;
            
            fetch('/posts/' + postId + '/like', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.textContent = data.liked ? 'Unlike' : 'Like';
                    this.nextElementSibling.textContent = data.likes_count;
                }
            });
        });
    });
</script>
@endsection