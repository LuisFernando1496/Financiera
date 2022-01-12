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
<li class="breadcrumb-item active">Clientes sugeridos para visita</li>
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
        @if ($creditsTotal->isEmpty())
            <div><strong><h4>La tabla está vacía</h4></strong></div>
            <div>No se muestra nigún cliente que tenga como fecha de vencimiento este día</div>
        @endif{{ $creditsTotal }}
        @foreach ($creditsTotal as $credit)
        <table id="example" class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th class="text-white text-center table-dark" colspan="12">DATOS DEL CLIENTE</th>
                </tr>
                <tr>
                    <th scope="col">Visitar</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Tipo de crédito</th>
                    {{-- <th scope="col">Estado del crédito</th> --}}
                    <th scope="col">Meses del crédito</th>
                    <th scope="col">Último pago</th>
                    <th scope="col">Fecha Límite</th>
                    <th scope="col">Total préstamo</th>
                    <th scope="col">Crédito restante</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        {{-- <td> <input type="checkbox" name="visitaID[]" id="visitaID" onchange="visit()" value="{{ $credit->client_id }}">{{ $credit->client_id }}</td> --}}
                        @if ($credit->visitStatus == 0)
                            <td> <button class="badge bg-success text-dark center" name="visitaID" id="visitaID" onclick="visits({{ $credit->client_id }})">Visitar</button></td>
                        @else
                            <td><button class="badge bg-warning disabled text-dark center">En proceso</button></td>
                        @endif
                        <td>{{ $credit->clientName }} {{ $credit->clientLastName }}</td>
                        <td>{{ $credit->clientPhone }}</td>
                        <td>{{ $credit->address1 }}, {{ $credit->addressStreet }}, {{ $credit->addressNum }}, {{ $credit->clientCity }}, {{ $credit->clientState }}, {{ $credit->clientCountry }}</td>
                        <td>{{ $credit->creditType }}</td>
                        {{-- <td>{{ $credit->statusCredit }}</td> --}}
                        <td>{{ $credit->creditTime }}</td>
                        @if ($credit->totalCredit != $credit->creditRest)
                            <td>{{ $credit->lastPaymentDate }}</td>
                        @else
                            <td>No existe un pago anterior.<strong>Primer pago</strong></td>
                        @endif
                        <td>{{ $credit->dateLimit }}</td>
                        <td>{{ $credit->totalCredit }}</td>
                        <td>{{ $credit->creditRest }}</td>
                        <td></td>
                    </tr>
                <tr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-white text-center table-success" colspan="12">DATOS DEL AVAL</th>
                            </tr>
                            <tr>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($creditsTotal as $credit) --}}
                                <tr>
                                    <td>{{ $credit->avalName }} {{ $credit->avalLastname1 }} {{ $credit->avalLastname2 }}</td>
                                    <td>{{ $credit->avalPhone }}</td>
                                </tr>
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                </tr>
            </tbody>
        </table><hr>
        @endforeach
            <div class="d-flex justify-content-center">
                {!! $creditsTotal->links() !!}
            </div>
        </div>
    </div>
</div>
{{-- https://stackoverflow.com/questions/2204250/check-if-checkbox-is-checked-with-jquery
    https://stackoverflow.com/questions/6166763/jquery-multiple-checkboxes-array--}}
@endsection
@section('script')
<script>
    function visits(id){
        $.ajax({
            type:'GET',
            async:true,
            url:'visitInProcess/' + id,
            success:function(data){
                location.reload(true);
                // alert("done")

            }
        });
        // console.log(id)
    }

</script>
@endsection
