@extends('layouts.dashboard')

@section('content')

<section id="basic-vertical-layouts">
    <div class="row match-height d-flex justify-content-center">
        <div class="col-md-9 col-12">
            <div class="card bg-lp">

                <div class="card-header">
                    <h4 class="card-title">Atendiendo el Ticket #{{ $ticket->id}}</h4>
                    <h4 class="card-title mt-2 ">Usuario: <span class="text-primary">{{ $ticket->getUser->fullname}}</span></h4>
                </div>

                <div class="card-content">
                    <div class="card-body">
                        <form action="{{route('ticket.update-admin', $ticket->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row">


                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="">Asunto del Ticket</label>
                                        <textarea type="text" readonly id="asunto" class="form-control bg-lp border  rounded-0" name="asunto">{{ $ticket->issue}}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="status" class="">Estado del Ticket</label>
                                            <span class="text-danger text-bold-600">OBLIGATORIO</span>
                                            <select name="status" id="status" class="custom-select status form-control bg-lp border  rounded-0 @error('status') is-invalid @enderror" required data-toggle="select">
                                                <option value="0" @if($ticket->status == '0') selected
                                                    @endif>Abierto</option>
                                                <option value="1" @if($ticket->status == '1') selected
                                                    @endif>Cerrado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="priority">Prioridad del
                                                Ticket</label>

                                            <span class="text-danger text-bold-600">OBLIGATORIO</span>

                                            <select name="priority" id="priority" class="custom-select priority form-control bg-lp border  rounded-0 @error('priority') is-invalid @enderror" required data-toggle="select">

                                                <option value="0" @if($ticket->priority == '0') selected
                                                    @endif>Alto</option>
                                                <option value="1" @if($ticket->priority == '1') selected
                                                    @endif>Medio</option>
                                                <option value="2" @if($ticket->priority == '2') selected
                                                    @endif>Bajo</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-2 mb-2">
                                    <label class="form-label text-white" for="note"><b>Chat con el usuario</b></label>

                                    <section class="chat-app-window mb-2 border rounded-0">
                                        <div class="active-chat">
                                            <div class="user-chats ps ps--active-y bg-lp">
                                                <div class="chats chat-thread">

                                                    <div class="chat">
                                                        <div class="chat-avatar">
                                                            <span class="avatar ">
                                                                @if (Auth::user()->photoDB != NULL)
                                                                <img src="{{asset('storage/photo/'.Auth::user()->photoDB)}}" alt="avatar" height="36" width="36">
                                                                @else
                                                                <img src="{{ asset('assets/img/legazy_pro/logo.svg') }}" alt="avatar" height="40" width="40">
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content">
                                                            <div class="email-admin mb-1">Imnoteverywhere12@gmail.com</div>
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
                                                                <img src="{{ asset('assets/img/legazy_pro/logo.svg') }}" alt="avatar" height="40" width="40">
                                                            </span>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content">
                                                            <div class="email-user mb-1">Imnoteverywhere12@gmail.com</div>
                                                                <p>{{ $item->message }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- admin --}}
                                                    @elseif ($item->type == 1)
                                                    <div class="chat">
                                                        <div class="chat-avatar">
                                                            <span class="avatar ">
                                                                @if (Auth::user()->photoDB != NULL)
                                                                <img src="{{asset('storage/photo/'.Auth::user()->photoDB)}}" alt="avatar" height="36" width="36">
                                                                @else
                                                                <img src="{{ asset('assets/img/legazy_pro/logo.svg') }}" alt="avatar" height="40" width="40">
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content">
                                                            <div class="email-admin mb-1">Imnoteverywhere12@gmail.com</div>
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

                                    <span class="text-danger text-bold-600">Respuesta para el usuario</span>
                                    <textarea class="form-control border rounded-0 chat-window-message" required type="text" id="message" name="message"></textarea>
                                </div>

                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light float-right">Enviar
                                    Ticket</button>
                            </div>
                    </div>
                    </form>

                </div>
            </div>
            <style>
                /*Responsive*/
                @import "https://fonts.googleapis.com/css?family=Noto+Sans";

                ::-webkit-scrollbar {
                    width: 10px;
                }

                ::-webkit-scrollbar-track {
                    border-radius: 10px;
                    background-color: rgba(27, 27, 27, 0.727);
                }

                ::-webkit-scrollbar-thumb {
                    border-radius: 10px;
                    background-color: #D6A83E;
                }

                .email-user {
                    font-weight: 600;
                    display: flex;
                    flex-direction: row-reverse;

                }
                .email-admin{
                    font-weight: 600;
                    display: flex;

                }
               

                .chat-thread {
                    margin: 24px auto 0 auto;
                    padding: 0 20px 0 0;
                    list-style: none;
                    overflow-y: scroll;
                    overflow-x: hidden;
                }

                /* Small screens */
                @media all and (max-width: 767px) {
                    .chat-thread {
                        width: 90%;
                        height: 260px;
                    }

                }

                /* Medium and large screens */
                @media all and (min-width: 768px) {
                    .chat-thread {
                        /* width: 50%; */
                        height: 320px;
                    }
                }

                /*FIN DEL RESPONSIVE*/

                .chat-app-window .user-chats {
                    padding: 1rem;
                    position: relative;
                    height: calc(100% - 65px - 65px)
                }

                .chat-app-window .active-chat {
                    height: inherit
                }

                .chat-app-window .active-chat .chat-header {
                    display: -webkit-box;
                    display: -webkit-flex;
                    display: -ms-flexbox;
                    display: flex;
                    -webkit-box-pack: justify;
                    -webkit-justify-content: space-between;
                    -ms-flex-pack: justify;
                    justify-content: space-between;
                    height: 65px;
                    padding: 0 1rem;
                }

                .chat-app-window .chats .chat-avatar {
                    float: right
                }

                .chat-app-window .chats .chat-body {
                    display: block;
                    margin: 10px 30px 0 0;
                    overflow: hidden
                }

                .chat-app-window .chats .chat-body .chat-content {
                    float: right;
                    padding: .7rem 1rem;
                    margin: 0 1rem 10px 0;
                    clear: both;
                    border-radius: .357rem;
                    max-width: 75%
                }

                .chat-app-window .chats .chat-body .chat-content p {
                    margin: 0
                }

                .chat-app-window .chats .chat-left .chat-avatar {
                    float: left
                }

                .chat-app-window .chats .chat-left .chat-body .chat-content {
                    float: left;
                    margin: 0 0 10px 1rem;

                }

                .chat-app-window .chat-app-form {
                    height: 65px;
                    padding: 0 1rem;
                    display: -webkit-box;
                    display: -webkit-flex;
                    display: -ms-flexbox;
                    display: flex;
                    -webkit-box-align: center;
                    -webkit-align-items: center;
                    -ms-flex-align: center;
                    align-items: center;
                }

                .chat-widget .card-header {
                    padding-top: .8rem;
                    padding-bottom: .8rem
                }

                .chat-widget .chat-app-window .user-chats {
                    height: 390px
                }

                .chat-widget .chat-app-window .chat-app-form {
                    border-top: 0;
                    border-bottom-left-radius: .357rem;
                    border-bottom-right-radius: .357rem;
                    height: 56px
                }

                .chat-widget .chat-app-window .chat-app-form .input-group-text,
                .chat-widget .chat-app-window .chat-app-form .message {
                    border: 0;
                    padding-left: 0
                }

                .chat-widget .chat-app-window .chat-app-form .input-group:not(.bootstrap-touchspin):focus-within {
                    box-shadow: none
                }
            </style>
        </div>
    </div>
    </div>
</section>

@endsection