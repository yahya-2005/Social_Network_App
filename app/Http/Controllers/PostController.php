<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Afficher tous les posts
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        
        // Charger manuellement les relations
        foreach ($posts as $post) {
            $user = User::find($post->user_id);
            $post->author_name = $user ? $user->name : 'Inconnu';
            
            // Compter les likes
            $likes = $post->likes;
            $post->likes_count = 0;
            foreach ($likes as $like) {
                $post->likes_count++;
            }
            
            // Vérifier si l'utilisateur connecté a liké
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

    // Afficher le formulaire de création
    public function create()
    {
        return view('posts.create');
    }

    // Enregistrer un nouveau post
    public function store(Request $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');
        
        if (empty($title) || empty($content)) {
            return back()->with('error', 'Titre et contenu obligatoires');
        }
        
        $post = new Post();
        $post->title = $title;
        $post->content = $content;
        $post->user_id = session('user_id');
        $post->save();
        
        return redirect('/posts')->with('success', 'Post créé avec succès');
    }

    // Afficher un post spécifique
    public function show($id)
    {
        $post = Post::find($id);
        
        if (!$post) {
            return redirect('/posts')->with('error', 'Post non trouvé');
        }
        
        $user = User::find($post->user_id);
        $post->author_name = $user ? $user->name : 'Inconnu';
        
        // Compter les likes
        $likes = $post->likes;
        $post->likes_count = 0;
        foreach ($likes as $like) {
            $post->likes_count++;
        }
        
        return view('posts.show', ['post' => $post]);
    }

    // Afficher le formulaire d'édition
    public function edit($id)
    {
        $post = Post::find($id);
        
        if (!$post) {
            return redirect('/posts')->with('error', 'Post non trouvé');
        }
        
        // Vérification simple : l'utilisateur connecté est-il le propriétaire ?
        if (session('user_id') != $post->user_id) {
            return redirect('/posts')->with('error', 'Vous ne pouvez pas modifier ce post');
        }
        
        return view('posts.edit', ['post' => $post]);
    }

    // Mettre à jour un post
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        
        if (!$post) {
            return redirect('/posts')->with('error', 'Post non trouvé');
        }
        
        // Vérification simple : l'utilisateur connecté est-il le propriétaire ?
        if (session('user_id') != $post->user_id) {
            return redirect('/posts')->with('error', 'Vous ne pouvez pas modifier ce post');
        }
        
        $title = $request->input('title');
        $content = $request->input('content');
        
        if (empty($title) || empty($content)) {
            return back()->with('error', 'Titre et contenu obligatoires');
        }
        
        $post->title = $title;
        $post->content = $content;
        $post->save();
        
        return redirect('/posts')->with('success', 'Post modifié avec succès');
    }

    // Supprimer un post
    public function destroy($id)
    {
        $post = Post::find($id);
        
        if (!$post) {
            return redirect('/posts')->with('error', 'Post non trouvé');
        }
        
        // Vérification simple : l'utilisateur connecté est-il le propriétaire ?
        if (session('user_id') != $post->user_id) {
            return redirect('/posts')->with('error', 'Vous ne pouvez pas supprimer ce post');
        }
        
        $post->delete();
        
        return redirect('/posts')->with('success', 'Post supprimé avec succès');
    }
}