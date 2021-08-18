@extends('layouts.dashboard')

@section('content')


<section id="basic-vertical-layouts">
    <div class="row match-height d-flex justify-content-center">
        <div class="col-md-12 col-12">
            <div class="card" style="
background: linear-gradient(180deg, #0F1522 0%, rgba(15, 21, 34, 0) 100%);
border-radius: 8px;">
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{route('ticket.store')}}" method="POST">
                            @csrf
                            <div class="form-body">
                                <div class="row">

                                    <div class="col-6">
                                        <label id="form-label" class="form-label" for="name"><b>Nombre</b></label>
                                        <input class="form-control" required type="text" id="name" name="name" rows="3" />

                                    </div>

                                    <div class="col-6">
                                        <label id="form-label" class="form-label" for="email"><b>Direccion de correo electrónico</b></label>
                                        <input class="form-control" required type="text" id="email" name="email" rows="3" />

                                    </div>



                                    <div class="col-12">
                                        <label id="form-label" class="form-label mt-2" for="issue"><b>Sujeto</b></label>
                                        <input class="form-control" required type="text" id="issue" name="issue" rows="3" />

                                    </div>



                                    <div class="col-12">
                                        <button type="submit" id="send" class="col-12 btn  mr-1 mb-1 waves-effect waves-light">Enviar
                                            Ticket</button>
                                    </div>


                                        <!--
                                    <div class="col-12 mt-2">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="priority" class="">Prioridad del Ticket</label>
                                                <span class="text-danger text-bold-600">OBLIGATORIO</span>
                                                <select name="priority" id="priority" class="custom-select priority @error('priority') is-invalid @enderror" required data-toggle="select">
                                                    <option value="0">Alto</option>
                                                    <option value="1">Medio</option>
                                                    <option value="2">Bajo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

-->


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection