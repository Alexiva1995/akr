<table class="table nowrap scroll-horizontal-vertical myTable table-striped">
    <thead class="">
        <tr class="text-center text-white bg-purple-alt2">
            <th>ID</th>
            <th>Concepto</th>
            <th>Fecha</th>
            <th>Debito</th>
            <th>Credito</th>
            <th>Balance</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($wallets as $wallet)
        <tr class="text-center">
            <td>{{$wallet->id}}</td>
            <td>{{$wallet->descripcion}}</td>
            <td>{{date('d-m-Y', strtotime($wallet->created_at))}}</td>
            <td>$ {{$wallet->debito}}</td>
            <td>$ {{$wallet->credito}}</td>
            <td>$ {{$wallet->balance}}</td>
            <td>
                @if ($wallet->status == 1)
                    Pagado
                @elseif ($wallet->status == 2)
                    Cancelado
                @else
                    En Espera
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>