<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harbour Tech - Project Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bg: #09090b;
            --card-bg: rgba(24, 24, 27, 0.6);
            --border: rgba(255, 255, 255, 0.1);
            --accent: #6366f1;
            --accent-glow: rgba(99, 102, 241, 0.15);
        }
        body {
            background-color: var(--bg);
            background-image: radial-gradient(circle at 15% 50%, var(--accent-glow), transparent 25%);
            color: #e2e8f0;
            font-family: 'DM Sans', sans-serif;
        }
        .navbar {
            background: rgba(9, 9, 11, 0.8) !important;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
        }
        .navbar-brand { font-weight: 700; color: white !important; }
        .card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            color: #e2e8f0;
            border-radius: 16px;
        }
        .card-header {
            background: rgba(0,0,0,0.2);
            border-bottom: 1px solid var(--border);
            font-weight: 600;
        }
        .table { color: #e2e8f0; }
        .table th { border-bottom: 1px solid var(--border); }
        .table td { border-bottom: 1px solid rgba(255,255,255,0.05); }
        .form-control, .form-select {
            background: rgba(0,0,0,0.2);
            border: 1px solid var(--border);
            color: white;
        }
        .form-control:focus, .form-select:focus {
            background: rgba(0,0,0,0.3);
            border-color: var(--accent);
            box-shadow: 0 0 0 0.25rem var(--accent-glow);
            color: white;
        }
        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
        }
        .btn-primary:hover {
            background: #4f46e5; border-color: #4f46e5;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('projects.index') }}">Harbour Tech Manager</a>
            @if(session('is_admin'))
                <div class="d-flex">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-outline-danger btn-sm" type="submit">Logout</button>
                    </form>
                </div>
            @endif
        </div>
    </nav>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success bg-success text-white border-0">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
