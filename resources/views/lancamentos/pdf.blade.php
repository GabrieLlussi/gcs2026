<h1>Lista de Lançamentos</h1>

<table border="1" width="100%" cellspacing="0" cellpadding="5">
    <tr>
        <th>Descrição</th>
        <th>Data</th>
        <th>Valor</th>
        <th>Tipo</th>
    </tr>

    @foreach($lancamentos as $l)
    <tr>
        <td>{{ $l->descricao }}</td>
        <td>{{ $l->data_lancamento }}</td>
        <td>R$ {{ $l->valor }}</td>
        <td>{{ $l->tipo_lancamento }}</td>
    </tr>
    @endforeach
</table>