@extends('layouts.light.master')
@section('title', 'Layout Light')
@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Ahorro-Inversión</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Listado</li>
<li class="breadcrumb-item active">Ahorro-Inversión</li>
@endsection

@include('saving.create')
@include('saving.edit')
@include('saving.delete')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-right" style="padding-bottom: 2%;">
                        <button id="newSaving" class="btn btn-outline-primary">Nueva Inversión</button>
                    </div>
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Inversión total</th>
                                <th>Meses totales</th>
                                <th>Porcentaje total</th>
                                <th>Retorno mensual</th>
                                <th>Total a ganar </th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($savings as $saving)
                            <tr>
                                <td>{{$saving->client->name}} {{$saving->client->last_name}}</td>
                                <td>{{$saving->total}}</td>
                                <td>{{$saving->MonthTotal}}</td>
                                <td>{{$saving->interesTotal}}</td>
                                <td>{{$saving->returnTotal}}</td>
                                <td>{{$saving->winningTotal}}</td>
                                <td>
                                    <button onclick="llenar({{$saving}})" class="btn btn-info" data-toggle="modal" data-target="#savingModalEdit">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                        </svg>
                                    </button>
                                    <button onclick="confirmDelete({{$saving}})" class="btn btn-danger" data-toggle="modal" data-target="#deleteSavingModal">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                        </svg>
                                    </button>
                                    <a href="{{asset('/payInversion/'.$saving->id)}}" type="button" class="btn btn-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
                                            <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                                            <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z" />
                                        </svg>
                                    </a>
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
        $('#newSaving').click(function() {
            $('#savingModal').modal();
        });

        document.getElementById('total').onkeyup = function() {
            var percentVal = 100 / $('#interesTotal').val();
            var x = $(this).val() / percentVal;
            $('#returnTotal').val(x);
            $('#winningTotal').val($('#MonthTotal').val() * x);
        }
        document.getElementById('interesTotal').onkeyup = function() {
            var percentVal = 100 / $(this).val();
            var x = $('#total').val() / percentVal;
            $('#returnTotal').val(x);
            $('#winningTotal').val($('#MonthTotal').val() * x);
        }
        document.getElementById('MonthTotal').onkeyup = function() {
            var percentVal = 100 / $('#interesTotal').val();
            var x = $('#total').val() / percentVal;
            $('#returnTotal').val(x);
            $('#winningTotal').val($('#MonthTotal').val() * x);
        }

        document.getElementById('totalEdit').onkeyup = function() {
            var percentVal = 100 / $('#interesTotalEdit').val();
            var x = $(this).val() / percentVal;
            $('#returnTotalEdit').val(x);
            $('#winningTotalEdit').val($('#MonthTotalEdit').val() * x);

        }
        document.getElementById('interesTotalEdit').onkeyup = function() {
            var percentVal = 100 / $(this).val();
            var x = $('#totalEdit').val() / percentVal;
            $('#returnTotalEdit').val(x);
            $('#winningTotalEdit').val($('#MonthTotalEdit').val() * x);
        }
        // document.getElementById('MonthTotal').onkeyup = function() {
        //     var percentVal = 100/$(this).val();
        //     var x = $('#total').val()/percentVal;
        //     $('#returnTotal').val(x);
        // }
    });

    function llenar(item) {
        document.getElementById("savingModalEditForm").action = "/saving/" + item.id;

        document.getElementById("client").value = item.client.name + ' ' + item.client.last_name
        document.getElementById("client_idEdit").value = item.client.id
        document.getElementById("totalEdit").value = item.total
        document.getElementById("MonthTotalEdit").value = item.MonthTotal
        document.getElementById("interesTotalEdit").value = item.interesTotal
        document.getElementById("returnTotalEdit").value = item.returnTotal
        document.getElementById("winningTotalEdit").value = item.winningTotal
    }

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
        $("#client_id").val("null");
        $("#MonthTotal").val(8);
        $("#interesTotal").val(2.5);
    }

    function confirmDelete(item) {
        $('#deleteForm').attr('action', 'saving/' + item.id);
    }
</script>
@endsection