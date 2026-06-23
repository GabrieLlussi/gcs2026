<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lançamentos</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Ícones -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            min-height: 100vh;
            color: white;
        }

        .glass {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .glass-input {
            background: rgba(255,255,255,0.1);
            border: none;
            color: white;
        }

        .glass-input::placeholder {
            color: #ccc;
        }

        .glass-input:focus {
            background: rgba(255,255,255,0.2);
            color: white;
            box-shadow: none;
        }

        .table {
            color: white;
        }

        .table thead {
            background: rgba(255,255,255,0.1);
        }

        .table-hover tbody tr:hover {
            background: rgba(255,255,255,0.08);
        }

        .btn-glass {
            background: rgba(255,255,255,0.1);
            border: none;
            color: white;
        }

        .btn-glass:hover {
            background: rgba(255,255,255,0.2);
        }

        .badge {
            font-size: 0.75rem;
        }

    </style>
</head>

<body>

<div class="container py-5">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">💰 Finanças</h2>
        <a href="/logout" class="btn btn-danger">
            <i class="bi bi-box-arrow-right"></i> Sair
        </a>
    </div>

    <!-- CARD PRINCIPAL -->
    <div class="glass p-4 shadow-lg">

        <!-- FILTRO -->
        <form method="GET" class="row g-3 mb-4">

            <div class="col-md-3">
                <input type="date" name="data_inicio" class="form-control glass-input" value="{{ request('data_inicio') }}">
            </div>

            <div class="col-md-3">
                <input type="date" name="data_fim" class="form-control glass-input" value="{{ request('data_fim') }}">
            </div>

            <div class="col-md-3">
                <select name="situacao" class="form-control glass-input">
                    <option value="">Todos</option>
                    <option value="1" {{ request('situacao') == '1' ? 'selected' : '' }}>Ativo</option>
                    <option value="0" {{ request('situacao') == '0' ? 'selected' : '' }}>Inativo</option>
                </select>
            </div>

            <div class="col-md-3 d-flex gap-2">
                <button class="btn btn-primary w-100">
                    <i class="bi bi-search"></i>
                </button>

                <a href="/lancamentos" class="btn btn-glass w-100">
                    Limpar
                </a>
            </div>

        </form>

        <!-- AÇÕES -->
        <div class="d-flex justify-content-between mb-4">

            <a href="/lancamentos/create" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Novo
            </a>

            <a href="/lancamentos/pdf" class="btn btn-dark">
                <i class="bi bi-file-earmark-pdf"></i>
            </a>

        </div>

        <!-- TABELA -->
        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>
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

                        <td><strong>{{ $l->descricao }}</strong></td>

                        <td>{{ date('d/m/Y', strtotime($l->data_lancamento)) }}</td>

                        <td class="fw-bold">
                            R$ {{ number_format($l->valor, 2, ',', '.') }}
                        </td>

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

                        <td>
                            <div class="d-flex gap-2">

                                <a href="/lancamentos/{{ $l->id }}/edit" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="/lancamentos/{{ $l->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Excluir?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-light">
                            Nenhum lançamento encontrado
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>