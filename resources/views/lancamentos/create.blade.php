<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Lançamento</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #1f2937, #111827);
            min-height: 100vh;
            color: #fff;
        }

        .card {
            background: #ffffff;
            border: none;
        }

        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px;
        }

        .form-control:focus {
            box-shadow: 0 0 0 2px #22c55e;
            border-color: #22c55e;
        }

        .btn-success {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            border: none;
            border-radius: 10px;
            padding: 10px;
            font-weight: bold;
        }

        .btn-success:hover {
            opacity: 0.9;
        }

        .btn-secondary {
            border-radius: 10px;
        }

        .header-icon {
            font-size: 28px;
        }
    </style>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <div class="card shadow-lg p-4 rounded-4" style="width: 500px;">

        <div class="text-center mb-4">
            <div class="header-icon">💰</div>
            <h3 class="fw-bold">Novo Lançamento</h3>
            <p class="text-muted">Preencha os dados abaixo</p>
        </div>

        <form action="/lancamentos" method="POST">
            @csrf

            <div class="form-floating mb-3">
                <input type="text" name="descricao" class="form-control" placeholder="Descrição" required>
                <label>Descrição</label>
            </div>

            <div class="form-floating mb-3">
                <input type="date" name="data_lancamento" class="form-control" required>
                <label>Data</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" step="0.01" name="valor" class="form-control" placeholder="Valor" required>
                <label>Valor (R$)</label>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo</label>
                <select name="tipo_lancamento" class="form-select" required>
                    <option value="receita">💵 Receita</option>
                    <option value="despesa">💸 Despesa</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Situação</label>
                <select name="situacao" class="form-select">
                    <option value="1">✅ Ativo</option>
                    <option value="0">❌ Inativo</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="/lancamentos" class="btn btn-outline-secondary px-4">Voltar</a>
                <button class="btn btn-success px-4">Salvar</button>
            </div>

        </form>

    </div>

</div>

</body>
</html>