<!DOCTYPE html>
<html>
<head>
    <title>my social network</title>
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
            <a href="/">Home</a>
            <a href="/posts">Posts</a>
            @if(session('user_id'))
                <span>Hello {{ session('user_name') }}</span>
                <a href="/posts/create">New Post</a>
                <a href="/logout">Logout</a>
            @else
                <a href="/login">Login</a>
                <a href="/register">Register</a>
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