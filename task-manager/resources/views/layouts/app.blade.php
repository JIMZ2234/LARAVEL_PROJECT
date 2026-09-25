<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Personal Task Manager')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --success: #16a34a;
            --warning: #d97706;
            --danger: #dc2626;
            --bg: #f3f4f6;
            --card: #ffffff;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #e5e7eb;
        }
        * { box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            margin: 0;
        }
        nav {
            background: var(--primary);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        nav a.brand {
            color: white;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.2rem;
        }
        .container { max-width: 1000px; margin: 2rem auto; padding: 0 1.5rem; }

        /* Stat cards */
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 1rem; margin-bottom: 2rem; }
        .stat-card {
            background: var(--card);
            border-radius: 10px;
            padding: 1.25rem;
            box-shadow: 0 1px 3px rgba(0,0,0,.08);
            border-left: 4px solid var(--primary);
        }
        .stat-card h3 { margin: 0; font-size: 1.8rem; }
        .stat-card p { margin: 4px 0 0; color: var(--muted); font-size: .85rem; text-transform: uppercase; letter-spacing: .03em; }
        .stat-card.pending { border-left-color: var(--warning); }
        .stat-card.completed { border-left-color: var(--success); }

        /* Table / card list */
        .panel {
            background: var(--card);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0,0,0,.08);
            overflow: hidden;
        }
        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
        }
        .panel-header h2 { margin: 0; font-size: 1.1rem; }

        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 14px 1.5rem; text-align: left; }
        th { background: #f9fafb; color: var(--muted); font-size: .75rem; text-transform: uppercase; letter-spacing: .04em; border-bottom: 1px solid var(--border); }
        tbody tr { border-bottom: 1px solid var(--border); }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #fafafa; }
        .task-name { font-weight: 600; }
        .task-desc { color: var(--muted); font-size: .85rem; }

        /* Badges */
        .badge { display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: .75rem; font-weight: 600; }
        .badge-pending { background: #fef3c7; color: var(--warning); }
        .badge-completed { background: #dcfce7; color: var(--success); }

        /* Buttons */
        .btn { display: inline-block; padding: 7px 14px; border-radius: 6px; text-decoration: none; font-size: .85rem; font-weight: 600; border: none; cursor: pointer; transition: opacity .15s; }
        .btn:hover { opacity: .85; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-success { background: var(--success); color: white; }
        .btn-warning { background: var(--warning); color: white; }
        .btn-danger { background: var(--danger); color: white; }
        .btn-add { background: var(--primary); color: white; padding: 10px 18px; }
        .actions { display: flex; gap: 6px; flex-wrap: wrap; }
        form.inline { display: inline; }

        /* Alerts */
        .alert { background: #dcfce7; color: #166534; padding: 12px 16px; border-radius: 8px; margin-bottom: 1.5rem; font-size: .9rem; }
        .alert-error { background: #fee2e2; color: #991b1b; }

        /* Forms */
        .card { background: var(--card); padding: 2rem; border-radius: 10px; box-shadow: 0 1px 3px rgba(0,0,0,.08); max-width: 550px; margin: 0 auto; }
        .card h2 { margin-top: 0; }
        label { font-weight: 600; display: block; margin-bottom: 6px; font-size: .85rem; }
        input, textarea, select {
            width: 100%; padding: 10px; margin-bottom: 1.1rem;
            border: 1px solid var(--border); border-radius: 6px;
            font-size: .95rem; font-family: inherit;
        }
        input:focus, textarea:focus, select:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(79,70,229,.15); }

        /* Empty state */
        .empty-state { text-align: center; padding: 3rem 1.5rem; color: var(--muted); }
        .empty-state p { margin: 0 0 1rem; }

        @media (max-width: 700px) {
            table thead { display: none; }
            table, tbody, tr, td { display: block; width: 100%; }
            tbody tr { padding: 1rem 1.5rem; }
            td { padding: 4px 0; border: none; }
            td::before { content: attr(data-label); font-weight: 600; display: block; font-size: .75rem; color: var(--muted); text-transform: uppercase; }
            .actions { margin-top: 8px; }
        }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('tasks.index') }}" class="brand">📋 Task Manager</a>
    </nav>

    <div class="container">
        @if (session('success'))
            <div class="alert">✅ {{ session('success') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>