<div class="container">
    <div class="row">
        <div class="col-9">
            <h1 class="text-white">Lista de Referidos</h1>
        </div>

        <div class="col-3">
            <button class="btn mb-2 " style="background-color:#00C8F4;color: black;" onclick="getlink()">ID de
                referido: {{Auth::user()->id}} <i class="fa fa-copy"></i></button>
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
                <td> <a class=" btn btn-info text-white text-bold-600">Inactivo</a></td>
                @elseif($item->status == '1')
                <td> <a class=" btn btn-success text-white text-bold-600">Activo</a></td>
                @elseif($item->status == '2')
                <td> <a class=" btn btn-warning text-white text-bold-600">Suspendido</a></td>
                @elseif($item->status == '3')
                <td> <a class=" btn btn-danger text-white text-bold-600">Bloqueado</a></td>
                @elseif($item->status == '4')
                <td> <a class=" btn btn-danger text-white text-bold-600">Caducado</a></td>
                @elseif($item->status == '5')
                <td> <a class=" btn btn-danger text-white text-bold-600">Eliminado</a></td>
                @endif
                <td>{{date('d-m-Y', strtotime($item->created_at))}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>