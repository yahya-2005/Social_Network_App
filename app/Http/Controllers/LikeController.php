<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    // Liker un post
    public function like(Request $request, $postId)
    {
        $userId = session('user_id');
        
        // Vérifier si déjà liké
        $existingLike = null;
        $likes = Like::where('post_id', $postId)->get();
        
        foreach ($likes as $like) {
            if ($like->user_id == $userId) {
                $existingLike = $like;
                break;
            }
        }
        
        if ($existingLike) {
            // Déjà liké, on supprime le like
            $existingLike->delete();
            $liked = false;
        } else {
            // Pas encore liké, on crée le like
            $like = new Like();
            $like->user_id = $userId;
            $like->post_id = $postId;
            $like->save();
            $liked = true;
        }
        
        // Compter les likes
        $post = Post::find($postId);
        $likesCount = 0;
        foreach ($post->likes as $like) {
            $likesCount++;
        }
        
        // Vérifier si c'est une requête AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'liked' => $liked,
                'likes_count' => $likesCount
            ]);
        }
        
        return back();
    }
}