@extends('layouts.light.master')
@section('title', 'Layout Light')
@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Seguros</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Listado</li>
<li class="breadcrumb-item active">Seguros</li>
@endsection

@include('Insurance.create')
@include('Insurance.edit')
@include('Insurance.delete')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-right" style="padding-bottom: 2%;">
                        <button id="newInsurance" class="btn btn-outline-primary">Nuevo Seguro</button>
                    </div>
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Tipo</th>
                                <th>Meses Totales</th>
                                <th>Crédito</th>
                                <th>Costo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($insurances as $insurance)
                            <tr>
                                <td>{{$insurance->client->last_name}} {{$insurance->client->name}}</td>
                                <td>{{$insurance->insurance_type}}</td>
                                <td>{{$insurance->monthTotal}}</td>
                                <td>{{$insurance->credit}}</td>
                                <td>{{$insurance->cost}}</td>
                                <td>
                                    <button onclick="llenar({{$insurance}})" class="btn btn-info" data-toggle="modal" data-target="#InsuranceModalEdit">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                        </svg>
                                    </button>
                                    <button onclick="confirmDelete({{$insurance}})" class="btn btn-danger" data-toggle="modal" data-target="#deleteInsuranceModal">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                        </svg>
                                    </button>
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
    var content = document.getElementById("content");
    $(document).ready(function() {
        $('#newInsurance').click(function() {
            $('#insuranceModal').modal();
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

        $('#insurance_typeEdit').change(function() {
            if ($(this).val() == 'DeVida') {
                $('#view_benEdit').prop('hidden', false);
                $('#beneficiarioEdit').prop('required', true);
            } else {
                $('#view_benEdit').prop('hidden', true);
                $('#beneficiarioEdit').prop('required', false);
            }
            if ($(this).val() == 'Financiado') {
                $('#view_finEdit').prop('hidden', false);
                $('#interesEdit').prop('required', true);
            } else {
                $('#view_finEdit').prop('hidden', true);
                $('#interesEdit').prop('required', false);
            }
            if ($(this).val() == 'Contado') {
                $('#view_conEdit').prop('hidden', false);
                $('#contadoEdit').prop('required', true);
            } else {
                $('#view_conEdit').prop('hidden', true);
                $('#contadoEdit').prop('required', false);
            }
        });

        document.getElementById('interes').onkeyup = function() {
            var interes = $(this).val()/100;
            var months = $('#monthTotal').val();
            if ($('#credit').val() >= 2000 || $('#credit').val() <= 6000) {
                $('#cost').val(300+($('#credit').val() * interes)*months);
            }
            if ($('#credit').val() >= 7000) {
                $('#cost').val(500 + ($('#credit').val() * interes)*months);
            }
        }

        document.getElementById('monthTotal').onkeyup = function() {
            var interes = $('#interes').val()/100;
            var months = $(this).val();
            if ($('#credit').val() >= 2000 || $('#credit').val() <= 6000) {
                $('#cost').val(300 + ($('#credit').val() * interes)*months);
            }
            if ($('#credit').val() >= 7000) {
                $('#cost').val(500 + ($('#credit').val() * interes)*months);
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
    });

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
        $("#insurance_type").val("null");
        $("#monthTotal").val(1);
        $("#credit").val(2000);
        $("#cost").val(300);
        $('#view_ben').prop('hidden', true);
        $('#view_fin').prop('hidden', true);
        $('#view_con').prop('hidden', true);
        $('#view_benEdit').prop('hidden', true);
        $('#view_finEdit').prop('hidden', true);
        $('#view_conEdit').prop('hidden', true);
    }

    function llenar(item) {
        document.getElementById("insuranceModalEditForm").action = "/insurance/" + item.id;

        document.getElementById('client').value = item.client.name + ' ' + item.client.last_name
        document.getElementById('client_idEdit').value = item.client.id
        document.getElementById('insurance_typeEdit').value = item.insurance_type
        if (item.insurance_type == 'Financiado') {
            $('#view_finEdit').prop('hidden', false);
            document.getElementById('interesEdit').value = item.interes
        } else if (item.insurance_type == 'Contado') {
            $('#view_conEdit').prop('hidden', false);
            document.getElementById('contadoEdit').value = item.contado
        } else {
            $('#view_benEdit').prop('hidden', false);
            document.getElementById('beneficiarioEdit').value = item.beneficiario
        }
        document.getElementById('monthTotalEdit').value = item.monthTotal
        document.getElementById('creditEdit').value = item.credit
        document.getElementById('costEdit').value = item.cost
    }

    function confirmDelete(item) {
        $('#deleteForm').attr('action', 'insurance/' + item.id);
    }
</script>
@endsection