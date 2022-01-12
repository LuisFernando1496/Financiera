@extends('layouts.light.master')
@section('title', 'Layout Light')
@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Clientes</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Listado</li>
<li class="breadcrumb-item active">Clientes</li>
@endsection



@section('content')
@include('insurance.create')
@include('client.create')
@include('client.edit')
@include('client.delete')
@include('client.details')
<div class="container-fluid">
   @if(session('success'))
   <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
      </button>
   </div>
   @endif
   @if($errors->any())
   @foreach($errors->all() as $error)
   <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{$error}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
      </button>
   </div>
   @endforeach
   @endif
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-body">
                <div class="float-right" >
                  <button id="newClient" class="btn btn-outline-primary">Nuevo Cliente</button>
                </div>
                <div class="float-right mr-3" style="padding-bottom: 2%;">
                    <a href="routeDay" type="button" class="btn btn-outline-primary">Ruta del día</a>
                    {{-- <button id="newClient" class="btn btn-outline-primary">Nuevo Cliente</button> --}}
                </div>
                <div class="float-right mr-3" style="padding-bottom: 2%;">
                    <a href="visits" type="button" class="btn btn-outline-primary">Visitas a clientes</a>
                    {{-- <button id="newClient" class="btn btn-outline-primary">Nuevo Cliente</button> --}}
                </div>
               <table id="example" class="display" style="width:100%">
                  <thead>
                     <tr>
                        <th>Sucursal</th>
                        <th>ID</th>
                        <th>Nombre(s)</th>
                        <th>Apellidos</th>

                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Creditos Aceptados</th>
                        <th>Creditos Rechazados</th>
                        <th>Acciones</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($clients as $item)
                     <tr>
                        <td>{{$item->branch->name}}</td>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->last_name}}</td>

                        <td>{{$item->email}}</td>
                        <td>{{$item->phone}}</td>
                        <td style="text-align: center;">{{count($item->accepted_credits)}}</td>
                        <td>{{count($item->rejected_credits)}}</td>

                        <td>
                           <button onclick="llenar({{$item}})" class="btn btn-info" data-toggle="modal" data-target="#clientModalEdit">
                              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                              </svg>
                           </button>
                           <button onclick="detalles({{$item}})" class="btn btn-primary" data-toggle="modal" data-target="#clientModalDetails">
                              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                 <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                 <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                              </svg>
                           </button>
                           <button onclick="confirmDelete({{$item}})" class="btn btn-danger" data-toggle="modal" data-target="#deleteClientModal">
                              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                              </svg>
                           </button>
                           @if($item->insurance == null)
                           <button id="newInsurance" class="btn btn-success">
                              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="15" height="15" viewBox="0 0 172 172" style=" fill:#000000;">
                                 <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                    <path d="M0,172v-172h172v172z" fill="none"></path>
                                    <g>
                                       <path d="M121.83333,21.5c-14.964,0 -28.13633,7.65758 -35.83333,19.24967c-7.70058,-11.59208 -20.86933,-19.24967 -35.83333,-19.24967c-23.74675,0 -43,19.25325 -43,43c0,42.79575 78.83333,86 78.83333,86c0,0 78.83333,-42.83875 78.83333,-86c0,-23.74675 -19.25325,-43 -43,-43" fill="#ffffff"></path>
                                       <path d="M107.5,86h-18.58317l11.4165,-32.25h-21.5l-10.75,43h17.02083l-9.85417,35.83333z" fill="#ecf0f1"></path>
                                    </g>
                                 </g>
                              </svg>
                           </button>
                           @endif
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('script')
<script type="application/javascript">
   $(document).ready(function() {
      $('#newClient').click(function() {
         $('#clientModal').modal();
      });
      $('#newInsurance').click(function() {
         $('#insuranceModal').modal();
      });
      $('#delete').click(function() {
         console.log($(this).data('id'));
         // $('#deleteForm').attr('action', 'client/' + $(this).data('id'));
      });

      $('#insurance_type').change(function() {
         if ($(this).val() == 'DeVida') {
            $('#view_ben').prop('hidden', false);
            $('#beneficiario').prop('required', true);
         } else {
            $('#view_ben').prop('hidden', true);
            $('#beneficiario').prop('required', false);
         }
         if ($(this).val() == 'Financiado') {
            $('#view_fin').prop('hidden', false);
            $('#interes').prop('required', true);
         } else {
            $('#view_fin').prop('hidden', true);
            $('#interes').prop('required', false);
         }
         if ($(this).val() == 'Contado') {
            $('#view_con').prop('hidden', false);
            $('#contado').prop('required', true);
         } else {
            $('#view_con').prop('hidden', true);
            $('#contado').prop('required', false);
         }
      });

      document.getElementById('interes').onkeyup = function() {
         var interes = $(this).val() / 100;
         var months = $('#monthTotal').val();
         if ($('#credit').val() >= 2000 || $('#credit').val() <= 6000) {
            $('#cost').val(300 + ($('#credit').val() * interes) * months);
         }
         if ($('#credit').val() >= 7000) {
            $('#cost').val(500 + ($('#credit').val() * interes) * months);
         }
      }

      document.getElementById('monthTotal').onkeyup = function() {
         var interes = $('#interes').val() / 100;
         var months = $(this).val();
         if ($('#credit').val() >= 2000 || $('#credit').val() <= 6000) {
            $('#cost').val(300 + ($('#credit').val() * interes) * months);
         }
         if ($('#credit').val() >= 7000) {
            $('#cost').val(500 + ($('#credit').val() * interes) * months);
         }
      }

      document.getElementById('credit').onkeyup = function() {
         if ($(this).val() >= 2000 || $(this).val() <= 6000) {
            $('#cost').val(300);
         }
         if ($(this).val() >= 7000) {
            $('#cost').val(500);
         }
      }
   })

   function limpiar() {
      let fields = document.getElementsByClassName('form-control')

      let selects = document.getElementsByClassName('custom-select')

      for (let i = 0; i < selects.length; i++) {
         var element = selects[i];
         element.value = '0'
      }

      for (let i = 0; i < fields.length; i++) {
         var element = fields[i];
         element.value = ''
      }
      document.getElementById('country').value = "México"
      document.getElementById('genreEditM').checked = false
      document.getElementById('genreEditM').checked = false
      $("#monthTotal").val(1);
      $("#credit").val(2000);
      $("#cost").val(300);
   }

   function llenar(item) {
      document.getElementById("clientModalEditForm").action = "/client/" + item.id;

    console.log(item)
      document.getElementById('clientImg').src ='storage/'+ item.imgClient
      document.getElementById('nameEdit').value = item.name
      document.getElementById('last_nameEdit').value = item.last_name
      document.getElementById('rfcEdit').value = item.rfc
      document.getElementById('curpEdit').value = item.curp
      document.getElementById('phoneEdit').value = item.phone
      document.getElementById('cellphoneEdit').value = item.cellphone
      if (item.genre == 'Masculino') {
         document.getElementById('genreEditM').checked = true
      } else {
         document.getElementById('genreEditF').checked = true

      }
      document.getElementById('emailEdit').value = item.email
      document.getElementById('streetEdit').value = item.street
      document.getElementById('int_numberEdit').value = item.int_number
      document.getElementById('ext_numberEdit').value = item.ext_number
      document.getElementById('suburbEdit').value = item.suburb
      document.getElementById('postal_codeEdit').value = item.postal_code
      document.getElementById('cityEdit').value = item.city
      document.getElementById('stateEdit').value = item.state
      document.getElementById('countryEdit').value = item.country
   }

   function detalles(item) {
      console.log(item)
      var estatus
      var dias_atraso = 0
      var badge
      item.accepted_credits.forEach(element => {
         var x = element.payments[0].Days

         if (x < 0) {
            estatus = "Adeuda"
            dias_atraso = x * -1
            badge = "danger"
         } else {
            estatus = "No adeudo"
            dias_atraso = 0
            badge = "success"
         }
         $('#productList').append(
            "<li class='list-group-item d-flex justify-content-between align-items-center'>" + "Número de crédito: " + element.num_credit + ' | Total de crédito: $' + element.total_credit + ' | Fecha proximo pago: ' + element.payments[0].fecha_limite + ' | Días de atraso: ' + dias_atraso + "<span class='badge badge-" + badge + " badge-pill'>" + estatus + "</span>" + "</li>"
         );
      });
   }

   function limpiarDetails() {
      $('#productList').empty()
   }


   function confirmDelete(item) {
      $('#deleteForm').attr('action', 'client/' + item.id);
   }

   function upperCreate() {
      document.getElementById('name').value = document.getElementById('name').value.toUpperCase()
      document.getElementById('nameEdit').value = document.getElementById('name_edit').value.toUpperCase()
      document.getElementById('last_name').value = document.getElementById('last_name').value.toUpperCase()
      document.getElementById('last_nameEdit').value = document.getElementById('last_name_edit').value.toUpperCase()
      document.getElementById('rfc').value = document.getElementById('rfc').value.toUpperCase()
      document.getElementById('rfcEdit').value = document.getElementById('rfc_edit').value.toUpperCase()
      document.getElementById('curp').value = document.getElementById('crup').value.toUpperCase()
      document.getElementById('curpEdit').value = document.getElementById('curp_edit').value.toUpperCase()

      return true;
   }
</script>

@endsection
