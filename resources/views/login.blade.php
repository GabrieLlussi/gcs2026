<!DOCTYPE html>
<html lang="pt-br" style="color-scheme: dark;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #0B1120;
            --surface: rgba(18, 27, 45, 0.65);
            --surface-alt: #19233A;
            --border: #232C42;
            --text: #E7EAF1;
            --text-muted: #8B96AC;
            --accent: #34D399;
            --primary: #60A5FA;
            --danger: #F87171;
            --danger-soft: rgba(248, 113, 113, 0.14);
        }

        * {
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--bg);
            background-image:
                radial-gradient(circle at 20% 15%, rgba(96,165,250,0.16), transparent 45%),
                radial-gradient(circle at 85% 85%, rgba(52,211,153,0.12), transparent 45%);
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--text);
        }

        .login-card {
            background: var(--surface);
            backdrop-filter: blur(18px);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 40px;
            width: 380px;
            box-shadow: 0 24px 50px rgba(0,0,0,0.45);
        }

        .login-card .eyebrow {
            font-size: 12px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-muted);
            font-weight: 600;
            text-align: center;
            margin-bottom: 6px;
        }

        .login-card h2 {
            font-family: 'Sora', 'Segoe UI', sans-serif;
            text-align: center;
            margin: 0 0 28px;
            font-weight: 700;
            font-size: 22px;
            color: var(--text);
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 12px 14px;
            margin-bottom: 18px;
            border: 1px solid var(--border);
            border-radius: 10px;
            outline: none;
            background: var(--surface-alt);
            color: var(--text);
            font-size: 14px;
        }

        .form-control::placeholder { color: var(--text-muted); }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.25);
        }

        .btn {
            display: block;
            width: 100%;
            padding: 13px;
            margin-top: 4px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--accent), var(--primary));
            color: #06121F;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(0,0,0,0.35);
        }

        .btn:active {
            transform: translateY(0);
        }

        .error {
            background: var(--danger-soft);
            border: 1px solid rgba(248, 113, 113, 0.3);
            color: var(--danger);
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 18px;
            text-align: center;
            font-size: 13.5px;
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="eyebrow">Controle Financeiro</div>
    <h2>Acesso ao Sistema</h2>

    @if(session('erro'))
        <div class="error">
            {{ session('erro') }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <label>Login</label>
        <input type="text" name="login" class="form-control" placeholder="seu usuário" required>

        <label>Senha</label>
        <input type="password" name="senha" class="form-control" placeholder="••••••••" required>

        <button class="btn">Entrar</button>
    </form>
</div>

</body>
</html>