@extends('layouts.light.master')
@section('title', 'Layout Light')
@section('css')
@endsection

@section('style')
@endsection

<style>
   .h-divider {
      margin-top: 5px;
      margin-bottom: 5px;
      height: 1px;
      width: 50%;
      border-top: 1px solid gray;
   }
</style>

@section('breadcrumb-title')
<h3>Solicitud De Créditos</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Listado</li>
<li class="breadcrumb-item active">Solicitud De Créditos</li>
@endsection



@include('credit.create')
@include('credit.edit')
@include('credit.delete')
@include('credit.accepted')

@section('content')
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
               <div class="float-right" style="padding-bottom: 2%;">
                  <button id="newCredit" class="btn btn-outline-primary">Nuevo Crédito</button>
               </div>
               <table id="example" class="display" style="width:100%">
                  <thead>
                     <tr>
                        <th>N° Crédito</th>
                        <th>Sucursal</th>
                        <th>Cliente</th>
                        <th>Contacto</th>
                        <th>N° identificación</th>
                        <th>Empresa o Patrón</th>
                        <th>Crédito solicitado</th>
                        <th>Crédito aprobado</th>
                        <th>Acciones</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($credits as $credit)
                     <tr>
                        <td>{{$credit->num_credit}}</td>
                        <td>{{$credit->client->branch->name ?? '-'}}</td>
                        <td>{{$credit->client->last_name}} {{$credit->client->name}}</td>
                        <td>{{$credit->client->cellphone}}</td>
                        <td>{{$credit->num_id}}</td>
                        <td>{{$credit->entreprise_name}}</td>
                        <td>{{$credit->want_credit}}</td>
                        <td>{{$credit->check_credit}}</td>
                        <td>
                           <button onclick="llenar({{$credit}})" class="btn btn-info" data-toggle="modal" data-target="#creditModalEdit">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                 <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                 <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                              </svg>
                           </button>


                           @if($credit->status==null)
                              @hasanyrole('manager|supManager')
                                 <button onclick="confirmDelete({{$credit}})" class="btn btn-danger" data-toggle="modal" data-target="#deleteCreditModal">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                       <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                    </svg>
                                 </button>

                                 <button onclick="confirmAcceptedCredit({{$credit}})" class="btn btn-success" data-toggle="modal" data-target="#acceptedCreditModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                       <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                    </svg>
                                 </button>
                              @endhasanyrole
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
      $('#newCredit').click(function() {
         $('#creditModal').modal();
      });

      document.getElementById('seller_credit').onchange = function() {
         if (document.getElementById('seller_credit').checked == true) {
            $('#view_file').prop('hidden', false);
            $('#fileLocal').prop('required', true);
         } else {
            $('#view_file').prop('hidden', true);
            $('#fileLocal').prop('required', false);
         }
      }

      document.getElementById('check_credit').onkeyup = function() {
         var interes = $('#interes').val() / 100;
         var months = $('#time_Credit').val();
         var credit = $(this).val();
         console.log("INTERES " + interes);
         console.log("meses " + months);
         console.log("credit1 " + credit);
         var total = parseInt(credit) + (($('#check_credit').val() * interes) * months);
         $('#totalCredit').val(total);
      }

      document.getElementById('time_Credit').onkeyup = function() {
         var interes = $('#interes').val() / 100;
         var months = $(this).val();
         var credit = $('#check_credit').val();
         console.log("INTERES " + interes);
         console.log("meses " + months);
         console.log("credit1 " + credit);
         var total = parseInt(credit) + (($('#check_credit').val() * interes) * months);
         $('#totalCredit').val(total);
      }

      document.getElementById('interes').onkeyup = function() {
         var interes = $(this).val() / 100;
         var months = $('#time_Credit').val();
         var credit = $('#check_credit').val();
         console.log("INTERES " + interes);
         console.log("meses " + months);
         console.log("credit1 " + credit);
         var total = parseInt(credit) + (($('#check_credit').val() * interes) * months);
         $('#totalCredit').val(total);
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
   }

   function llenar(item) {
      console.log(item)
      if (item.seller_credit != null) {
         document.getElementById('inlineCheckbox2').checked = true
      } else if (item.aditional_credit != null) {
         document.getElementById('inlineCheckbox3').checked = true
      } else if (item.guarantee != null) {
         document.getElementById('inlineCheckbox6').checked = true
      } else if (item.renovation_credit != null) {

         document.getElementById('inlineCheckbox4').checked = true
      } else if (item.insurance_credit != null) {
         document.getElementById('inlineCheckbox5').checked = true
      } else {
         document.getElementById('inlineCheckbox1').checked = true
      }
      document.getElementById("creditModalEditForm").action = "/credit/" + item.id;
      document.getElementById('num_creditEdit').value = item.num_credit
      document.getElementById('client').value = item.client.name + ' ' + item.client.last_name
      document.getElementById('client_idEdit').value = item.client.id
      document.getElementById('type_idEdit').value = item.type_id
      document.getElementById('num_idEdit').value = item.num_id
      document.getElementById('auth_dateEdit').value = item.auth_date
      if (item.civil_state == false) {
         document.getElementById('civil_states').checked = true
      } else {
         document.getElementById('civil_statec').checked = true
      }
      if (item.regimen == "Separación") {
         document.getElementById('regimenS').checked = true
      } else if (item.regimen == "Conyugal") {
         document.getElementById('regimenC').checked = true
      } else {
         document.getElementById('regimenL').checked = true
      }
      if (item.current_house == false) {
         document.getElementById('current_houseP').checked = true
      } else {
         document.getElementById('current_houseF').checked = true
      }
      document.getElementById('entreprise_nameEdit').value = item.entreprise_name
      document.getElementById('NRPEdit').value = item.NRP
      document.getElementById('entreprise_phoneEdit').value = item.entreprise_phone
      document.getElementById('schedule_inEdit').value = item.schedule_in
      document.getElementById('schedule_outEdit').value = item.schedule_out
      document.getElementById('last_name2Edit').value = item.last_name2
      document.getElementById('second_last_name2Edit').value = item.second_last_name2
      document.getElementById('name2Edit').value = item.name2
      document.getElementById('phone2Edit').value = item.phone2
      document.getElementById('cellphone2Edit').value = item.cellphone2
      document.getElementById('last_name3Edit').value = item.last_name3
      document.getElementById('second_last_name3Edit').value = item.second_last_name3
      document.getElementById('name3Edit').value = item.name3
      document.getElementById('phone3Edit').value = item.phone3
      document.getElementById('cellphone3Edit').value = item.cellphone3
      document.getElementById('economicEdit').value = item.economic

      document.getElementById('last_name_avalEdit').value = item.last_name_aval
      document.getElementById('second_last_name_avalEdit').value = item.second_last_name_aval
      document.getElementById('name_avalEdit').value = item.name_aval
      document.getElementById('phone_avalEdit').value = item.phone_aval
      document.getElementById('type_warrantyEdit').value = item.type_warranty
      document.getElementById('description_warrantyEdit').value = item.description_warranty
      document.getElementById('model_warrantyEdit').value = item.model_warranty
      document.getElementById('serie_warrantyEdit').value = item.serie_warranty
      document.getElementById('placa_warrantyEdit').value = item.placa_warranty
      document.getElementById('color_warrantyEdit').value = item.color_warranty

      document.getElementById('pensionEdit').value = item.pension
      if (item.time_Credit == 4) {
         document.getElementById('time_Credit4').checked = true
      } else if (item.time_Credit == 5) {
         document.getElementById('time_Credit5').checked = true
      } else {
         document.getElementById('time_Credit6').checked = true
      }
      document.getElementById('want_creditEdit').value = item.want_credit
      document.getElementById('check_creditEdit').value = item.check_credit
      document.getElementById('bank_nameEdit').value = item.bank_name
      document.getElementById('credit_bank_numberEdit').value = item.credit_bank_number
      document.getElementById('credit_bank_keyEdit').value = item.credit_bank_key
      document.getElementById('city_ofEdit').value = item.city_of

   }

   function confirmDelete(item) {
      $('#deleteForm').attr('action', 'credit/' + item.id);
   }

   function confirmAcceptedCredit(item) {
      $('#acceptedForm').attr('action', 'accepted_credit/' + item.id);
   }

   function hideModal() {
      $('#acceptedCreditModal').modal('hide');
   }
</script>

@endsection