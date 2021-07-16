@extends('layouts.dashboard')

@push('vendor_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endpush

@push('page_vendor_js')
<script src="{{asset('assets/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
@endpush

@section('content')
<div id="adminServices">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="row">

                        <div class="table-responsive">
                            <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped">
                                <thead class="">
                                    <tr class="text-center text-white bg-purple-alt2">
                                        <th>ID</th>
                                        <th class="d-none d-sm-table-cell">Correo</th>
                                        <th>Paquete</th>
                                        <th class="d-none d-sm-table-cell">Estado</th>
                                        <th class="d-none d-sm-table-cell">Fecha</th>
                                        <th class="d-none d-sm-table-cell">Progreso</th>
                                        <th class="d-none d-sm-table-cell">Ganancia</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $categories)
                                    <tr class="text-center">
                                        <td>{{$categories->id}}</td>
                                        <td>{{$categories->email}}</td>
                                        <td>{{$categories->package}}</td>


                                        @if ($categories->status == '0')
                                        <td> <a class=" btn btn-info text-white text-bold-600">Esperando</a></td>
                                        @elseif($categories->status == '1')
                                        <td> <a class=" btn btn-success text-white text-bold-600">Aprobado</a></td>
                                        @elseif($categories->status >= '2')
                                        <td> <a class=" btn btn-danger text-white text-bold-600">Cancelado</a></td>
                                        @endif

                                        <td>{{date('Y-M-d', strtotime($categories->created_at))}}</td>
                                        <td>{{$categories->progreso}}</td>
                                        <td>{{$categories->ganacia}} %</td>

                                    </tr>


                                    @endforeach
                                </tbody>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        @endsection