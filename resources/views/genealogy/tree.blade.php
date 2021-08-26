@extends('layouts.dashboard')
@section('title', $type)
@push('custom_css')
{{-- <link rel="stylesheet" href="{{asset('assets/css/tree2.css')}}"> --}}
<link rel="stylesheet" href="{{ asset('assets/css/tree.css') }}">
<style>
  

    #IDref {
        background: #00B2A2;
        border-radius: 5px;
        font-style: normal;
        font-weight: normal;
        font-size: 15px;
        line-height: 23px;
        color: #FFFFFF !important;

    }
</style>
@endpush
@section('content')
<div class="container">
    <div class="row d-flex justify-content-between mb-1">
        <h1 class="text-white">Arbol de Referidos</h1>
        <button class="btn" id="IDref" onclick="getlink()">ID de
            referido: XXXX {{ Auth::user()->id }}  <i class="fas fa-link"></i>
        </button>
    </div>
</div>
<div class="container bg-image2">
    <div class="row py-1 bg-color-tree">
        {{-- Seccion principal --}}
        <div class="col-12">
            {{-- Seccion de información del usuario clickeado --}}
            <div class="container">
                <div class="row ">
                    <div class="col-md-4 col-sm-12">
                        <div class="container bg-image" id="tarjeta" style="border-radius: 0px;">
                            <div class="row art2" style="border-radius: 0px;">
                                <div class="col-12 ">
                                    <div class="white mt-1">
                                        <p><span class="font-weight-bold">Nombre: </span><span id="nombre"></span></p>
                                    </div>
                                    <div class="white">
                                        <p><span class="font-weight-bold">Fecha de ingreso: </span><span id="fecha"></span></p>
                                    </div>
                                    <div class="white">
                                        <p><span class="font-weight-bold">Auspiciador: </span><span id="auspiciador"></span></p>
                                    </div>
                                    <div class="white">
                                        <p class="font-weight-bold">Puntos totales: <span id="puntos"></span></p>
                                    </div>
                                    <div class="white">
                                        <p><span class="font-weight-bold">País: </span><span id="pais"></span></p>
                                    </div>
                                </div>
                                <div class="m-auto">
                                    <a class="btn btn-arbol text-center mb-1 font-weight-bold" id="ver_arbol" href=>
                                        Ver Arbol
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Inicio del arbol --}}
            <div class="padre">
                <ul>
                    <li class="baseli">
                        <a class="base" href="#">
                            @if (empty($base->photoDB))
                            <img src="{{ asset('assets/img/icono-persona.jpg') }}" alt="{{ $base->name }}" title="{{ $base->name }}" class="rounded-circle" style="width: 100%;height: 100%;">
                            @else
                            <img src="{{ asset('storage/photo/' . $base->photoDB) }}" alt="{{ $base->name }}" title="{{ $base->name }}" class="pt-1 rounded-circle" style="width: 95%;height: 107%;margin-left: 0px;margin-top: -8px;">
                            @endif
                        </a>
                        {{-- Nivel 1 --}}
                        <ul>
                            @foreach ($trees as $child)
                            {{-- genera el lado binario derecho haciendo vacio --}}
                            @include('genealogy.component.sideEmpty', ['side' => 'D', 'cant' =>
                            count($trees),'ladouser' => $child->binary_side])
                            <li href="#prestamo" data-toggle="modal">
                                @include('genealogy.component.subniveles', ['data' => $child])
                                @if (!empty($child->children))
                                {{-- nivel 2 --}}
                                <ul>
                                    @foreach ($child->children as $child2)
                                    {{-- genera el lado binario derecho haciendo vacio --}}
                                    @include('genealogy.component.sideEmpty', ['side' => 'D', 'cant' =>
                                    count($child->children),'ladouser' => $child2->binary_side])
                                    <li>
                                        @include('genealogy.component.subniveles', ['data' => $child2])
                                        @if (!empty($child2->children))
                                        {{-- nivel 3 --}}
                                        <ul>
                                            @foreach ($child2->children as $child3)
                                            {{-- genera el lado binario derecho haciendo vacio --}}
                                            @include('genealogy.component.sideEmpty', ['side' =>
                                            'D', 'cant' => count($child2->children),'ladouser' =>
                                            $child3->binary_side])
                                            <li>
                                                @include('genealogy.component.subniveles', ['data'
                                                => $child3])
                                                {{-- @if (!empty($child->children)) --}}
                                                {{-- nivel 4 
                                                    <ul>
                                                        @foreach ($child->children as $child)
                                                        <li>
                                                            @include('genealogy.component.subniveles', ['data' => $child])
                                                            @if (!empty($child->children))
                                                             nivel 5 
                                                            <ul>
                                                                @foreach ($child->children as $child)
                                                                <li>
                                                                    @include('genealogy.component.subniveles', ['data' => $child])
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                            fin nivel 5
                                                            @endif
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                     fin nivel 4 --}}
                                                {{-- @endif --}}
                                            </li>
                                            {{-- genera el lado binario izquierdo haciendo vacio --}}
                                            @include('genealogy.component.sideEmpty', ['side' =>
                                            'I', 'cant' => count($child2->children),'ladouser' =>
                                            $child3->binary_side])
                                            @endforeach
                                        </ul>
                                        {{-- fin nivel 3 --}}
                                        @endif
                                    </li>
                                    {{-- genera el lado binario izquierdo haciendo vacio --}}
                                    @include('genealogy.component.sideEmpty', ['side' => 'I', 'cant' =>
                                    count($child->children),'ladouser' => $child2->binary_side])
                                    @endforeach
                                </ul>
                                {{-- fin nivel 2 --}}
                                @endif
                            </li>
                            {{-- genera el lado binario izquierdo haciendo vacio --}}
                            @include('genealogy.component.sideEmpty', ['side' => 'I', 'cant' =>
                            count($trees),'ladouser' => $child->binary_side])
                            @endforeach
                        </ul>
                        {{-- fin nivel 1 --}}
                    </li>
                </ul>
            </div>
        </div>
        @if (Auth::id() != $base->id)
        <div class="col-12 text-center">
            <a class="btn btn-info" href="{{ route('genealogy_type', strtolower($type)) }}">Regresar a mi
                arbol</a>
        </div>
        @endif
        {{-- Seccion de puntos --}}
        <div class="container">
            <div class="row d-flex justify-content-between">
                {{-- Puntos por la izquierda --}}
                <div class="col-md-4 col-sm-12 text-left">
                    <div class="row">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class=" d-flex white mt-2">
                                        <button class="btn-tree text-left" style="width: 320PX;">PUNTOS IZQUIERDOS:
                                            <b>{{ $binario['totald'] }}</b></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Puntos por la derecha --}}
                <div class="col-md-4 col-sm-12 ">
                    <div class="row">
                        <div class="container d-flex justify-content-end">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class=" d-flex white mt-2">
                                        <button class="btn-tree text-left" style="width: 320PX;">PUNTOS DERECHOS:
                                            <b>{{ $binario['totali'] }}</b></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    function tarjeta(data, url) {
        console.log(data)
        //console.log('assets/img/sistema/favicon.png');
        $('#nombre').text(data.fullname);
        // if (data.photoDB == null) {
        //     $('#imagen').attr('src', "{{ asset('assets/img/icono-persona.jpg') }}");
        // } else {
        //     $('#imagen').attr('src', '/storage/photo/' + data.photoDB);
        // }
        $('#ver_arbol').attr('href', url);
        $('#inversion').text(data.inversion);
        $('#pais').text(data.pais);
        $('#fecha').text(data.fecha);
        $('#auspiciador').text(data.auspiciador);
        $('#puntos').text(data.puntos);
        // if (data.status == 0) {
        //     $('#estado').html('<span class="badge badge-warning">Inactivo</span>');
        // } else if (data.status == 1) {
        //     $('#estado').html('<span class="badge badge-success">Activo</span>');
        // } else if (data.status == 2) {
        //     $('#estado').html('<span class="badge badge-danger">Eliminado</span>');
        // }
        $('#tarjeta').removeClass('d-none');
    }
</script>
@include('layouts.componenteDashboard.linkReferido')
@endsection