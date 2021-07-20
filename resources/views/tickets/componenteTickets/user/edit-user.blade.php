@extends('layouts.dashboard')

@section('content')


<section id="basic-vertical-layouts">
    <div class="row match-height d-flex justify-content-center">
        <div class="col-md-9 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Editando el Ticket #{{ $ticket->id}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{route('ticket.update-user', $ticket->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-body">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>titulo del Ticket</label>
                                            <input type="text" id="issue" class="form-control" value="{{ $ticket->issue }}" name="issue">
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

                                   
                                    <section class="container">
                                        <header class="header">

                                            <div class="msger-header-options">
                                                <span><i class="fas fa-cog"></i></span>
                                            </div>
                                        </header>

                                        <main class="msger-chat">
                                            <div class="msg left-msg">
                                                <img class="rounded-circle" width="50" height="50" src="{{asset('storage/'.Auth::user()->photoDB)}}" alt="">

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
                                                        <div class="msg-info-name text-dark" id="email">{{ $ticket->email}}</div>
                                                    </div>

                                            <div class="msg right-msg">
                                                <img id="foto" class="rounded-circle" width="50" height="50" src="{{asset('storage/'.Auth::user()->photoDB)}}" alt="">

                                              
                                                    <div  class="msg-text text-dark" id="text">
                                                        {{$ticket->note_admin}}
                                                    </div>
                                                </div>
                                            </div>
                                        </main>
                                    </section>

                                    <textarea  type="text" rows="5" id="" class="form-control" name="description"></textarea>

                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary d-inline-block float-right mb-1 waves-effect waves-light mt-2">Actualizar Ticket
                                </button>
                            </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    <style>

        #text{
            margin-right:15px;
            margin-bottom:15px;
        }

    #email{
        margin-left: 22em;
    }
        .container {
            display: flex;
            flex-flow: column wrap;
            width: 100%;
            max-width: 867px;
            margin: 25px 10px;
            height: calc(100% - 50px);
            border: var(--border);
            border-radius: 5px;
            background: var(--msger-bg);
            box-shadow: 0 15px 15px -5px rgba(0, 0, 0, 0.2);
        }

        .header {
            display: flex;
            padding: 10px;
            border-bottom: var(--border);
            background: #eee;
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

       

        .msg-bubble {
            max-width:700px;
            padding: 15px;
            border-radius: 15px;
        }

        .msg-info {
            display: flex;
            margin-bottom: 10px;
        }

        .msg-info-name {
            font-weight: bold;
        }

        
     
        .right-msg {
            flex-direction: row-reverse;

        }


    </style>
    </div>
    </div>
</section>

@endsection