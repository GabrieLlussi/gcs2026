<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 350px;">
        <h3 class="text-center mb-3">🔐 Login</h3>

        @if(session('erro'))
            <div class="alert alert-danger">
                {{ session('erro') }}
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="mb-3">
                <label>Login</label>
                <input type="text" name="login" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Senha</label>
                <input type="password" name="senha" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>

</div>

</body>
</html>