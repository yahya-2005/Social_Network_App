<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
   




    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        
        



        foreach ($posts as $post) {
            $user = User::find($post->user_id);
            $post->author_name = $user ? $user->name : 'Inconnu';
            
          
            


  $likes = $post->likes;
      $post->likes_count = 0;
          foreach ($likes as $like) {
            $post->likes_count++;
            }
            
            
            



            $userId = session('user_id');
            $post->liked_by_user = false;
            if ($userId) {
                foreach ($likes as $like) {
                    if ($like->user_id == $userId) {
                        $post->liked_by_user = true;
                        break;
                    }
                }
            }
        }
        
        return view('posts.index', ['posts' => $posts]);
    }

    
    public function create()
    {
        return view('posts.create');
    }


    


    public function store(Request $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');
        
        if (empty($title) || empty($content)) {
            return back()->with('error', 'title and content are required');
        }
        
        $post = new Post();
        $post->title = $title;
        $post->content = $content;
        $post->user_id = session('user_id');
        $post->save();
        
        return redirect('/posts')->with('success', 'post created successfully');
    }


    


    public function show($id)
    {
        $post = Post::find($id);
        
        if (!$post) {
            return redirect('/posts')->with('error', 'post not found');
        }
        
        $user = User::find($post->user_id);
        $post->author_name = $user ? $user->name : 'unknown';
 
        
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
            return redirect('/posts')->with('error', 'post not found');
        }
        
      
        


        if (session('user_id') != $post->user_id) {
            return redirect('/posts')->with('error', 'you cannot modify this post');
        }
        
        return view('posts.edit', ['post' => $post]);
    }


    












    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        
        if (!$post) {
            return redirect('/posts')->with('error', 'post not found');
        }
        
    
        




        if (session('user_id') != $post->user_id) {
            return redirect('/posts')->with('error', 'you cannot modify this post');
        }
        
        $title = $request->input('title');
        $content = $request->input('content');
        
        
        
        if (empty($title) || empty($content)) {
            return back()->with('error', 'title and content are required');
        }
        
       
       
       
        $post->title = $title;
        $post->content = $content;
        $post->save();
        
        return redirect('/posts')->with('success', 'post modified successfully');
    }

    




    public function destroy($id)
    {
        $post = Post::find($id);
        
        if (!$post) {
            return redirect('/posts')->with('error', 'post not found');
        }
        
        
        


        if (session('user_id') != $post->user_id) {
            return redirect('/posts')->with('error', 'you cannot delete this post');
        }
        
        $post->delete();
        
        return redirect('/posts')->with('success', 'post deleted successfully');
    }
}