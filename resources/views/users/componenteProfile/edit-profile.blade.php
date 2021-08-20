<form action="{{ route('profile.update',$user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')


    <style>
        #id {
            background: rgba(196, 196, 196, 0.08);
            border: 2px solid rgba(0, 246, 225, 0.77);
            box-sizing: border-box;
            border-radius: 4px;
            color: #fff;
            font-size: 12px;
        }
    </style>

    <div class="row">
        <div class="col-12 ">
            <div class="form-group">
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <div class="controls">
                    <label class="required" id="form-label" for="">Nombre<span style="color: red;"> *</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="names" name="name" placeholder="Nombre" value="{{ $user->name }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>


        <div class="col-6">
            <div class="form-group">
                <div class="controls">
                    <label class="required" id="form-label" for="last_name">Apellido<span style="color: red;"> *</span></label>
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="names" name="last_name" placeholder="Apellido" value="{{ $user->last_name }}">
                    @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <div class="controls">
                    <label class="required" id="form-label" for="email">Correo Electrónico<span style="color: red;"> *</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="names" name="email" placeholder="Email" value="{{$user->email}}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <div class="controls">
                    <label class="required" id="form-label" for="whatsapp">Número Móvil<span style="color: red;"> *</span></label>

                    <input type="text" id="names" class="form-control @error('whatsapp') is-invalid @enderror" name="whatsapp" value="{{$user->whatsapp}}" placeholder="whatsapp">
                    @error('whatsapp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>

        <!--<div class="col-12">
            <div class="form-group">
                <label for="account-api">Billetera</label>
                <input type="text" id="account-api" class="form-control" placeholder="wallet_address" name="wallet_address" value="{{ $user->wallet_address }}">
            </div>
        </div>
    </div>-->

    </div>
    </div>

    <div class="media">
        <div class="custom-file mt-1">
            <label class="custom-file-label" id="id" for="photoDB">Seleccione su
                Foto <b>(Se permiten JPG o PNG.
                    Tamaño máximo de 800kB)</b></label>
            <input type="file" id="photoDB" class="custom-file-input @error('photoDB') is-invalid @enderror" name="photoDB" onchange="previewFile(this, 'photo_preview')" accept="image/*">
            @error('photoDB')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <br>


    <div class="container">
        <div class="row align-items-start">
            <div class="col-4">
                <label class="required" id="form-label" for="whatsapp">Ciudad</label>
                <input id="names" type="text" class="form-control @error('city') is-invalid @enderror" name="city" autocomplete="city" autofocus placeholder="" value="{{ old('city') }}">

                @error('city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="col-4">
                <label class="required" id="form-label" for="whatsapp">Estado</label>
                <input id="names" type="text" class=" form-control @error('state') is-invalid @enderror" name="state" autocomplete="state" autofocus placeholder="" value="{{ old('state') }}">

                @error('state')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>



            <div class="col-4">
                <label class="required" id="form-label" for="whatsapp">País</label>
                <select id="names" type="text" class="form-control @error('country') is-invalid @enderror" name="country" required autocomplete="country" autofocus>
                    <option selected disabled readonly>País</option>
                    {{--@foreach($countries as $country)--}}
                    <option value="{{--{{$country->id}}--}}">{{--{{$country->name}}--}}</option>
                    {{--@endforeach--}}


                </select>

                @error('country')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>


        <div class="col-12  justify-content-start mt-2 mb-2">
            <button type="submit" id="send" class="btn  col-12 mr-sm-1  waves-effect waves-light">GUARDAR</button>
        </div>

        <hr style="color: red;">
        
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <div class="controls">
                            <p id="form-label" style="font-size: 18px;">Cambiar la Contraseña : </p>
                        </div>
                    </div>
                </div>

            </div>
</form>

