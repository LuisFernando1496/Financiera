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
@include('saving.paymentModal')
<li class="breadcrumb-item">Inversion </li>
<li class="breadcrumb-item active">Pago</li>
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
                    <div class="float-right" style="padding-bottom: 2%;">

                        <button id="newPay" class="btn btn-outline-primary">Nuevo pago</button>

                    </div>
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                        
                                <th>Fecha limite</th>
                                <th>fecha</th>
                             
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($savingPayments as $item)
                            <tr>
                               
                                <td class="text-center">{{$item->monto}}</td>
                                <td class="text-center">{{$item->fecha}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                               <th>Fecha limite</th>
                                <th>fecha</th>

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
<script>
    $(document).ready(function() {
        $('#newPay').click(function() {
            $('#paymentModal').modal();
        });
        
    });
</script>
@endsection