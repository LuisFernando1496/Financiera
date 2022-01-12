@extends('layouts.light.master')
@section('title', 'Layout Light')
@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Reportes</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Reportes</li>
<li class="breadcrumb-item active">Por Fechas</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="/report" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="report_type">Tipo de reporte</label>
                            <select class="form-control" name="report_type" id="report_type" value="" required>
                                <option value="Creditos">Créditos desembolsados</option>
                                <option value="Corrientes">Clientes al día</option>
                                <option value="Atrasados">Clientes atrasados</option>
                                <option value="Total" id="TotalOfD">Total del día</option>
                                <option value="Cuenta">Estado de cuenta</option>
                            </select>
                        </div>
                        <div class="form-group" id="clientDiv" hidden>
                            <label for="client">Selecciona cliente</label>
                            <select class="form-control" name="client_id" id="client_id" value="">
                                <option value="" selected disabled>Seleciona un cliente</option>
                                @foreach($clients as $client)
                                <option value="{{$client->id}}">{{$client->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="form-group" hidden id="creditDiv">
                            <label for="credit_id">Selecciona un crédito</label>
                            <select id="credit_id" class="form-control" name="credit_id">
                            </select>
                        </div> --}}
                        <div class="form-row" id="dates">
                            <div class="form-group col-6">
                                <label for="start_date">Fecha Inicio</label>
                                <input type="date" class="form-control" name="start_date" id="start_date" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="end_date">Fecha Fin</label>
                                <input type="date" class="form-control" name="end_date" id="end_date" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button style="float: right;" type="submit" class="btn btn-success">Generar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="application/javascript">
    document.getElementById('report_type').addEventListener('change', (event) => {
        document.getElementById('clientDiv').hidden = true;
        document.getElementById('dates').hidden = false;

        if (event.target.value == 'Cuenta') {
            document.getElementById('clientDiv').hidden = false;
        }
        if (event.target.value == 'Total') {
            document.getElementById('dates').hidden = true;
            document.getElementById('start_date').required = false;
            document.getElementById('end_date').required = false;
            document.getElementById('TotalOfD').innerHTML = "Total del día: " + getFormatDay();
        }
    })

    function getFormatDay() {
        let date = new Date();
        return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear()
    }

    $('#client_id').on('change', function() {
        var clientID = $(this).val();
        if (clientID) {
            $.ajax({
                url: '/showCredits/' + clientID,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {

                    if (data) {
                        $('#credit_id').empty();
                        $('#credit_id').focus;
                        $('#credit_id').append('<option value="">-- Seleccione un credito --</option>');
                        $.each(data, function(key, value) {
                            $('select[name="credit_id"]').append('<option value="' + value.id + '">' + 'Numero de credito: ' + value.num_credit + ' | Total de crédito:' + value.total_credit + ' ' + '</option>');
                        });
                    } else {
                        $('#credit_id').empty();
                    }
                }
            });
        } else {
            $('#credit_id').empty();
        }
    });
</script>

@endsection