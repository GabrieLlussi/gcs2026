<!DOCTYPE html>
<html>
<head>
    <title>Lançamentos</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Ícones -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>💰 Controle Financeiro</h2>
        <a href="/logout" class="btn btn-danger">
            <i class="bi bi-box-arrow-right"></i> Sair
        </a>
    </div>

    <!-- CARD -->
    <div class="card shadow-lg rounded-4">

        <div class="card-body">

            <!-- FILTRO -->
            <form method="GET" class="row g-3 mb-4">

                <div class="col-md-3">
                    <label>Data Inicial</label>
                    <input type="date" name="data_inicio" class="form-control" value="{{ request('data_inicio') }}">
                </div>

                <div class="col-md-3">
                    <label>Data Final</label>
                    <input type="date" name="data_fim" class="form-control" value="{{ request('data_fim') }}">
                </div>

                <div class="col-md-3">
                    <label>Situação</label>
                    <select name="situacao" class="form-control">
                        <option value="">Todos</option>
                        <option value="1" {{ request('situacao') == '1' ? 'selected' : '' }}>Ativo</option>
                        <option value="0" {{ request('situacao') == '0' ? 'selected' : '' }}>Inativo</option>
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Filtrar
                    </button>

                    <a href="/lancamentos" class="btn btn-secondary w-100">
                        Limpar
                    </a>
                </div>

            </form>

            <!-- AÇÕES -->
            <div class="d-flex justify-content-between mb-3">

                <a href="/lancamentos/create" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Novo Lançamento
                </a>

                <a href="/lancamentos/pdf" class="btn btn-dark">
                    <i class="bi bi-file-earmark-pdf"></i> Exportar PDF
                </a>

            </div>

            <!-- TABELA -->
            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Descrição</th>
                            <th>Data</th>
                            <th>Valor</th>
                            <th>Tipo</th>
                            <th>Situação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($lancamentos as $l)
                        <tr>

                            <td>{{ $l->id }}</td>

                            <td>
                                <strong>{{ $l->descricao }}</strong>
                            </td>

                            <td>{{ date('d/m/Y', strtotime($l->data_lancamento)) }}</td>

                            <td class="fw-bold">
                                R$ {{ number_format($l->valor, 2, ',', '.') }}
                            </td>

                            <!-- TIPO -->
                            <td>
                                @if($l->tipo_lancamento == 'receita')
                                    <span class="badge bg-success">Receita</span>
                                @else
                                    <span class="badge bg-danger">Despesa</span>
                                @endif
                            </td>

                            <!-- SITUAÇÃO -->
                            <td>
                                @if($l->situacao)
                                    <span class="badge bg-primary">Ativo</span>
                                @else
                                    <span class="badge bg-secondary">Inativo</span>
                                @endif
                            </td>

                            <!-- AÇÕES -->
                            <td>

                                <div class="d-flex gap-2">

                                    <!-- EDITAR -->
                                    <a href="/lancamentos/{{ $l->id }}/edit" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <!-- DELETE -->
                                    <form action="/lancamentos/{{ $l->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Tem certeza que deseja excluir?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </div>

                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                Nenhum lançamento encontrado
                            </td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

</body>
</html>