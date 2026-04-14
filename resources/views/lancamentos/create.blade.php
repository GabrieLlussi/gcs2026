<!DOCTYPE html>
<html>
<head>
    <title>Novo Lançamento</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow-lg rounded-4">
        <div class="card-header bg-success text-white">
            <h4>➕ Novo Lançamento</h4>
        </div>

        <div class="card-body">

            <form action="/lancamentos" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Descrição</label>
                    <input type="text" name="descricao" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Data</label>
                    <input type="date" name="data_lancamento" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Valor</label>
                    <input type="number" step="0.01" name="valor" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Tipo</label>
                    <select name="tipo_lancamento" class="form-control" required>
                        <option value="receita">Receita</option>
                        <option value="despesa">Despesa</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Situação</label>
                    <select name="situacao" class="form-control">
                        <option value="1">Ativo</option>
                        <option value="0">Inativo</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/lancamentos" class="btn btn-secondary">⬅ Voltar</a>
                    <button class="btn btn-success">Salvar</button>
                </div>

            </form>

        </div>
    </div>

</div>

</body>
</html>