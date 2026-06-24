<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Controle Financeiro</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background-color: #f5f7fa;
    min-height: 100vh;
    font-family: 'Segoe UI', sans-serif;
    color: #1e293b;
}

/* CARD CLEAN */
.card-clean {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    padding: 24px;
}

/* INPUT */
.input-clean {
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    color: #1e293b;
}
.input-clean:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 2px rgba(59,130,246,0.3);
}

/* BOTÕES */
.btn-modern {
    border-radius: 10px;
    transition: 0.2s;
}
.btn-modern:hover {
    transform: translateY(-2px);
}

/* TABELA */
.table-clean {
    background: #ffffff;
    border-radius: 12px;
    overflow: hidden;
}
.table-clean thead {
    background: #f1f5f9;
}
.table-clean th {
    color: #475569;
    font-weight: 600;
}
.table-clean tbody tr:hover {
    background: #f9fafb;
}

/* BADGES */
.badge-receita {
    background: #22c55e;
}
.badge-despesa {
    background: #ef4444;
}

/* TOAST */
.toast-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
}
</style>
</head>

<body>

<div class="container py-5">

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-primary">💰 Controle Financeiro</h3>
    <a href="/logout" class="btn btn-danger btn-modern">Sair</a>
</div>

<div class="card-clean">

<!-- FILTRO -->
<form method="GET" class="row g-3 mb-4">

    <div class="col-md-3">
        <input type="date" name="data_inicio" class="form-control input-clean">
    </div>

    <div class="col-md-3">
        <input type="date" name="data_fim" class="form-control input-clean">
    </div>

    <div class="col-md-3">
        <select name="situacao" class="form-control input-clean">
            <option value="">Todos</option>
            <option value="1">Ativo</option>
            <option value="0">Inativo</option>
        </select>
    </div>

    <div class="col-md-3 d-flex gap-2">
        <button class="btn btn-primary w-100 btn-modern">Filtrar</button>
        <a href="/lancamentos" class="btn btn-secondary w-100 btn-modern">Limpar</a>
    </div>

</form>

<!-- AÇÕES -->
<div class="d-flex justify-content-between mb-4">
    <a href="/lancamentos/create" class="btn btn-success btn-modern">+ Novo</a>
    <a href="/lancamentos/pdf" class="btn btn-dark btn-modern">PDF</a>
</div>

<!-- TABELA -->
<div class="table-responsive">

<table class="table table-clean align-middle">

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

<td class="fw-bold text-success">R$ {{ number_format($l->valor, 2, ',', '.') }}</td>

<td>
@if($l->tipo_lancamento == 'receita')
<span class="badge badge-receita">Receita</span>
@else
<span class="badge badge-despesa">Despesa</span>
@endif
</td>

<td>
@if($l->situacao)
<span class="badge bg-primary">Ativo</span>
@else
<span class="badge bg-secondary">Inativo</span>
@endif
</td>

<td class="d-flex gap-2">

<a href="/lancamentos/{{ $l->id }}/edit" class="btn btn-warning btn-sm btn-modern">✏️</a>

<form action="/lancamentos/{{ $l->id }}" method="POST">
@csrf
@method('DELETE')
<button class="btn btn-danger btn-sm btn-modern"
onclick="return confirm('Excluir?')">🗑️</button>
</form>

</td>

</tr>
@empty
<tr>
<td colspan="7" class="text-center text-muted">Nenhum lançamento</td>
</tr>
@endforelse

</tbody>

</table>

</div>

</div>

</div>

<!-- TOAST FEEDBACK -->
@if(session('success'))
<div class="toast-container">
    <div class="toast show text-bg-success border-0">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    </div>
</div>
@endif

<script>
setTimeout(() => {
    document.querySelector('.toast')?.remove();
}, 3000);
</script>

</body>
</html>
