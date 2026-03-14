<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{



    public function like(Request $request, $postId)
    {
        $userId = session('user_id');
        
      
        
        $existingLike = null;
        $likes = Like::where('post_id', $postId)->get();
        
        foreach ($likes as $like) {
            if ($like->user_id == $userId) {
                $existingLike = $like;
                break;
            }
        }





        
        if ($existingLike) {
          
        

            $existingLike->delete();
            $liked = false;
        } else {
           
        
            $like = new Like();
            $like->user_id = $userId;
            $like->post_id = $postId;
            $like->save();
            $liked = true;
        }
        
       



        $post = Post::find($postId);
        $likesCount = 0;
        foreach ($post->likes as $like) {
            $likesCount++;
        }
        

        






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