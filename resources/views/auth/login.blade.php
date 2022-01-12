@extends('layouts.authentication.master')
@section('title', 'Login')

@section('css')
@endsection

@section('style')
@endsection


@section('content')
<div class="container-fluid">
   @if(session('error'))
   <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
      </button>
   </div>
   @endif
   <div class="row">
      <div class="col-12">
         <div class="login-card">
            <div>
               <div><a class="logo" href="{{ route('login') }}"><img class="img-fluid for-light" src="{{asset('logo.jpeg')}}" style="height: 200px;" alt=""></a></div>
               <div class="login-main">
                  <form class="theme-form" class="form-group" action="/login" method="post">
                     @csrf
                     <h4>Inicia Sesión</h4>
                     <p>Ingresa con tu usuario y contraseña</p>
                     <div>
                        <label class="col-form-label">Correo</label>
                        <input class="form-control" type="email" required="" name="email" placeholder="usuario@gmail.com">
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Contraseña</label>
                        <input class="form-control" type="password" id="login[password]" name="password" required="" placeholder="*********">

                     </div>
                     <div class="form-group mb-0">
                        {{-- <div class="checkbox p-0">
                           <input id="checkbox1" type="checkbox">
                           <label class="text-muted" for="checkbox1">Remember password</label>
                        </div> --}}
                        {{-- <a class="link" href="{{ route('forget-password') }}">Forgot password?</a> --}}
                        <button class="btn btn-primary btn-block" type="submit">iniciar sesion</button>
                     </div>
                     {{-- <h6 class="text-muted mt-4 or">Or Sign in with</h6>
                     <div class="social mt-4">
                        <div class="btn-showcase"><a class="btn btn-light" href="https://www.linkedin.com/login" target="_blank"><i class="txt-linkedin" data-feather="linkedin"></i> LinkedIn </a><a class="btn btn-light" href="https://twitter.com/login?lang=en" target="_blank"><i class="txt-twitter" data-feather="twitter"></i>twitter</a><a class="btn btn-light" href="https://www.facebook.com/" target="_blank"><i class="txt-fb" data-feather="facebook"></i>facebook</a></div>
                     </div> --}}
                     <!-- <p class="mt-4 mb-0">¿No tienes cuenta?<a class="ml-2" href="{{  route('register') }}">Crear una cuenta</a></p> -->
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
@endsection