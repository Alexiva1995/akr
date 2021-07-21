@extends('layouts.dashboard')

@section('content')


<section id="basic-vertical-layouts">
    <div class="row match-height d-flex justify-content-center">
        <div class="col-md-9 col-12">
            <div class="card bg-lp">
                <div class="card-header">
                    <h4 class="card-title ">Creacion de Ticket</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{route('ticket.store')}}" method="POST">
                            @csrf
                            <div class="form-body">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label  mb-1" for="issue"><b>Asunto del
                                                ticket</b></label>
                                        <input class="form-control border  rounded-0" required type="text" id="issue" name="issue" rows="3" />

                                    </div>

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

                                    <div class="col-12 mt-2 mb-2">
                                        <label class="form-label  mb-1" for="message"><b>Chat con el
                                                administrador</b></label>

                                        <section class="chat-app-window mb-2 border rounded-0">
                                            <div class="active-chat">
                                                <div class="user-chats ps ps--active-y bg-lp">
                                                    <div class="chats chat-thread">

                                                        {{-- admin --}}
                                                        <div class="chat chat-left">
                                                            <div class="chat-avatar">
                                                                <span class="avatar ">
                                                                    <img src="{{asset('assets/img/sistema/favicon.png')}}" alt="avatar" height="40" width="40" style="background-color: white;">
                                                                </span>
                                                            </div>
                                                            <div class="chat-body">
                                                                <div class="chat-content">
                                                                    <p>¿Cómo Podemos ayudarle? </p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </section>

                                        <br>
                                        <span class="text-danger text-bold-600">Aqui podra escribir el mensaje para el admin</span>
                                        <textarea class="form-control border  rounded-0 chat-window-message" type="text" id="message" name="message" required rows="3"></textarea>
                                    </div>


                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Enviar
                                            Ticket</button>
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

                .email-admin {
                    position: absolute;
                    font-weight: 600;

                }

                .email-user {
                    position: absolute;
                    font-weight: 600;

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
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>



@endsection