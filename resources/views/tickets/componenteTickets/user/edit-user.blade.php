@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-8">
        <h1 class="text-white">Editando el Ticket #{{ $ticket->id}}</h1>
    </div>
    <div class="col-6 col-md-4">
        <a id="boton-ticket" href="{{ route('ticket.list-user')}}" class="btn  mb-2 waves-effect waves-light">Volver Atrás <i class="fas fa-chevron-left"></i></a>
    </div>
</div>


<section>

    <div class="row match-height d-flex justify-content-center">
        <div class="col-md-12 col-12">
            <div class="card" style="background: linear-gradient(180deg, #0F1522 0%, rgba(15, 21, 34, 0) 100%);
border-radius: 8px;">
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{route('ticket.update-user', $ticket->id)}}" method="POST">
                            @csrf
                            @method('PATCH')


                            <div class="col-12 mt-1">
                                <label id="form-label" class="form-label mb-1" for="issue"><b>Sujeto</b></label>
                                <input class="form-control" type="text" id="names" name="issue" value="{{ $ticket->issue }}" rows="3" disabled />

                            </div>


                            <div class="col-12 mt-2 mb-2">
                                <label id="form-label" class="form-label  mb-1" for="message"><b>Chat con el
                                        administrador</b></label>

                                <section class="chat-app-window mb-2" style="border: 2px solid rgba(0, 246, 225, 0.77);">
                                    <div class="active-chat">
                                        <div class="user-chats ps ps--active-y ">
                                            <div class="chats chat-thread">




                                                @foreach ( $message as $item )

                                                {{-- user --}}
                                                @if ($item->type == 0)
                                                <div class="chat text-white">
                                                    <div class="chat-avatar">
                                                        <span class="avatar ">
                                                            @if (Auth::user()->photoDB != NULL)
                                                            <img src="{{asset('storage/'.Auth::user()->photoDB)}}" alt="avatar" height="40" width="40">
                                                            @else
                                                            <img src="{{asset('assets/img/sistema/favicon.png')}}" alt="avatar" height="40" width="40" style="background-color: black;">
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="chat-body " id="form-labels">
                                                        <div class="chat-content">
                                                            <div class="email-user mb-1">{{ $item->getUser->email}}</div>

                                                            <p>{{ $item->message }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- admin --}}
                                                @elseif ($item->type == 1)
                                                <div class="chat chat-left">
                                                    <div class="chat-avatar">
                                                        <span class="avatar ">
                                                            <img src="{{asset('assets/img/sistema/favicon.png')}}" alt="avatar" height="40" width="40" style="background-color: black;">
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

                                <span id="form-labels" class="text-bold-600">Respuesta</span>
                                <textarea id="names" class="text-tex form-control" type="text" id="message" name="message" required rows="3"></textarea>
                            </div>

                    </div>

                    <div class="col-12">
                        <button id="send" type="submit" class="col-12 btn  mb-1 waves-effect waves- float-right">Actualizar
                            Ticket</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    </div>
</section>


@endsection