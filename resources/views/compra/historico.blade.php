@extends("layout")
@section("conteudo")

<div class="col-12">
    <h2>Minhas Compras</h2>
    <table class="table table-bordered">
        <tr>
            <th>Data da Compra</th>
            <th>Situação</th>
            <th></th>
        </tr>
        @foreach ($lista as $ped)
            <tr>
                <td>{{ $ped->datapedido->format("d/m/Y H:i") }}</td>
                <td>{{ $ped->statusDescricao() }}</td>
                <td></td>
            </tr>
        @endforeach
    </table>
</div>

@endsection
