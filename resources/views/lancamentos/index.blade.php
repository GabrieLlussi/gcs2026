<!DOCTYPE html>
<html>
<head>
    <title>Lançamentos</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">
        <div class="d-flex justify-content-between mb-3">
    <h3>💰 Lista de Lançamentos</h3>
    <a href="/logout" class="btn btn-danger">Sair</a>
</div>

        <div class="card-body">

            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Descrição</th>
                        <th>Data</th>
                        <th>Valor</th>
                        <th>Tipo</th>
                        <th>Situação</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($lancamentos as $l)
                    <tr>
                        <td>{{ $l->id }}</td>
                        <td>{{ $l->descricao }}</td>
                        <td>{{ $l->data_lancamento }}</td>
                        <td>R$ {{ number_format($l->valor, 2, ',', '.') }}</td>

                        <td>
                            @if($l->tipo_lancamento == 'receita')
                                <span class="badge bg-success">Receita</span>
                            @else
                                <span class="badge bg-danger">Despesa</span>
                            @endif
                        </td>

                        <td>
                            @if($l->situacao)
                                <span class="badge bg-primary">Ativo</span>
                            @else
                                <span class="badge bg-secondary">Inativo</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>

</body>
</html>