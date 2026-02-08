<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cool Tech | Digestible Technology</title>

    <style>
        :root {
            --primary: #2563eb;
            --dark: #1e293b;
            --light: #f8fafc;
            --text: #334155;
            --success: #22c55e;
            --danger: #ef4444;
        }
        body {
            font-family: 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: var(--text);
            background: var(--light);
            margin: 0; padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background: var(--dark);
            color: white;
            padding: 1.5rem 0;
            text-align: center;
        }
        nav { margin-top: 1rem; }
        nav a { color: white; margin: 0 15px; text-decoration: none; font-weight: bold; }
        nav a:hover { color: var(--primary); }

        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
            flex: 1;
        }
        .card {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            color: white;
        }
        .alert-success { background: var(--success); }
        .alert-danger { background: var(--danger); }

        footer {
            background: #f1f5f9;
            text-align: center;
            padding: 2rem 0;
            margin-top: auto;
            border-top: 1px solid #e2e8f0;
        }
        .logout-btn {
            background: none;
            border: 1px solid #ef4444;
            color: #ef4444;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }
    </style>
</head>
<body>

<header>
    <div style="font-size: 1.8rem; font-weight: bold;">Cool Tech</div>
    <nav>
        <div class="nav-container">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/articles') }}">All Articles</a>
            <a href="{{ url('/search') }}">Search</a>

            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ url('/admin') }}" style="color: #fbbf24;">Content Admin</a>
                    <a href="{{ url('/user-admin') }}" style="color: #fbbf24;">User Admin</a>
                @endif

                @if(Auth::user()->role === 'writer' || Auth::user()->role === 'admin')
                    <a href="{{ url('/writer') }}" style="color: #60a5fa;">Writer Console</a>
                @endif

                <form action="{{ url('/logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout ({{ Auth::user()->name }})</button>
                </form>
            @else
                <a href="{{ url('/login') }}">Login</a>
                <a href="{{ url('/register') }}">Register</a>
            @endauth
        </div>
    </nav>
</header>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @yield('content')
</div>

<div id="cookie-notice" style="background: #1e293b; color: white; padding: 10px; text-align: center; font-size: 0.9rem;">
    <span>This website uses cookies to ensure you get the best experience.</span>
    <button onclick="this.parentElement.style.display='none'" style="margin-left: 15px; padding: 2px 8px; cursor: pointer;">Accept</button>
</div>

<footer>
    <div style="margin-bottom: 10px;">
        <a href="{{ url('/legal') }}" style="color: #64748b; text-decoration: none;">Legal Page</a>
    </div>
    <p style="color: #94a3b8; font-size: 0.8rem;">
        &copy; {{ date('Y') }} Cool Tech. All rights reserved.
    </p>
</footer>

</body>
</html>
