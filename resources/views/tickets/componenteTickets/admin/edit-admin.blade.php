@extends('layouts.dashboard')

@section('content')



<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>

<section id="basic-vertical-layouts">
    <div class="row match-height d-flex justify-content-center">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Atendiendo el Ticket #{{ $ticket->id}}</h4>
                    <h4 class="card-title mt-2">Usuario: <span class="text-primary">{{ $ticket->iduser}}</span></h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{route('ticket.update-admin', $ticket->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-body">
                                <div class="row">
                                    <!--
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>titulo del Ticket</label>
                                            <input type="text" id="issue"  class="form-control" value="{{ $ticket->issue }}" name="issue">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="status">Estado del ticket</label>
                                                <span class="text-danger text-bold-600">OBLIGATORIO</span>
                                                <select name="status" id="status" class="custom-select status @error('status') is-invalid @enderror" required data-toggle="select">
                                                    <option value="0" @if($ticket->status == '0') selected @endif>Abierto</option>
                                                    <option value="1" @if($ticket->status == '1') selected @endif>Cerrado</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>-->




                                    <div class="col-12">
                                        <div class="form-group">

                                            <textarea type="text" rows="5" readonly id="" class="form-control" name="description">{{ $ticket->description}}</textarea>

                                            <br>

                                            <textarea type="text" rows="5" id="" placeholder="En este campo estara la nota que deja el administrador que atendio su orden" class="form-control" name="note_admin">{{$ticket->note_admin}}</textarea>
                                        </div>
                                    </div>



                                    <!--<div class="col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="priority">prioridad del ticket</label>
                                                <span class="text-danger text-bold-600">OBLIGATORIO</span>
                                                <select name="priority" id="priority" readonly class="custom-select priority @error('priority') is-invalid @enderror" required data-toggle="select">
                                                    <option value="0" @if($ticket->priority == '0') selected @endif>Alto</option>
                                                    <option value="1" @if($ticket->priority == '1') selected @endif>Medio</option>
                                                    <option value="2" @if($ticket->priority == '2') selected @endif>Bajo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>-->
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary d-inline-block float-right mb-1 waves-effect waves-light">Enviar
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection