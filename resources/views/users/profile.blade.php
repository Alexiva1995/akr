@extends('layouts.dashboard')

@push('vendor_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/core/colors/palette-gradient.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/plugins/forms/validation/form-validation.css')}}">
@endpush

@push('page_vendor_js')
<script src="{{asset('assets/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/extensions/dropzone.min.js')}}"></script>
@endpush

@push('custom_js')
<script>
    $(document).ready(function() {
        @if($user -> photoDB !== NULL)
        previewPersistedFile("{{asset('storage/'.$user->photoDB)}}", 'photo_preview2');
        @endif
    });



    function previewFile(input, preview_id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#" + preview_id).attr('src', e.target.result);
                $("#" + preview_id).css('height', '200px');
                $("#" + preview_id).parent().parent().removeClass('d-none');
            }
            $("label[for='" + $(input).attr('id') + "']").text(input.files[0].name);
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewPersistedFile(url, preview_id) {
        $("#" + preview_id).attr('src', url);
        $("#" + preview_id).css('height', '200px');
        $("#" + preview_id).parent().parent().removeClass('d-none');

    }
</script>

<script src="{{asset('assets/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('assets/app-assets/js/core/app.js')}}"></script>
<script src="{{asset('assets/app-assets/js/scripts/components.js')}}"></script>
@endpush

@section('content')

<style>
    #background {
        background: #0F1522;
        border-radius: 8px;
        max-height: 380px;
    }

    .list-group-item {
        border: 2px solid rgba(0, 246, 225, 0.77);
        box-sizing: border-box;
        background: #0F1522;
        border-radius: 1px;
        color: #FFFFFF;

    }

    #background2 {
        background: #0F1522;
        border-radius: 8px;
    }
</style>
<div class="col-12">
<div class="container">
    <div class="row">
        <div class="col-9">
            <h1 class="text-white">Perfil</h1>
        </div>

        <div class="col-3">
        <button class="btn" id="IDref" onclick="getlink()">ID de
                referido: {{ Auth::user()->id }} <i class="fa fa-link"></i>
            </button>
        </div>
    </div>
</div>
        
<br>
<div class="app-content">
    <div class="content-overlay"></div>
    <div class=""></div>

    <div class="content-body">
        <section id="page-account-settings">
            <div class="row">
                <!-- left menu section -->

                <div class="card ml-2" id="background">
                    <div class="d-flex justify-content-center mt-2">
                        <img id="photo_preview2" class=" " />
                    </div>

                    <div class="card-body">
                        <ul class="col">
                            <li class="list-group-item ">Nombre : {{ $user->fullname }}</li>
                            <li class="list-group-item">Nombre de usuario : {{$user->name}}</li>
                            <li class="list-group-item">Se unió el : {{date('d-M-Y', strtotime($user['created_at']))}}</li>

                        </ul>
                    </div>
                </div>

                <!-- right content section -->
                <div class="col-md-7 float-right ml-5 ">
                    <div class="card" id="background2">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="tab-content">

                                  
                                        @include('users.componenteProfile.edit-profile')

                                    </div>

                                        @include('users.componenteProfile.changePassword')

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
</div>
</div>
@endsection