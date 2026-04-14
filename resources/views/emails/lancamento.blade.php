<h2>📊 Lançamento registrado</h2>

<p><strong>Descrição:</strong> {{ $lancamento->descricao }}</p>
<p><strong>Data:</strong> {{ $lancamento->data_lancamento }}</p>
<p><strong>Valor:</strong> R$ {{ $lancamento->valor }}</p>
<p><strong>Tipo:</strong> {{ $lancamento->tipo_lancamento }}</p>
<p><strong>Situação:</strong> {{ $lancamento->situacao ? 'Ativo' : 'Inativo' }}</p>