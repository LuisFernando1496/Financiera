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
@include('credit.documentation')
@include('credit.numCredit')

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
                        {{--<th>Nombre negocio</th>--}}
                        <th>Crédito solicitado</th>
                        <th>Crédito aprobado</th>
                        <th>Acciones</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($credits as $credit)
                     <tr>
                        <td>{{$credit->num_credit}}
                           <button onclick="editNumCredit({{$credit}})" class="btn btn-warning" data-toggle="modal" data-target="#numCreditEditModal">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                              <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                           </svg>
                           </button>
                        </td>
                        <td>{{$credit->client->branch->name ?? '-'}}</td>
                        <td>{{$credit->client->last_name}} {{$credit->client->name}}</td>
                        <td>{{$credit->client->cellphone}}</td>
                        <td>{{$credit->num_id}}</td>
                        {{--<td>{{$credit->nombre_negocio}} 
                           @if($credit->negocio == 0)
                           (Propio)
                           @else
                           (Rentado)
                           @endif
                        </td>--}}
                        <td>{{$credit->want_credit}}</td>
                        <td>{{$credit->check_credit}}
                           @if($credit->status == null)
                           <label for="" class="alert-danger">(NO APROVADO)</label>
                           @else
                           <label for="" class="alert-success">(APROVADO)</label>
                           @endif
                        </td>
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
                                 <button onclick="documentationUp({{$credit}}, {{$documents}})" class="btn btn-primary" data-toggle="modal" data-target="#documentacionModal">
                                    <!--<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                       <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                    </svg>-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-arrow-up" viewBox="0 0 16 16">
                                       <path fill-rule="evenodd" d="M8 11a.5.5 0 0 0 .5-.5V6.707l1.146 1.147a.5.5 0 0 0 .708-.708l-2-2a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L7.5 6.707V10.5a.5.5 0 0 0 .5.5z"/>
                                       <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                                       <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
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
      $('#formulario_conyuge').prop('hidden', true);
      $('#nombre_conyuge').prop('readonly', true);
      $('#apellidos_conyuge').prop('readonly', true);
      $('#celular_conyuge').prop('readonly', true);
      $('#calle_conyuge').prop('readonly', true);
      $('#colonia_conyuge').prop('readonly', true);
      $('#codigo_postal_conyuge').prop('readonly', true);


      $('#civil_state').click(function () {
         $('#title_conyuge').prop('hidden', true);
         $('#formulario_conyuge').prop('hidden', true);
         $('#nombre_conyuge').prop('readonly', true);
         $('#apellidos_conyuge').prop('readonly', true);
         $('#celular_conyuge').prop('readonly', true);
         $('#calle_conyuge').prop('readonly', true);
         $('#colonia_conyuge').prop('readonly', true);
         $('#codigo_postal_conyuge').prop('readonly', true);
      });

      $('#civil_state_1').click(function () {
         $('#title_conyuge').prop('hidden', false);
         $('#formulario_conyuge').prop('hidden', false);
         $('#nombre_conyuge').prop('readonly', false);
         $('#apellidos_conyuge').prop('readonly', false);
         $('#celular_conyuge').prop('readonly', false);
         $('#calle_conyuge').prop('readonly', false);
         $('#colonia_conyuge').prop('readonly', false);
         $('#codigo_postal_conyuge').prop('readonly', false);
      });

      $('#newCredit').click(function() {
         $('#creditModal').modal();
      });


      $('#client_id').change(function () {
         let idClient = $(this).val();
         let datos = [];
         if(idClient == "null"){
            $('#rfc_bank').val("");
            $('#email_bank').val("");
         }else{
            datos = JSON.parse(idClient);
            $('#rfc_bank').val(datos.rfc);
            $('#email_bank').val(datos.email);
         }
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
         var interes = $('#interes').val();// / 100;
         var months = $('#time_Credit').val();
         var credit = $(this).val();
         console.log("INTERES " + interes);
         console.log("meses " + months);
         console.log("credit1 " + credit);
         var total = parseFloat(credit) + parseFloat(interes);//(($('#check_credit').val() * interes) * months);
         $('#totalCredit').val(total);
      }

      document.getElementById('time_Credit').onkeyup = function() {
         var interes = $('#interes').val();// / 100;
         var months = $(this).val();
         var credit = $('#check_credit').val();
         console.log("INTERES " + interes);
         console.log("meses " + months);
         console.log("credit1 " + credit);
         var total = parseFloat(credit) + parseFloat(interes);//(($('#check_credit').val() * interes) * months);
         $('#totalCredit').val(total);
      }

      document.getElementById('interes').onkeyup = function() {
         var interes = $(this).val();// / 100;
         var months = $('#time_Credit').val();
         var credit = $('#check_credit').val();
         console.log("INTERES " + interes);
         console.log("meses " + months);
         console.log("credit1 " + credit);
         var total = parseFloat(credit) + parseFloat(interes);// (($('#check_credit').val() * interes) * months);
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

   function documentationUp(item, doc) {
      //console.log(doc.find(element => element.credit_id == 6));
      document.getElementById("credit_id").value = item.id;
      let docs = doc.find(element => element.credit_id == item.id);
      if (docs != null){
         document.getElementById("document_1_mostrar").value = docs.document_1;
         document.getElementById("document_2_mostrar").value = docs.document_2;
         document.getElementById("document_3_mostrar").value = docs.document_3;
         document.getElementById("document_4_mostrar").value = docs.document_4;
         //document.getElementById("btnShowDoc1").readonly = false;
         var divisiones = docs.file_1.split("/");
         document.getElementById("show1").href = '/Storage/'+divisiones[1];
         divisiones = docs.file_2.split("/");
         document.getElementById("show2").href = '/Storage/'+divisiones[1];
         divisiones = docs.file_3.split("/");
         document.getElementById("show3").href = '/Storage/'+divisiones[1];
         divisiones = docs.file_4.split("/");
         document.getElementById("show4").href = '/Storage/'+divisiones[1];
         $('#show1').prop('hidden', false);
         $('#show2').prop('hidden', false);
         $('#show3').prop('hidden', false);
         $('#show4').prop('hidden', false);
         $('#btnGuardar').prop('hidden', true);
      }else{
         document.getElementById("document_1_mostrar").value = "";
         document.getElementById("document_2_mostrar").value = "";
         document.getElementById("document_3_mostrar").value = "";
         document.getElementById("document_4_mostrar").value = "";
         $('#show1').prop('hidden', true);
         $('#show2').prop('hidden', true);
         $('#show3').prop('hidden', true);
         $('#show4').prop('hidden', true);
         $('#btnGuardar').prop('hidden', false);
      }
   }

   function editNumCredit(item){
      document.getElementById("numCreditModalEditForm").action = "/credit/" + item.id;
      document.getElementById('num_credit_edit').value = item.num_credit;
   }

   function llenar(item) {
      console.log(item);
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
         document.getElementById('title_conyuge_edit').hidden = true
         document.getElementById('formulario_conyuge_edit').hidden = true
      } else {
         document.getElementById('civil_statec').checked = true
         document.getElementById('title_conyuge_edit').hidden = false
         document.getElementById('formulario_conyuge_edit').hidden = false
         document.getElementById('nombre_conyuge_edit').value = item.nombre_conyuge
         document.getElementById('apellidos_conyuge_edit').value = item.apellidos_conyuge
         document.getElementById('celular_conyuge_edit').value = item.celular_conyuge
         document.getElementById('calle_conyuge_edit').value = item.calle_conyuge
         document.getElementById('colonia_conyuge_edit').value = item.colonia_conyuge
         document.getElementById('codigo_postal_conyuge_edit').value = item.codigo_postal_conyuge
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
      document.getElementById('economicEdit').value = item.economic

      document.getElementById('nombre_negocio_edit').value = item.nombre_negocio
      document.getElementById('actividad_negocio_edit').value = item.actividad_negocio
      document.getElementById('tiempo_negocio_edit').value = item.tiempo_negocio
      document.getElementById('telefono_negocio_edit').value = item.telefono_negocio
      document.getElementById('calle_negocio_edit').value = item.calle_negocio
      document.getElementById('colonia_negocio_edit').value = item.colonia_negocio
      document.getElementById('ganacia_negocio_edit').value = item.ganacia_negocio
      document.getElementById('gastos_negocio_edit').value = item.gastos_negocio
      if (item.negocio == 0){
         document.getElementById('negocio_propio').checked = true
      }else{
         document.getElementById('negocio_rentado').checked = true
      }
      /*document.getElementById('entreprise_nameEdit').value = item.entreprise_name
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
      document.getElementById('cellphone3Edit').value = item.cellphone3*/

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
      document.getElementById('rfc_bank_edit').value = item.rfc_bank
      document.getElementById('email_bank_edit').value = item.email_bank
      //document.getElementById('city_ofEdit').value = item.city_of

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

   document.querySelector("#document_1").addEventListener("change", function(ev){
      let files = ev.target.files;
      console.log("select document1 "+ files[0].name);
      document.getElementById('document_1_mostrar').value = files[0].name;
   });
   document.querySelector("#document_2").addEventListener("change", function(ev){
      let files = ev.target.files;
      console.log("select document2 "+ files[0].name);
      document.getElementById('document_2_mostrar').value = files[0].name;
   });
   document.querySelector("#document_3").addEventListener("change", function(ev){
      let files = ev.target.files;
      console.log("select document3 "+ files[0].name);
      document.getElementById('document_3_mostrar').value = files[0].name;
   });
   document.querySelector("#document_4").addEventListener("change", function(ev){
      let files = ev.target.files;
      console.log("select document4 "+ files[0].name);
      document.getElementById('document_4_mostrar').value = files[0].name;
   });
</script>

@endsection