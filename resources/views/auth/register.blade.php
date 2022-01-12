@extends('layouts.authentication.master')
@section('title', 'Registro')

@section('css')
@endsection

@section('style')
<style>
   .container i {
      margin-left: -30px;
      cursor: pointer;
}
</style>
@endsection


@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="login-card">
               <div>
                  <div><a class="logo"
                        href="{{ route('login') }}"><img class="img-fluid for-light"
                           src="{{asset('logo.jpeg')}}" style="height: 200px;"
                           alt="looginpage"></a></div>
                  <div class="login-main">
                     <form class="theme-form" action="/register" method="POST">
                        @csrf
                        <h4>Crea tu cuenta</h4>
                        <p>Ingresa tu información personal</p>
                        <div class="form-group">
                           <label class="col-form-label pt-0">Nombre</label>
                           <div class="form-row">
                              <div class="col-12">
                                 <input class="form-control"
                                    type="text"
                                    required=""
                                    name="name"
                                    placeholder="Nombre">
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-form-label">Correo</label>
                           <input class="form-control"
                              type="email"
                              required=""
                              name="email"
                              placeholder="example@gmail.com">
                        </div>
                        <div class="form-group">
                           <label class="col-form-label">Password</label>
                           <label class="text-red" style="color: red; font-size:12px">&nbsp;&nbsp;*Al menos 8 caracteres*</label>
                           <input class="form-control"
                              id="password"
                              type="password"
                              name="password"
                              minlength="8"
                              required=""
                              placeholder="*********">
                           <div class="show-hide">
                              <i class="far fa-eye" id="togglePassword"></i>
                           </div>
                        </div>
                        <div class="form-group mb-0">
                           {{-- <div class="checkbox p-0">
                           <input id="checkbox1" type="checkbox">
                           <label class="text-muted" for="checkbox1">Aceptar<a class="ml-2" href="#">Politica de privacidad</a></label>
                        </div> --}}
                           <button class="btn btn-primary btn-block"
                              type="submit">Crear tu cuenta</button>
                        </div>
                        <p class="mt-4 mb-0">¿Ya tienes cuenta?<a class="ml-2"
                              href="{{ route('login') }}">Inicia
                              Sesión</a></p>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection

@section('script')
<script>
   const togglePassword = document.querySelector('#togglePassword');
   const password = document.querySelector('#password');

   togglePassword.addEventListener('click', function (e) {
   // toggle the type attribute
   const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
   password.setAttribute('type', type);
   // toggle the eye slash icon
   this.classList.toggle('fa-eye-slash');
});
</script>
@endsection
