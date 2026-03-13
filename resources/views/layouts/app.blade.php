<!DOCTYPE html>
<html>
<head>
    <title>Mon Réseau Social</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial; margin: 0; padding: 20px; background: #f0f2f5; }
        .container { max-width: 800px; margin: auto; }
        .nav { background: white; padding: 10px; margin-bottom: 20px; border-radius: 5px; }
        .nav a { margin-right: 10px; }
        .alert { padding: 10px; margin-bottom: 10px; border-radius: 5px; }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-error { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a href="/">Accueil</a>
            <a href="/posts">Posts</a>
            @if(session('user_id'))
                <span>Bonjour {{ session('user_name') }}</span>
                <a href="/posts/create">Nouveau post</a>
                <a href="/logout">Déconnexion</a>
            @else
                <a href="/login">Connexion</a>
                <a href="/register">Inscription</a>
            @endif
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        
        @yield('content')
    </div>
    
    @yield('scripts')
</body>
</html>