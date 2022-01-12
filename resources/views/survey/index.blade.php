@extends('layouts.light.master')
@section('title', 'Layout Light')
@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Encuesta Socioeconomica</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Encuestas</li>
<li class="breadcrumb-item active">Encuesta Socioeconomica</li>
@endsection

@include('survey.create')
@include('survey.edit')
@include('survey.delete')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-right" style="padding-bottom: 2%;">
                        <button id="newsurvey" class="btn btn-outline-primary">Nueva Encuesta</button>
                    </div>
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Edad</th>
                                <th>Antiguedad</th>
                                <th>Ganancia mensual</th>
                                <th>Presta Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($surveys as $survey)
                            <tr>
                                <td>{{$survey->name}}</td>
                                <td>{{$survey->age}}</td>
                                <td>{{$survey->antiquity}}</td>
                                <td>${{$survey->gain}}</td>
                                <td>{{$survey->name_giver}}</td>
                                <td>
                                    <button onclick="llenar({{$survey}})" class="btn btn-info" data-toggle="modal" data-target="#surveyModalEdit">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                        </svg>
                                    </button>
                                    <button onclick="confirmDelete({{$survey}})" class="btn btn-danger" data-toggle="modal" data-target="#deletesurveyModal">
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
    $(document).ready(function() {
        $('#newsurvey').click(function() {
            $('#surveyModal').modal();
        });

    });

    function llenar(item){
        document.getElementById("surveyModalEditForm").action = "/survey/" + item.id;
        
        document.getElementById('nameEdit').value = item.name;
        document.getElementById('ageEdit').value = item.age;
        document.getElementById('business_lineEdit').value = item.business_line;
        document.getElementById('antiquityEdit').value = item.antiquity;

        if (item.self_inversion) {
            document.getElementById('self_inversion1Edit').checked = true;
        } else {
            document.getElementById('self_inversion2Edit').checked = true;
            
        }
        if (item.bad_record) {
            document.getElementById('bad_record1Edit').checked = true;
        } else {
            document.getElementById('bad_record2Edit').checked = true;
            
        }
        if (item.self_record) {
            document.getElementById('self_record1Edit').checked = true;
        } else {
            document.getElementById('self_record2Edit').checked = true;
            
        }
        if (item.name_giver) {
            document.getElementById('name_giver1Edit').checked = true;
        } else {
            document.getElementById('name_giver2Edit').checked = true;
            
        }
        if (item.family_knows) {
            document.getElementById('family_knows1Edit').checked = true;
        } else {
            document.getElementById('family_knows2Edit').checked = true;
            
        }
        document.getElementById('gainEdit').value = item.gain;
        document.getElementById('other_gainsEdit').value = item.other_gains;
        document.getElementById('other_creditsEdit').value = item.other_credits;
        document.getElementById('credit_amountEdit').value = item.credit_amount;                        
        document.getElementById('how_financialEdit').value = item.how_financial;
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
    }

    function confirmDelete(item) {
        $('#deleteForm').attr('action', 'survey/' + item.id);
    }
</script>
@endsection