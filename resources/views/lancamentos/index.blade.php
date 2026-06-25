<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark" style="color-scheme: dark;">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Controle Financeiro</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">

<style>
:root {
    --bg: #0B1120;
    --surface: #121B2D;
    --surface-alt: #19233A;
    --border: #232C42;
    --text: #E7EAF1;
    --text-muted: #8B96AC;
    --accent: #34D399;
    --accent-soft: rgba(52, 211, 153, 0.14);
    --danger: #F87171;
    --danger-soft: rgba(248, 113, 113, 0.14);
    --primary: #60A5FA;
    --primary-soft: rgba(96, 165, 250, 0.14);
    --warning: #FBBF24;
    --warning-soft: rgba(251, 191, 36, 0.14);
}

* { color-scheme: dark; }

body {
    background: var(--bg);
    background-image: radial-gradient(circle at 15% 0%, rgba(96,165,250,0.08), transparent 45%),
                       radial-gradient(circle at 85% 100%, rgba(52,211,153,0.06), transparent 45%);
    min-height: 100vh;
    font-family: 'Inter', 'Segoe UI', sans-serif;
    color: var(--text);
}

h1, h2, h3, h4, .display-font {
    font-family: 'Sora', 'Segoe UI', sans-serif;
}

/* HEADER */
.app-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 28px;
}
.app-header .eyebrow {
    font-size: 12px;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--text-muted);
    font-weight: 600;
    margin-bottom: 2px;
}
.app-header h1 {
    font-size: 26px;
    font-weight: 700;
    color: var(--text);
    margin: 0;
}

/* CARD CLEAN */
.card-clean {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.35);
    padding: 26px;
}

/* INPUT */
.input-clean {
    background: var(--surface-alt);
    border: 1px solid var(--border);
    border-radius: 10px;
    color: var(--text);
}
.input-clean::placeholder { color: var(--text-muted); }
.input-clean:focus {
    background: var(--surface-alt);
    color: var(--text);
    border-color: var(--primary);
    box-shadow: 0 0 0 3px var(--primary-soft);
}
select.input-clean {
    color-scheme: dark;
}

/* BOTÕES */
.btn-modern {
    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;
    transition: 0.18s ease;
    border: 1px solid transparent;
}
.btn-modern:hover { transform: translateY(-2px); }

.btn-accent {
    background: var(--accent);
    color: #06281E;
}
.btn-accent:hover { background: #2cc189; color: #06281E; }

.btn-outline-clean {
    background: transparent;
    border: 1px solid var(--border);
    color: var(--text);
}
.btn-outline-clean:hover { background: var(--surface-alt); color: var(--text); border-color: var(--border); }

.btn-ghost-danger {
    background: var(--danger-soft);
    color: var(--danger);
    border: 1px solid transparent;
}
.btn-ghost-danger:hover { background: var(--danger); color: #2A0B0B; }

.btn-ghost-warning {
    background: var(--warning-soft);
    color: var(--warning);
    border: 1px solid transparent;
}
.btn-ghost-warning:hover { background: var(--warning); color: #2A1B02; }

/* TABELA — estilo livro-caixa (ledger) */
.table-wrap {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
    overflow: hidden;
}
.table-clean {
    margin: 0;
    color: var(--text);
}
.table-clean thead th {
    background: var(--surface-alt);
    color: var(--text-muted);
    font-size: 12px;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    font-weight: 600;
    border-bottom: 1px solid var(--border);
    padding: 14px 16px;
}
.table-clean tbody td {
    border-bottom: 1px solid var(--border);
    padding: 14px 16px;
    vertical-align: middle;
    background: transparent;
    color: var(--text);
}
.table-clean tbody tr:last-child td { border-bottom: none; }
.table-clean tbody tr:hover td { background: var(--surface-alt); }

/* barra de marcação (ledger mark) por tipo de lançamento */
.ledger-row td:first-child {
    border-left: 3px solid transparent;
}
.ledger-row.receita td:first-child { border-left-color: var(--accent); }
.ledger-row.despesa td:first-child { border-left-color: var(--danger); }

.valor-mono {
    font-family: 'JetBrains Mono', monospace;
    font-weight: 600;
    font-variant-numeric: tabular-nums;
    letter-spacing: 0.01em;
}
.valor-receita { color: var(--accent); }
.valor-despesa { color: var(--danger); }

/* BADGES */
.badge-soft {
    font-weight: 600;
    font-size: 11.5px;
    padding: 5px 10px;
    border-radius: 999px;
}
.badge-receita { background: var(--accent-soft); color: var(--accent); }
.badge-despesa { background: var(--danger-soft); color: var(--danger); }
.badge-ativo { background: var(--primary-soft); color: var(--primary); }
.badge-inativo { background: rgba(139,150,172,0.16); color: var(--text-muted); }

/* EMPTY STATE */
.empty-state {
    text-align: center;
    padding: 48px 16px;
    color: var(--text-muted);
}
.empty-state .icon { font-size: 28px; margin-bottom: 8px; }

/* TOAST */
.toast-container { position: fixed; top: 20px; right: 20px; z-index: 9999; }
.toast-clean {
    background: var(--surface);
    border: 1px solid var(--border);
    border-left: 3px solid var(--accent);
    color: var(--text);
    border-radius: 12px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.45);
}

/* scrollbar discreta (sem branco) */
::-webkit-scrollbar { height: 10px; width: 10px; }
::-webkit-scrollbar-track { background: var(--bg); }
::-webkit-scrollbar-thumb { background: var(--border); border-radius: 10px; }
</style>
</head>

<body>

<div class="container py-5">

<!-- HEADER -->
<div class="app-header">
    <div>
        <div class="eyebrow">Painel financeiro</div>
        <h1>💰 Controle Financeiro</h1>
    </div>
    <a href="/logout" class="btn btn-ghost-danger btn-modern px-3 py-2">Sair</a>
</div>

<div class="card-clean mb-4">

<!-- FILTRO -->
<form method="GET" class="row g-3 mb-4">

    <div class="col-md-3">
        <label class="form-label small text-muted mb-1">De</label>
        <input type="date" name="data_inicio" class="form-control input-clean">
    </div>

    <div class="col-md-3">
        <label class="form-label small text-muted mb-1">Até</label>
        <input type="date" name="data_fim" class="form-control input-clean">
    </div>

    <div class="col-md-3">
        <label class="form-label small text-muted mb-1">Situação</label>
        <select name="situacao" class="form-control input-clean">
            <option value="">Todos</option>
            <option value="1">Ativo</option>
            <option value="0">Inativo</option>
        </select>
    </div>

    <div class="col-md-3 d-flex gap-2 align-items-end">
        <button class="btn btn-accent w-100 btn-modern py-2">Filtrar</button>
        <a href="/lancamentos" class="btn btn-outline-clean w-100 btn-modern py-2">Limpar</a>
    </div>

</form>

<!-- AÇÕES -->
<div class="d-flex justify-content-between">
    <a href="/lancamentos/create" class="btn btn-accent btn-modern px-3 py-2">+ Novo lançamento</a>
    <a href="/lancamentos/pdf" class="btn btn-outline-clean btn-modern px-3 py-2">Exportar PDF</a>
</div>

</div>

<!-- TABELA -->
<div class="table-wrap">
<div class="table-responsive">

<table class="table table-clean align-middle mb-0">

<thead>
<tr>
<th>ID</th>
<th>Descrição</th>
<th>Data</th>
<th class="text-end">Valor</th>
<th>Tipo</th>
<th>Situação</th>
<th class="text-end">Ações</th>
</tr>
</thead>

<tbody>

@forelse ($lancamentos as $l)
<tr class="ledger-row {{ $l->tipo_lancamento == 'receita' ? 'receita' : 'despesa' }}">

<td>{{ $l->id }}</td>

<td><strong>{{ $l->descricao }}</strong></td>

<td>{{ date('d/m/Y', strtotime($l->data_lancamento)) }}</td>

<td class="text-end valor-mono {{ $l->tipo_lancamento == 'receita' ? 'valor-receita' : 'valor-despesa' }}">
R$ {{ number_format($l->valor, 2, ',', '.') }}
</td>

<td>
@if($l->tipo_lancamento == 'receita')
<span class="badge-soft badge-receita">Receita</span>
@else
<span class="badge-soft badge-despesa">Despesa</span>
@endif
</td>

<td>
@if($l->situacao)
<span class="badge-soft badge-ativo">Ativo</span>
@else
<span class="badge-soft badge-inativo">Inativo</span>
@endif
</td>

<td class="text-end">
<div class="d-flex gap-2 justify-content-end">

<a href="/lancamentos/{{ $l->id }}/edit" class="btn btn-ghost-warning btn-sm btn-modern">✏️</a>

<form action="/lancamentos/{{ $l->id }}" method="POST" class="m-0">
@csrf
@method('DELETE')
<button class="btn btn-ghost-danger btn-sm btn-modern"
onclick="return confirm('Excluir este lançamento?')">🗑️</button>
</form>

</div>
</td>

</tr>
@empty
<tr>
<td colspan="7">
    <div class="empty-state">
        <div class="icon">📭</div>
        <div class="fw-semibold mb-1" style="color: var(--text);">Nenhum lançamento por aqui</div>
        <div class="small">Lance sua primeira receita ou despesa para começar a acompanhar seu saldo.</div>
    </div>
</td>
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
    <div class="toast show toast-clean border-0">
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