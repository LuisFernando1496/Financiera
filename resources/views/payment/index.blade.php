@extends('layouts.light.master')
@section('title', 'Layout Light')
@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Pagos</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Pagos</li>
<li class="breadcrumb-item active">Por cliente</li>
@endsection

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
                    <form method="post" action="/showPayments">
                        @csrf
                        <div class="form-group">
                            <label for="client_id">Selecciona una sucursal</label>
                            <select id="branch" class="form-control" name="branch_id" required>
                                <option value="0" disabled selected>-- Seleccione una sucursal --</option>
                                <option value="all">Todos</option>
                                @foreach($branches as $item)
                                <option value="{{$item->id}}">{{$item->name}} | {{$item->city}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="client_id">Selecciona un cliente</label>
                            <select id="client_id" class="form-control" name="client_id" required>


                            </select>
                        </div>
                        <div class="form-group">
                            <label for="credit_id">Selecciona un crédito</label>
                            <select id="credit_id" class="form-control" name="credit_id" required>


                            </select>
                        </div>

                        <div class="card-footer">
                            <button style="float: right;" type="submit" class="btn btn-success">Aceptar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script >


        $('#branch').on('change', function() {
            var branchID = $(this).val();
            if (branchID) {
                $.ajax({
                    url: '/showClients/' + branchID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {

                        if (data) {
                            $('#client_id').empty();
                            $('#client_id').focus;
                            $('#client_id').append('<option value="">-- Seleccione un cliente --</option>');
                            $.each(data, function(key, value) {
                                $('select[name="client_id"]').append('<option value="' + value.id + '">' + value.name + ' | ' + value.last_name + ' | ' + value.rfc + ' | ' + value.curp + ' ' + '</option>');
                            });
                        } else {
                            $('#client_id').empty();
                        }
                    }
                });
            } else {
                $('#client_id').empty();
            }
        });
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
