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
<li class="breadcrumb-item">Clientes</li>
<li class="breadcrumb-item active">Estado de visitas</li>
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    {{-- <form id="dataForm"> --}}
                        <div class="float-left">
                            <div class="row">
                                <div class="col-md-1 mt-4">
                                    <div class="form-check form-switch">
                                        <input onchange="today()" class="form-check-input" type="checkbox" role="switch" id="today">
                                        <label class="form-check-label" for="today">Hoy</label>
                                    </div>
                                </div>
                                <div class="col-md-3" id="divFrom">
                                    <div class="form-group">
                                        <label for="from">Fecha de inicio</label>
                                        <input type="date" id="from" name="from" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3" id="divTo">
                                    <div class="form-group">
                                        <label for="to">Fecha de fin</label>
                                        <input type="date" id="to" name="to" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3 ml-3">
                                    <label for="">Estado del cliente:</label>
                                    <select name="status" onchange="selectStatus()" id="selectClient" class="form-control">
                                        <option value="" selected disabled>Selecciona una opción</option>
                                        <option value="1">En proceso</option>
                                        <option value="2">Visitado</option>
                                    </select>
                                </div>
                                <div class="col mt-1">
                                    <button id="butonSend" class="btn bg-success mt-4" style="display: none" onclick="visitstatus()">Consultar</button>
                                </div>
                            </div>
                        </div>
                    {{-- </form> --}}
                </div>

                <div class="card-body tablaMain">
                    <table class="display" id="example">
                        <thead>
                            <tr>
                                <th>Visitado</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Celular</th>
                                <th>Descripción de estado</th>
                                <th>Fecha de última visita</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    @if ($client->visitStatus == 1)
                                        <td><button class="bg-success" onclick="changeVisitStatus({{ $client->visitaId }})"><i class="fa fa-check"></i></button></td>
                                    @else
                                        <td><button class="badge bg-warning disabled text-dark center">Visitado</button></td>
                                    @endif
                                    <td>{{ $client->nombre }} {{ $client->apellido }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->phone }}</td>
                                    <td>{{ $client->cellphone }}</td>
                                    <td>{{ $client->descripcion }}</td>
                                    <td>{{ $client->fecha }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- respuesta jquery --}}
                <div class="card-body">
                    <table id="example" class="userData table table-bordered" style="display: none">
                        <thead>
                            <tr>
                                <th colspan="2">Nombre</th>
                                <th colspan="2">Correo</th>
                                <th colspan="2">Teléfono</th>
                                <th colspan="2">Celular</th>
                                <th colspan="2">Fecha de visita</th>
                            </tr>
                        </thead>
                        <tbody id="userDataInfo">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>

function today(){
    var check = $('#today').is(':checked');
    if (check == true) {
        $('#divFrom').hide()
        $('#divTo').hide()
    }
    else{
        $('#divFrom').show()
        $('#divTo').show()
    }
    // console.log(check)
}

    function changeVisitStatus(id){
        $.ajax({
            type:'GET',
            async:true,
            url:'visitDone/' + id,
            success:function(data){
                location.reload(true);
            }
        });
        // console.log(id)
    }
    function selectStatus(){
        $('#butonSend').show()
    }

    function visitstatus(){
        var check = $('#today').is(':checked');
        var client = $("#selectClient").val();
        if (check == true) { //no se toma el valor de from y to
            var data = [
                check = check,
                client = client
            ]
            $.ajax({
                type:'GET',
                async:true,
                dataType: 'json',
                url:'visitsStatus/' + data,
                success:function(info){
                    if (info == undefined) {

                        $('#userDataInfo').append(
                            '<tr> <td colspan="12"> No hay clientes en esta selección </td> </tr>'
                        );
                    }
                    else{
                         // en la respuesta se hace esto
                        $('.tablaMain').hide();
                        $('.userData').show();
                        // $('.userData').css('display', 'block');


                        $("#userDataInfo").html('');
                        for(var i=0; i<info.info.length; i++){
                            $('#userDataInfo').append(
                                '<tr> <td colspan="2">' + info.info[i].nombre + ' ' +info.info[i].apellido +'</td> <td colspan="2">' + info.info[i].email +'</td> <td colspan="2">'+ info.info[i].phone + '</td> <td colspan="2">' + info.info[i].cellphone + '</td> <td colspan="2">' + info.info[i].fecha + '</td> </tr>'
                            );
                        }
                    }
                    console.log(info.info[0])
                }
            });
            // console.log(check, client)
        }
        else{
            var from = $("#from").val()
            var to = $("#to").val()
            var data = [
                from = from,
                to = to,
                client = client
            ]
            $.ajax({
                type:'GET',
                async:true,
                dataType: 'json',
                url:'visitsStatus/' + data,
                success:function(info){
                    $('.tablaMain').hide();
                    $('.userData').show();

                    $("#userDataInfo").html('');
                    for(var i=0; i<info.info.length; i++){
                            $('#userDataInfo').append(
                                '<tr> <td colspan="2">' + info.info[i].nombre + ' ' +info.info[i].apellido +'</td> <td colspan="2">' + info.info[i].email +'</td> <td colspan="2">'+ info.info[i].phone + '</td> <td colspan="2">' + info.info[i].cellphone + '</td> <td colspan="2">' + info.info[i].fecha + '</td> </tr>'
                            );
                        }
                    console.log(info)
                }
            });
        }








    }
</script>
@endsection
