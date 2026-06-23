<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin: 0;
            height: 100vh;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 16px;
            padding: 40px;
            width: 350px;
            color: white;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        .login-card h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            margin-bottom: 20px;
            border: none;
            border-radius: 8px;
            outline: none;
        }

        .form-control:focus {
            box-shadow: 0 0 0 2px #00c6ff;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        }

        .error {
            background: rgba(255, 0, 0, 0.2);
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h2>🔐 Acesso ao Sistema</h2>

    @if(session('erro'))
        <div class="error">
            {{ session('erro') }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <label>Login</label>
        <input type="text" name="login" class="form-control" required>

        <label>Senha</label>
        <input type="password" name="senha" class="form-control" required>

        <button class="btn">Entrar</button>
    </form>
</div>

</body>
</html>