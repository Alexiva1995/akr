@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-8">
        <h1 class="text-white">Tickets de Soporte</h1>
    </div>
    <div class="col-6 col-md-4">
        <a id="boton-ticket" href="{{ route('ticket.list-user')}}" class="btn  mb-2 waves-effect waves-light">Volver Atrás <i class="fas fa-chevron-left"></i></a>
    </div>
</div>


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
                                        <input class=" form-control" required type="text" id="names" name="name" rows="3" />

                                    </div>

                                    <div class="col-6">
                                        <label id="form-label" class="form-label" for="email"><b>Direccion de correo electrónico</b></label>
                                        <input class="form-control" required type="text" id="emails" name="email" rows="3" />

                                    </div>



                                    <div class="col-12">
                                        <label id="form-label" class="form-label mt-2" for="issue"><b>Sujeto</b></label>
                                        <input class="form-control" required type="text" id="issues" name="issue" rows="3" />

                                    </div>


                                    <div class="col-12 mt-2 mb-2">
                                        <label id="form-label" class="form-label  mb-1" for="message"><b>Mensaje</b></label>


                                        <section class="chat-app-window mb-2" style="border: 2px solid rgba(0, 246, 225, 0.77);">
                                            <div class="active-chat">
                                                <div class="user-chats ps ps--active-y">
                                                    <div class="chats chat-thread">

                                                        {{-- admin --}}
                                                        <div class="chat chat-left">
                                                            <div class="chat-avatar">
                                                                <span class="avatar ">
                                                                    <img src="{{asset('assets/img/sistema/favicon.png')}}" alt="avatar" height="40" width="40" style="background-color: black;">
                                                                </span>
                                                            </div>
                                                            <div class="chat-body text-white">
                                                                <div class="chat-content">
                                                                    <div class="email-admin mb-1">{{$admin}}</div>
                                                                    <p>¿Cómo podemos ayudarle? </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>

                                        <br>
                                        <span id="form-labels" class=" text-bold-600">Escriba Su Pregunta</span>
                                        <textarea id="names" class="form-control chat-window-message" type="text" id="message" name="message" required rows="3"></textarea>
                                    </div>


                                    <div class="col-12">
                                        <button type="submit" id="send" class="col-12 btn  mr-1 mb-1 waves-effect waves-light">Enviar
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