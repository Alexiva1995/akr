<style>
    #abierto {
        background: rgba(0, 246, 225, 0.77);
        border-radius: 8px;


       
        font-style: normal;
        font-weight: normal;
        font-size: 18px;
        line-height: 18px;
        /* identical to box height, or 100% */
        letter-spacing: -0.2px;
        color: #FFFFFF;

    }

    #cerrado {
        background: rgba(246, 74, 0, 0.77);
        border-radius: 8px;
        
        font-style: normal;
        font-weight: normal;
        font-size: 18px;
        line-height: 18px;
        /* identical to box height, or 100% */
        letter-spacing: -0.2px;
         color: #FFFFFF;

    }

    #IDref {
        background: #00B2A2;
        border-radius: 5px;
      
        font-style: normal;
        font-weight: normal;
        font-size: 15px;
        line-height: 23px;
        color: #000000 !important;

    }
</style>

<div class="container">
    <div class="row">
        <div class="col-9">
            <h1 class="text-white">Lista de Referidos</h1>
        </div>

        <div class="col-3">
            <button class="btn mb-2 " id="IDref" onclick="getlink()">ID de
                referido: XXXX {{Auth::user()->id}} <i class="fa fa-link"></i></button>
        </div>
    </div>
</div>


<div class="table-responsive" style="border-radius: 8px 8px 0px 0px;">
    <table style="border-radius: 8px 8px 0px 0px;" class=" w-100 nowrap scroll-horizontal-vertical  table-striped">
        <thead class="" id="thead">
            <tr class="text-center text-white">
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Invertido</th>
                <th>Estado</th>
                <th>Ingreso</th>
            </tr>
        </thead>

        <tbody id="tvody">
            @foreach ($data as $item)
            <tr class="text-center" id="contend">
                <td>00{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->montoInvertido()}}</td>

                @if ($item->status == '0')
                <td> <a class=" btn" id="cerrado">Inactivo</a></td>
                @elseif($item->status == '1')
                <td> <a class=" btn" id="abierto">Activo</a></td>
                @elseif($item->status == '2')
                <td> <a class=" btn" id="cerrado">Suspendido</a></td>
                @elseif($item->status == '3')
                <td> <a class=" btn " id="cerrado">Bloqueado</a></td>
                @elseif($item->status == '4')
                <td> <a class=" btn " id="cerrado">Caducado</a></td>
                @elseif($item->status == '5')
                <td> <a class=" btn" id="cerrado">Eliminado</a></td>
                @endif
                <td>{{date('d-m-Y', strtotime($item->created_at))}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>