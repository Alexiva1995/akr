@extends('layouts.dashboard')
@include('layouts.componenteDashboard.linkReferido')
@section('title', 'Listado '.$title)

{{-- contenido --}}
@section('content')
<div class="col-12">

    <div class="table-responsive">
        @if ($allNetwork == 1)
        @include('genealogy.component.tableDirect', ['data' => $users])
        @else
        @include('genealogy.component.tableNetwork', ['data' => $users])
        @endif
    </div>
</div>
</div>
</div>
</div>
@endsection

{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.optionDatatable')