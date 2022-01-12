@extends('layouts.light.master')
@section('title', 'Sample Page')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3> <img src="https://img.icons8.com/emoji/35/000000/waving-hand-light-skin-tone.png" /> Bienvenido {{Auth::user()->name}} </h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Ingreso</li>
<li class="breadcrumb-item active">Panel</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row pt-2">
      <div class="card text-center col-6">
         <div class="card-body">
            <h5 class="card-title">Clientes</h5>
            <h6 class="card-subtitle text-muted">
               <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                  <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                  <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" />
                  <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
               </svg>
               {{$activeClients}} Registrados
            </h6>
            <p class="card-text p-y-1">
               <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                  <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
               </svg>
               {{$inactiveClients}} inactivos
            </p>
         </div>
      </div>
      <div class="card text-center col-6">
         <div class="card-body">
            <h5 class="card-title">Total en atrasos</h5>
            <h6 class="card-subtitle text-muted">
               <img src="https://img.icons8.com/small/20/000000/us-dollar.png" />
               {{$latest}}
            </h6>
         </div>
      </div>
      <div class="card text-center col-6">
         <div class="card-body">
            <h5 class="card-title">Créditos</h5>
            <h6 class="card-subtitle text-muted">
               <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 172 172" style=" fill:#000000;">
                  <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                     <path d="M0,172v-172h172v172z" fill="none"></path>
                     <g fill="#666666">
                        <path d="M145.43294,37.93294l-80.93294,80.93295l-30.76628,-30.76628l-10.13411,10.13411l40.90039,40.90039l91.06706,-91.06705z"></path>
                     </g>
                  </g>
               </svg>
               {{$authorizedCredits}} Autorizados
            </h6>
            <p class="card-text p-y-1">
               <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 24 24" style=" fill:#000000;">
                  <path d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z"></path>
               </svg>
               {{$unauthorizedCredits}} Rechazados
            </p>
         </div>
      </div>
      <div class="card text-center col-6">
         <div class="card-body">
            <h5 class="card-title">Total en abonos (Hoy)</h5>
            <h6 class="card-subtitle text-muted">
               <img src="https://img.icons8.com/small/20/000000/us-dollar.png" />
               {{$totalPaysOfDay}}
            </h6>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
@endsection