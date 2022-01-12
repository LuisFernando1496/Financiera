@extends('layouts.light.master')
@section('title', 'Layout Light')
@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Sucursales</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Listado</li>
<li class="breadcrumb-item active">Sucursales</li>
@endsection

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
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="userModalLabel">Registro De Sucursal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form id="myForm" action="/branch" method="post" enctype="multipart/form-data" onsubmit="upperCreate()">
               @csrf
               <div class="form-row">
                  <div class="form-group col-6">
                     <label for="name">Nombre</label>
                     <input class="form-control" type="text" name="name" id="name" placeholder="Nombre" required>
                  </div>
                  <div class="form-group col-6">
                     <label for="street">Calle / avenida</label>
                     <input type="text" class="form-control" name="street" id="street" value="" placeholder="Calle" required />
                  </div>
               </div>
               <div class="form-group">

               </div>
               <div class="form-row">
                  <div class="form-group col-3">
                     <label for="int_number">Número interior</label>
                     <input type="text" class="form-control" name="int_number" id="int_number" placeholder="123" value="0" />
                  </div>
                  <div class="form-group col-3">
                     <label for="ext_number">Número exterior</label>
                     <input type="text" class="form-control" name="ext_number" id="ext_number" placeholder="234" value="" />
                  </div>
                  <div class="form-group col-3">
                     <label for="suburb">Colonia / barrio</label>
                     <input type="text" class="form-control" name="suburb" id="suburb" value="" placeholder="Colonia" required />
                  </div>
                  <div class="form-group col-3">
                     <label for="postal_code">Código postal</label>
                     <input type="number" class="form-control" name="postal_code" id="postal_code" value="" placeholder="29000" max="100000" required />
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-4">
                     <label for="city">Ciudad</label>
                     <input type="text" class="form-control" name="city" id="city" value="" placeholder="Ciudad" required />
                  </div>
                  <div class="form-group col-4">
                     <label for="state">Estado</label>
                     <select class="form-control" type="text" name="state" id="state" value="" required>
                        <option value="Ciudad de México">Ciudad de México</option>
                        <option value="Aguascalientes">Aguascalientes</option>
                        <option value="Baja California">Baja California</option>
                        <option value="Baja California sur">Baja California Sur</option>
                        <option value="Campeche">Campeche</option>
                        <option value="Chiapas">Chiapas</option>
                        <option value="Chihuahua">Chihuahua</option>
                        <option value="Coahuila">Coahuila</option>
                        <option value="Colima">Colima</option>
                        <option value="Durango">Durango</option>
                        <option value="Guanajuato">Guanajuato</option>
                        <option value="Guerrero">Guerrero</option>
                        <option value="Hidalgo">Hidalgo</option>
                        <option value="Jalisco">Jalisco</option>
                        <option value="Cd. México">Cd. México</option>
                        <option value="Michoacán">Michoacán</option>
                        <option value="Morelos">Morelos</option>
                        <option value="Nayarit">Nayarit</option>
                        <option value="Nuevo León">Nuevo León</option>
                        <option value="Oaxaca">Oaxaca</option>
                        <option value="Puebla">Puebla</option>
                        <option value="Querétaro">Querétaro</option>
                        <option value="Quintana Roo">Quintana Roo</option>
                        <option value="San Luis Potosí">San Luis Potosí</option>
                        <option value="Sinaloa">Sinaloa</option>
                        <option value="Sonora">Sonora</option>
                        <option value="Tabasco">Tabasco</option>
                        <option value="Tamaulipas">Tamaulipas</option>
                        <option value="Tlaxcala">Tlaxcala</option>
                        <option value="Veracruz">Veracruz</option>
                        <option value="Yucatán">Yucatán</option>
                        <option value="Zacatecas">Zacatecas</option>
                     </select>
                  </div>
                  <div class="form-group col-4">
                     <label for="country">País</label>
                     <input type="text" class="form-control" name="country" id="country" value="México" placeholder="País" readonly />
                  </div>
               </div>

               <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-success">Guardar</button>
               </div>

            </form>
         </div>

      </div>
   </div>
</div>
<div class="modal fade" id="branchEditModal" tabindex="-1" role="dialog" aria-labelledby="branchEditModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="branchEditModalLabel">Editar Sucursal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form id="myFormEdit" action="/branch" method="post" onsubmit="upperCreate()">
               @csrf
               @method('PUT')
               <div class="form-row">
                  <div class="form-group col-6">
                     <label for="name">Nombre</label>
                     <input class="form-control" type="text" name="name" id="name_edit" placeholder="Nombre" required>
                  </div>
                  <div class="form-group col-6">
                     <label for="street">Calle / avenida</label>
                     <input type="text" class="form-control" name="street" id="street_edit" value="" placeholder="Calle" required />
                  </div>
               </div>
               <div class="form-group">

               </div>
               <div class="form-row">
                  <div class="form-group col-3">
                     <label for="int_number">Número interior</label>
                     <input type="text" class="form-control" name="int_number" id="int_number_edit" placeholder="123" value="" />
                  </div>
                  <div class="form-group col-3">
                     <label for="ext_number">Número exterior</label>
                     <input type="text" class="form-control" name="ext_number" id="ext_number_edit" placeholder="234" value="" />
                  </div>
                  <div class="form-group col-3">
                     <label for="suburb">Colonia / barrio</label>
                     <input type="text" class="form-control" name="suburb" id="suburb_edit" value="" placeholder="Colonia" required />
                  </div>
                  <div class="form-group col-3">
                     <label for="postal_code">Código postal</label>
                     <input type="number" class="form-control" name="postal_code" id="postal_code_edit" value="" placeholder="29000" max="100000" required />
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-4">
                     <label for="city">Ciudad</label>
                     <input type="text" class="form-control" name="city" id="city_edit" value="" placeholder="Ciudad" required />
                  </div>
                  <div class="form-group col-4">
                     <label for="state">Estado</label>
                     <select class="form-control" type="text" name="state" id="state_edit" value="" required>
                        <option value="Ciudad de México">Ciudad de México</option>
                        <option value="Aguascalientes">Aguascalientes</option>
                        <option value="Baja California">Baja California</option>
                        <option value="Baja California sur">Baja California Sur</option>
                        <option value="Campeche">Campeche</option>
                        <option value="Chiapas">Chiapas</option>
                        <option value="Chihuahua">Chihuahua</option>
                        <option value="Coahuila">Coahuila</option>
                        <option value="Colima">Colima</option>
                        <option value="Durango">Durango</option>
                        <option value="Guanajuato">Guanajuato</option>
                        <option value="Guerrero">Guerrero</option>
                        <option value="Hidalgo">Hidalgo</option>
                        <option value="Jalisco">Jalisco</option>
                        <option value="Cd. México">Cd. México</option>
                        <option value="Michoacán">Michoacán</option>
                        <option value="Morelos">Morelos</option>
                        <option value="Nayarit">Nayarit</option>
                        <option value="Nuevo León">Nuevo León</option>
                        <option value="Oaxaca">Oaxaca</option>
                        <option value="Puebla">Puebla</option>
                        <option value="Querétaro">Querétaro</option>
                        <option value="Quintana Roo">Quintana Roo</option>
                        <option value="San Luis Potosí">San Luis Potosí</option>
                        <option value="Sinaloa">Sinaloa</option>
                        <option value="Sonora">Sonora</option>
                        <option value="Tabasco">Tabasco</option>
                        <option value="Tamaulipas">Tamaulipas</option>
                        <option value="Tlaxcala">Tlaxcala</option>
                        <option value="Veracruz">Veracruz</option>
                        <option value="Yucatán">Yucatán</option>
                        <option value="Zacatecas">Zacatecas</option>
                     </select>
                  </div>
                  <div class="form-group col-4">
                     <label for="country">País</label>
                     <input type="text" class="form-control" name="country" id="country_edit" value="México" placeholder="País" readonly />
                  </div>
               </div>

               <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-success">Guardar</button>
               </div>
            </form>
         </div>

      </div>
   </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Eliminar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de eliminar este elemento?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">CANCELAR</button>
                    <form id="deleteForm" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">ELIMINAR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-body">
               <div class="float-right" style="padding-bottom: 2%;">
                  <button id="newClient" class="btn btn-outline-primary">Nueva sucursal</button>
               </div>
               <table id="example" class="display table-responsive" style="width:100%">
                  <thead>
                     <tr>
                        <th>Nombre</th>
                        <th>Calle</th>
                        <th>Num.Interior</th>
                        <th>Num.Exterior</th>
                        <th>Colonia</th>
                        <th>Codigo Postal</th>
                        <th>Ciudad</th>
                        <th>Estado</th>
                        <th>Acciones</th>

                     </tr>
                  </thead>
                  <tbody>
                     @foreach($branches as $item)
                     <tr>
                        <td class="text-center">{{$item->name}}</td>
                        <td class="text-center">{{$item->street}}</td>
                        <td class="text-center">{{$item->int_number}}</td>
                        <td class="text-center">{{$item->ext_number}}</td>
                        <td class="text-center">{{$item->suburb}}</td>
                        <td class="text-center">{{$item->postal_code}}</td>
                        <td class="text-center">{{$item->city}}</td>
                        <td class="text-center">{{$item->state}}</td>
                        <td>
                           <button onclick="llenar({{$item}})" type="button" class="btn btn-primary btn-sm my-2" data-toggle="modal" data-target="#branchEditModal">
                              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                              </svg>
                              <small>EDITAR</small>
                           </button>
                           <button data-type="delete" data-target="#deleteModal" data-id="{{$item->id}}" class="btn btn-danger btn-sm my-2" data-toggle="modal" data-target="#deleteModal">
                              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                              </svg>
                              <small>ELIMINAR</small>
                           </button>
                        </td>

                     </tr>
                     @endforeach
                  </tbody>
                  <tfoot>
                     <tr>
                        <th>Nombre</th>
                        <th>Calle</th>
                        <th>Num.Interior</th>
                        <th>Num.Exterior</th>
                        <th>Colonia</th>
                        <th>Codigo Postal</th>
                        <th>Ciudad</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                     </tr>
                  </tfoot>
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
         $('#userModal').modal();
      });
      $('button').click(function() {
            if ($(this).data('type') == 'delete') {
                $('#deleteForm').attr('action', 'branch/' + $(this).data('id'));

            }
        });


   })

   function llenar(item) {
      document.getElementById("myFormEdit").action = "/branch/" + item.id;

      document.getElementById('name_edit').value = item.name
      document.getElementById('street_edit').value = item.street
      document.getElementById('int_number_edit').value = item.int_number
      document.getElementById('ext_number_edit').value = item.ext_number
      document.getElementById('suburb_edit').value = item.suburb
      document.getElementById('postal_code_edit').value = item.postal_code
      document.getElementById('city_edit').value = item.city
      document.getElementById('state_edit').value = item.state
      document.getElementById('country_edit').value = item.country

   }
</script>

@endsection
