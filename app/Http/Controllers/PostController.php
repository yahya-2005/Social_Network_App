<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

public function index(){
    $posts = Post::orderby('created_at','desc')->get();




   foreach ($posts as $post) {

    $user = User::find($post->user_id);
    $post->author_name = $user ? $user->name : 'Unknown';

    $likes = $post->likes;
    $post->likesC = 0;

    foreach($likes as $like){
        $post->likesC++;
    }

    $userId = session('user_id');
    $post->like_by_U = false;

    if($userId){
        foreach($likes as $like){
            if($like->user_id == $userId){
                $post->like_by_U = true;
                break;
            }
        }
    }
}
return view('posts.index', ['posts' => $posts]);
}

    

   public function create(){
    return view('posts.create');
   }



   public function store(Request $req){
    $title = $req->input('title');
    $content = $req->input('content');


    if(empty($title)  || empty($content)){
        return back()->with('error', 'title and content required');
    }
   }

   public function show($id){
    $post = Post::find($id);


    if(!$post){
        return redirect('/posts')->with('error', 'post not found');
    }
     $user = User::find($post->user_id);
        $post->author_name = $name ? $user->name :'Unknown';






//likes part in show 
$likes = $post->likes;
        $post->likes_count = 0;
        foreach ($likes as $like) {
            $post->likes_count++;
        }


        return view('posts.show', ['post' => $post]);
   }


    public function edit($id)
    {
        $post = Post::find($id);
        
        if (!$post) {
            return redirect('/posts')->with('error', 'Post non trouvé');
        }
        
        // Utiliser la Policy pour vérifier
        $user = new User();
        $user->id = session('user_id');
        
        if (!$user->can('update', $post)) {
            return redirect('/posts')->with('error', 'You cannot edit this post');
        }
        
        return view('posts.edit', ['post' => $post]);
    }
 public function update(Request $request, $id)
    {
        $post = Post::find($id);
        
        if (!$post) {
            return redirect('/posts')->with('error', 'Post non trouvé');
        }
  
        $user = new User();
        $user->id = session('user_id');
        
        if (!$user->can('update', $post)) {
            
        
        return redirect('/posts')->with('error', 'You cannot edit this post');
        }
        
        $title = $request->input('title');
        $content = $request->input('content');
        
        if (empty($title) || empty($content)) {
            return back()->with('error', 'Title and content required');
        }
        
        $post->title = $title;
        $post->content = $content;
        $post->save();
        
        return redirect('/posts')->with('success', 'Post successfully edited');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        
        if (!$post) {
            return redirect('/posts')->with('error', 'Post not found');
        }
    
        $user = new User();
        $user->id = session('user_id');
        
        if (!$user->can('delete', $post)) {
            return redirect('/posts')->with('error', 'You cannot delete this post');
        }
        
        $post->delete();
        
        return redirect('/posts')->with('success', 'Post successfully deleted');
    }


    
}