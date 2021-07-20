@extends('layouts.dashboard')

@section('content')



<section id="basic-vertical-layouts">
    <div class="row match-height d-flex justify-content-center">
        <div class="col-md-7 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Atendiendo el Ticket #{{ $ticket->id}}</h4>
                    <h4 class="card-title mt-2">Usuario: <span class="text-primary">{{ $ticket->fullname}}</span></h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{route('ticket.update-admin', $ticket->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-body">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Titulo del Ticket</label>
                                        
                                          <h4>{{ $ticket->issue }}</h4>

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
                                    </div>


                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="priority">prioridad del ticket</label>
                                                <span class="text-danger text-bold-600">OBLIGATORIO</span>
                                                <select name="priority" id="priority" class="custom-select priority @error('priority') is-invalid @enderror" required data-toggle="select">
                                                    <option value="0" @if($ticket->priority == '0') selected @endif>Alto</option>
                                                    <option value="1" @if($ticket->priority == '1') selected @endif>Medio</option>
                                                    <option value="2" @if($ticket->priority == '2') selected @endif>Bajo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <section class="msger">
                                        <header class="msger-header">

                                            <div class="msger-header-options">
                                                <span><i class="fas fa-cog"></i></span>
                                            </div>
                                        </header>

                                        <main class="msger-chat">
                                            <div class="msg left-msg">
                                                <img class="rounded-circle" width="50" height="50" src="{{$ticket->photoDB}}" alt="">

                                                <div class="msg-bubble">
                                                    <div class="msg-info">
                                                        <div class="msg-info-name text-dark">{{ $ticket->email}}</div>
                                                    </div>

                                                    <div class="msg-text text-dark">
                                                        {{ $ticket->description}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="msg-bubble">
                                                    <div class="msg-info">
                                                        <div class="msg-info-name text-dark" style="margin-left: 150px;">{{Auth::user()->email}}</div>
                                                    </div>

                                            <div class="msg right-msg">
                                                <img class="rounded-circle" width="50" height="50" src="{{asset('storage/'.Auth::user()->photoDB)}}" alt="">

                                              
                                                    <div class="msg-text text-dark">
                                                        {{$ticket->note_admin}}
                                                    </div>
                                                </div>
                                            </div>
                                        </main>
                                    </section>

                                    <textarea type="text" rows="5" id="note_admin" placeholder="En este campo estara la nota que deja el administrador que atendio su orden" class="form-control" name="note_admin">{{$ticket->note_admin}}</textarea>


                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary d-inline-block float-right mb-1 waves-effect waves-light mt-2">Enviar
                                </button>
                            </div>
                        </form>

                        <script>


                        </script>

                        <style>
                            .msger {
                                display: flex;
                                flex-flow: column wrap;
                                justify-content: space-between;
                                width: 100%;
                                max-width: 867px;
                                margin: 25px 10px;
                                height: calc(100% - 50px);
                                border: var(--border);
                                border-radius: 5px;
                                background: var(--msger-bg);
                                box-shadow: 0 15px 15px -5px rgba(0, 0, 0, 0.2);
                            }

                            .msger-header {
                                display: flex;
                                justify-content: space-between;
                                padding: 10px;
                                border-bottom: var(--border);
                                background: #eee;
                                color: #666;
                            }

                            .msger-chat {
                                flex: 1;
                                overflow-y: auto;
                                padding: 10px;
                            }

                            .msger-chat::-webkit-scrollbar {
                                width: 6px;
                            }

                            .msger-chat::-webkit-scrollbar-track {
                                background: #ddd;
                            }

                            .msger-chat::-webkit-scrollbar-thumb {
                                background: #bdbdbd;
                            }

                            .msg {
                                display: flex;
                                align-items: flex-end;
                                margin-bottom: 10px;
                            }

                            .msg:last-of-type {
                                margin: 0;
                            }

                            .msg-img {
                                width: 50px;
                                height: 50px;
                                margin-right: 10px;
                                background: #ddd;
                                background-repeat: no-repeat;
                                background-position: center;
                                background-size: cover;
                                border-radius: 50%;
                            }

                            .msg-bubble {
                                max-width: 450px;
                                padding: 15px;
                                border-radius: 15px;
                                background: var(--left-msg-bg);
                            }

                            .msg-info {
                                display: flex;
                                justify-content: space-between;
                                align-items: center;
                                margin-bottom: 10px;
                            }

                            .msg-info-name {
                                margin-right: 10px;
                                font-weight: bold;
                            }

                            .msg-info-time {
                                font-size: 0.85em;
                            }

                            .left-msg .msg-bubble {
                                border-bottom-left-radius: 0;
                            }

                            .right-msg {
                                flex-direction: row-reverse;
                            }

                            .right-msg .msg-bubble {
                                background: var(--right-msg-bg);
                                color: #fff;
                                border-bottom-right-radius: 0;
                            }

                            .right-msg .msg-img {
                                margin: 0 0 0 10px;
                            }

                            .msger-inputarea {
                                display: flex;
                                padding: 10px;
                                border-top: var(--border);
                                background: #eee;
                            }

                            .msger-inputarea * {
                                padding: 10px;
                                border: none;
                                border-radius: 3px;
                                font-size: 1em;
                            }

                            .msger-input {
                                flex: 1;
                                background: #ddd;
                            }

                            .msger-send-btn {
                                margin-left: 10px;
                                background: rgb(0, 196, 65);
                                color: #fff;
                                font-weight: bold;
                                cursor: pointer;
                                transition: background 0.23s;
                            }

                            .msger-send-btn:hover {
                                background: rgb(0, 180, 50);
                            }
                        </style>



</section>

@endsection