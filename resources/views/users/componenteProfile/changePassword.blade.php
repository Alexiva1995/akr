<div class="container">
    <div class="row justify-content-center">
       
                <div class="card-body">
                    <form method="POST" action="{{ route('change.password') }}">
                        @csrf
                        @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                        @endforeach

                        <div class="form-group row ">
                            <label for="password" id="form-label" class="col-md-4 col-form-label text-md-right">Contraseña Actual</label>
                            <div class="col-md-6">
                                <input id="names" type="password" class="form-control" name="current_password" autocomplete="current-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label id="form-label" for="password" class="col-md-4 col-form-label text-md-right">Nueva Contraseña</label>
                            <div class="col-md-6">
                                <input id="names" type="password" class="form-control" name="new_password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label id="form-label" for="password" class="col-md-4 col-form-label text-md-right">Confirme la Contraseña</label>
                            <div class="col-md-6">
                                <input id="names" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12">
                                <button type="submit" id="send" class="col-12 btn ">
                                    Actualizar Contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
      
   