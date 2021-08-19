@extends('layouts.dashboard')

@section('content')


<div class="row">
    <div class="col-md-8">
        <h1 class="text-white">Atendiendo el Ticket #{{ $ticket->id}}</h1>
    </div>
    <div class="col-6 col-md-4">
        <a id="boton-ticket" href="{{ route('ticket.list-admin')}}" class="btn  mb-2 waves-effect waves-light">Volver Atrás <i class="fas fa-chevron-left"></i></a>
    </div>
</div>
 
<br>

<section id="basic-vertical-layouts">
    <div class="row match-height d-flex justify-content-center">
        <div class="col-md-12 col-12">
            <div class="card"  style="background: linear-gradient(180deg, #0F1522 0%, rgba(15, 21, 34, 0) 100%);
border-radius: 8px;">

                <div class="card-content">
                    <div class="card-body">
                        <form action="{{route('ticket.update-admin', $ticket->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row">

                            <div class="row">
                                <div class="col-6">
                                    <label id="form-label" class="form-label" for="name"><b>Nombre</b></label>
                                    <input class=" form-control" required type="text" id="names" name="name" value="{{$ticket->getUser->fullname}}" rows="3" disabled />

                                </div>

                                

                                <div class="col-6">
                                    <div class="form-group">
                                    <label id="form-label" class="form-label" for="issue"><b>Sujeto</b></label>
                                        <input type="text" id="issues" readonly class="form-control" value="{{ $ticket->issue}}" name="asunto">
                                    </div>
                                </div>

                                <div class="col-6">
                                        <label id="form-label" class="form-label" for="email"><b>Direccion de correo electrónico</b></label>
                                        <input class="form-control" value="{{$ticket->getUser->email}}" required type="text" id="emails" name="email" rows="3" disabled/>

                                    </div>


                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="controls">
                                        <label id="form-label" class="form-label" for="status"><b>Estado del ticket</b></label>
                                            <select style="border: 2px solid rgba(0, 246, 225, 0.77);background: rgba(196, 196, 196, 0.08);color:#fff;cursor:pointer; " name="status" id="status" class="custom-select status form-control @error('status') is-invalid @enderror" required data-toggle="select">
                                                <option value="0" @if($ticket->status == '0') selected
                                                    @endif>Abierto</option>
                                                <option value="1" @if($ticket->status == '1') selected
                                                    @endif>Cerrado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 mt-2 mb-2">
                                    <label class="form-label " id="form-label" for="note"><b>Chat con el usuario</b></label>

                                    <section class="chat-app-window mb-2" style="border: 2px solid rgba(0, 246, 225, 0.77);" >
                                        <div class="active-chat">
                                            <div class="user-chats ps ps--active-y ">
                                                <div class="chats chat-thread">

                                                    <div class="chat">
                                                        <div class="chat-avatar">
                                                            <span class="avatar ">
                                                                <img src="{{asset('assets/img/sistema/favicon.png')}}" alt="avatar" height="40" width="40" style="background-color: black;">


                                                            </span>
                                                        </div>
                                                        <div class="chat-body" id="form-labels">
                                                            <div class="chat-content">

                                                                <div class="email-admin mb-1">{{ $admin }}</div>
                                                                <p>¿Cómo podemos ayudarle? </p>
                                                                <p> </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @foreach ( $message as $item )


                                                    {{-- user --}}

                                                    @if ($item->type == 0)

                                                    <div class="chat chat-left">
                                                        <div class="chat-avatar">
                                                            <span class="avatar">
                                                                @if (Auth::user()->photoDB != NULL)

                                                                <img src="{{asset('storage/'.Auth::user()->photoDB)}}" alt="avatar" height="40" width="40">
                                                                @else


                                                                <img src="{{asset('assets/img/sistema/favicon.png')}}" alt="avatar" height="40" width="40" style="background-color: black;">
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="chat-body" id="form-labels">
                                                            <div class="chat-content">
                                                                <div class="email-user mb-1">{{ $item->getUser->email}}</div>
                                                                <p>{{ $item->message }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- admin --}}
                                                    @elseif ($item->type == 1)
                                                    <div class="chat">
                                                        <div class="chat-avatar">
                                                            <span class="avatar ">
                                                                <img src="{{asset('assets/img/sistema/favicon.png')}}" alt="avatar" height="40" width="40" style="background-color: black;" alt="avatar" height="40" width="40">


                                                            </span>
                                                        </div>
                                                        <div class="chat-body" id="form-labels">
                                                            <div class="chat-content">

                                                                <div class="email-admin mb-1">{{ $item->getAdmin->email}}</div>
                                                                <p>{{ $item->message }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <span class="text-bold-600" id="form-labels" >Respuesta para el usuario</span>
                                    <textarea id="names" class="form-control  chat-window-message" required type="text" id="message" name="message"></textarea>
                                </div>

                            </div>

                            <div class="col-12">
                                <button type="submit" id="send" class="col-12 btn mb-1 waves-effect waves-light float-right">Enviar
                                    Ticket</button>
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