<table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">

    <thead class="text-white">
        <tr class="text-center  bg-purple-alt2">
            <th>#</th>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Descripcion</th>
            <th>Monto</th>
            <th>tipo</th>
            <th>estado</th>
            

        </tr>
    </thead>
    <tbody>
       
        </form>
        @foreach ($wallets as $wallet)
        <tr class="text-center ">
            <td>{{$wallet->id}}</td>
            <td>{{date('d-m-Y', strtotime($wallet->created_at))}}</td>
            <td>{{$wallet->getWalletUser->fullname}}</td>
            <td>{{$wallet->descripcion}}</td>
            {{--
            @php
                $monto = $wallet->monto;
                if($wallet->tipo_transaction == 1){
                    $monto = $monto * (-1);
                }
            @endphp--}}
            <td>$ {{number_format($wallet->monto,2)}}</td>

            <td>
                @if ($wallet->tipo_transaction == 0)
                    Comision
                @elseif ($wallet->tipo_transaction == 1)
                    Retiro
                @endif
            </td>
          
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

