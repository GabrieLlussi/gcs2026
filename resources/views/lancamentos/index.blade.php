<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Controle Financeiro</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: radial-gradient(circle at top, #1e293b, #020617);
    min-height: 100vh;
    color: white;
    font-family: 'Segoe UI', sans-serif;
}

/* GLASS REAL */
.glass {
    background: rgba(255,255,255,0.06);
    backdrop-filter: blur(18px);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 20px;
}

/* INPUT */
.input-glass {
    background: rgba(255,255,255,0.08);
    border: none;
    color: white;
}
.input-glass:focus {
    background: rgba(255,255,255,0.15);
    color: white;
    box-shadow: 0 0 0 2px #22c55e;
}

/* BOTÕES */
.btn-modern {
    border-radius: 12px;
    transition: 0.2s;
}
.btn-modern:hover {
    transform: translateY(-2px);
}

/* TABELA */
.table-glass {
    background: transparent;
    color: white;
}
.table-glass thead {
    background: rgba(255,255,255,0.08);
}
.table-glass tbody tr {
    transition: 0.2s;
}
.table-glass tbody tr:hover {
    background: rgba(255,255,255,0.08);
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
    <h3 class="fw-bold">💰 Controle Financeiro</h3>
    <a href="/logout" class="btn btn-danger btn-modern">Sair</a>
</div>

<div class="glass p-4 shadow-lg">

<!-- FILTRO -->
<form method="GET" class="row g-3 mb-4">

    <div class="col-md-3">
        <input type="date" name="data_inicio" class="form-control input-glass">
    </div>

    <div class="col-md-3">
        <input type="date" name="data_fim" class="form-control input-glass">
    </div>

    <div class="col-md-3">
        <select name="situacao" class="form-control input-glass">
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

<table class="table table-glass align-middle">

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

<td class="fw-bold">R$ {{ number_format($l->valor, 2, ',', '.') }}</td>

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
<td colspan="7" class="text-center text-light">Nenhum lançamento</td>
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