@extends('layouts.light.master')
@section('title', 'Layout Light')
@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Cajas</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Listado</li>
<li class="breadcrumb-item active">Cajas</li>
@endsection
<div class="modal fade" id="boxEditModal" tabindex="-1" role="dialog" aria-labelledby="boxEditModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="boxEditModalLabel">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="myFormEdit" action="/box" method="post" onsubmit="upperCreate()">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="name">Número de caja</label>
                            <input class="form-control" type="number" name="number" id="number_edit" placeholder="123" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="name">Sucursal</label>
                            <select id="branch_id_edit" class="custom-select" name="branch_id" placeholder="Sucursal" required>
                                @foreach($branches as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
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
@include('boxes.addIncome')
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
    <div class="row">
        <div class="col-sm-12">
            @if(isset($flag))
            <div class="card p-4 mx-5">
                <div class="row d-flex justify-content-center">
                    <h5>Abrir caja</h5>
                </div>
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
                <form action="cashClosing" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="branch_id">Sucursal</label>
                        <select class="custom-select" id="branch_id" name="branch_id">
                            <option value="" selected hidden>Seleccione una sucursal</option>
                            @foreach ($branches as $branch)
                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="box_id">Caja</label>
                        <select class="custom-select" id="box_id" name="box_id" required>
                        </select>
                    </div>
                    <div class="form-group" id="amountInitial" hidden>
                        <label for="initial_cash">Monto inicial</label>
                        <input type="number" min="1" class="form-control" id="initial_cash" name="initial_cash">
                    </div>
                    <button id="openBoxButton" type="submit" class="btn btn-primary btn-block mt-3" disabled>ABRIR CAJA</button>
                </form>
            </div>
            @else
            <div class="modal fade" id="openCashBoxModal" tabindex="-1" aria-labelledby="openCashBoxModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="openCashBoxModalLabel">Cerrar caja</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="closeBox/{{$box->id}}" target="_blank" method="POST" onsubmit="closeModal()">
                            @csrf
                            <div class="modal-body">
                                ¿Está seguro de cerrar su caja?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">CANCELAR</button>
                                <button type="submit" class="btn btn-primary">CERRAR CAJA</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div style="text-align:right">
                <button id="closeBoxButton" type="button" class="btn btn-outline-secondary btn-sm my-2" data-toggle="modal" data-target="#openCashBoxModal">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-dash-fill mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM4 14a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm7 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM6.5 7a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4z" />
                    </svg>
                    <small>CERRAR CAJA</small>
                </button>
            </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="mb-2" style="padding-bottom: 1%;">
                        <h5>Agregar caja</h5>
                    </div>
                    <form action="/box" method="POST" style="padding-bottom: 2%;">
                        @csrf
                        <div class="input-group my-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="branch_office_id">Sucursal</span>
                            </div>
                            <select id="branch_id" class="custom-select" name="branch_id" placeholder="Sucursal" required>
                                @foreach($branches as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group my-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Número de la caja</span>
                            </div>
                            <input type="text" class="form-control" name="number" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit" id="button-addon">AGREGAR</button>
                            </div>
                        </div>
                    </form>
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Número de caja</th>
                                <th>Sucursal</th>
                                <th>Estado</th>
                                <th>Acciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($boxes as $item)
                            <tr>
                                <td class="text-center">{{$item->number}}</td>
                                <td class="text-center">{{$item->Branch->name}}</td>
                                @if($item->status == false)
                                <td class="text-center" style="color: green;">Disponible</td>
                                @else
                                <td class="text-center" style="color: red;">No disponible</td>
                                @endif
                                <td>
                                    <button onclick="setIdBox({{$item}})" type="button" class="btn btn-success btn-sm my-2" data-toggle="modal" data-target="#incomeCashBoxModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 172 172" style=" fill:#000000;">
                                            <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                                <path d="M0,172v-172h172v172z" fill="none"></path>
                                                <g fill="#ffffff">
                                                    <path d="M2.6875,0c-1.48427,0 -2.6875,1.20323 -2.6875,2.6875v75.25v10.75v10.75v10.75v10.75c0,1.48427 1.20323,2.6875 2.6875,2.6875h40.3125v-5.375h-37.625v-5.375h37.625v-5.375h-37.625v-5.375h26.875v-5.375h-26.875v-5.375h75.25h21.5v-5.375h-96.75v-5.375h96.75v-5.375h-96.75v-69.875h145.125v51.0625h5.375v-53.75c0,-1.48427 -1.20323,-2.6875 -2.6875,-2.6875zM80.625,91.375c-18.08419,0 -32.25,8.26406 -32.25,18.8125v10.75v10.75v10.75v10.75c0,10.54844 14.16581,18.8125 32.25,18.8125c13.40429,0 24.63674,-4.54543 29.5625,-11.19092c4.92576,6.64549 16.15821,11.19092 29.5625,11.19092c18.08419,0 32.25,-8.26406 32.25,-18.8125v-10.75v-10.75v-10.75v-10.75v-10.75v-10.75v-10.75c0,-10.54844 -14.16581,-18.8125 -32.25,-18.8125c-18.08419,0 -32.25,8.26406 -32.25,18.8125v10.75v10.75v0.22571c-5.7301,-5.03057 -15.52718,-8.28821 -26.875,-8.28821zM13.4375,10.75c-1.48427,0 -2.6875,1.20323 -2.6875,2.6875v10.75v32.25v10.75c0,1.48427 1.20323,2.6875 2.6875,2.6875h10.75h77.9375v-5.375h-7.27515c7.90469,-5.52075 12.62483,-14.54581 12.65015,-24.1875c-0.01461,-9.63929 -4.72784,-18.66613 -12.62915,-24.1875h37.08435c1.08489,5.27516 5.20714,9.39741 10.4823,10.4823v29.8302h5.375v-32.25v-10.75c0,-1.48427 -1.20323,-2.6875 -2.6875,-2.6875h-10.75h-110.1875zM16.125,16.125h4.90784c-0.81334,2.29042 -2.61655,4.0917 -4.90784,4.90259zM26.6073,16.125h34.38635c-7.88009,5.53118 -12.57316,14.55313 -12.57838,24.18068c-0.00522,9.62755 4.67805,18.65459 12.55214,24.19432h-34.36011c-1.08489,-5.27516 -5.20714,-9.39741 -10.4823,-10.4823v-27.4104c5.27516,-1.08489 9.39741,-5.20714 10.4823,-10.4823zM77.9375,16.125c13.35163,0.01629 24.17121,10.83587 24.1875,24.1875c0,13.35839 -10.82911,24.1875 -24.1875,24.1875c-13.35839,0 -24.1875,-10.82911 -24.1875,-24.1875c0,-13.35839 10.82911,-24.1875 24.1875,-24.1875zM137.53491,16.125h4.90259v4.90784c-2.29042,-0.81334 -4.0917,-2.61655 -4.90259,-4.90784zM75.25,21.5v5.375c-4.4528,0 -8.0625,3.6097 -8.0625,8.0625c0,4.4528 3.6097,8.0625 8.0625,8.0625v5.375h-5.375v5.375h5.375v5.375h5.375v-5.375c4.4528,0 8.0625,-3.6097 8.0625,-8.0625c0,-4.4528 -3.6097,-8.0625 -8.0625,-8.0625v-5.375h5.375v-5.375h-5.375v-5.375zM75.25,32.25v5.375c-1.48427,0 -2.6875,-1.20323 -2.6875,-2.6875c0,-1.48427 1.20323,-2.6875 2.6875,-2.6875zM29.5625,37.625v5.375h5.375v-5.375zM123.625,37.625v5.375h5.375v-5.375zM80.625,43c1.48427,0 2.6875,1.20323 2.6875,2.6875c0,1.48427 -1.20323,2.6875 -2.6875,2.6875zM16.125,59.59216c2.29042,0.81334 4.0917,2.61655 4.90259,4.90784h-4.90259zM139.75,64.5c14.56625,0 26.875,6.15438 26.875,13.4375c0,7.28312 -12.30875,13.4375 -26.875,13.4375c-14.56625,0 -26.875,-6.15438 -26.875,-13.4375c0,-7.28312 12.30875,-13.4375 26.875,-13.4375zM139.75,67.1875c-10.6855,0 -21.5,3.69262 -21.5,10.75c0,7.05738 10.8145,10.75 21.5,10.75c10.6855,0 21.5,-3.69262 21.5,-10.75c0,-7.05738 -10.8145,-10.75 -21.5,-10.75zM139.75,72.5625c10.00288,0 16.125,3.49375 16.125,5.375c0,1.88125 -6.12212,5.375 -16.125,5.375c-10.00288,0 -16.125,-3.49375 -16.125,-5.375c0,-1.88125 6.12212,-5.375 16.125,-5.375zM112.875,88.46179c5.7301,5.03057 15.52718,8.28821 26.875,8.28821c11.34782,0 21.1449,-3.25764 26.875,-8.28821v0.22571c0,7.28312 -12.30875,13.4375 -26.875,13.4375c-14.56625,0 -26.875,-6.15438 -26.875,-13.4375zM37.625,96.75v5.375h5.375v-5.375zM80.625,96.75c14.56625,0 26.875,6.15438 26.875,13.4375c0,7.28312 -12.30875,13.4375 -26.875,13.4375c-14.56625,0 -26.875,-6.15438 -26.875,-13.4375c0,-7.28312 12.30875,-13.4375 26.875,-13.4375zM112.875,99.21179c5.7301,5.03057 15.52718,8.28821 26.875,8.28821c11.34782,0 21.1449,-3.25764 26.875,-8.28821v0.22571c0,7.28312 -12.30875,13.4375 -26.875,13.4375c-14.56625,0 -26.875,-6.15438 -26.875,-13.4375zM80.625,99.4375c-10.6855,0 -21.5,3.69263 -21.5,10.75c0,7.05737 10.8145,10.75 21.5,10.75c10.6855,0 21.5,-3.69263 21.5,-10.75c0,-7.05737 -10.8145,-10.75 -21.5,-10.75zM80.625,104.8125c10.00288,0 16.125,3.49375 16.125,5.375c0,1.88125 -6.12212,5.375 -16.125,5.375c-10.00288,0 -16.125,-3.49375 -16.125,-5.375c0,-1.88125 6.12212,-5.375 16.125,-5.375zM112.875,109.96179c5.7301,5.03057 15.52718,8.28821 26.875,8.28821c11.34782,0 21.1449,-3.25764 26.875,-8.28821v0.22571c0,7.28312 -12.30875,13.4375 -26.875,13.4375c-14.56625,0 -26.875,-6.15438 -26.875,-13.4375zM53.75,120.71179c5.7301,5.03057 15.52718,8.28821 26.875,8.28821c11.34782,0 21.1449,-3.25764 26.875,-8.28821v0.22571c0,7.28313 -12.30875,13.4375 -26.875,13.4375c-14.56625,0 -26.875,-6.15437 -26.875,-13.4375zM112.875,120.71179c5.7301,5.03057 15.52718,8.28821 26.875,8.28821c11.34782,0 21.1449,-3.25764 26.875,-8.28821v0.22571c0,7.28313 -12.30875,13.4375 -26.875,13.4375c-14.56625,0 -26.875,-6.15437 -26.875,-13.4375zM53.75,131.46179c5.7301,5.03057 15.52718,8.28821 26.875,8.28821c11.34782,0 21.1449,-3.25764 26.875,-8.28821v0.22571c0,7.28313 -12.30875,13.4375 -26.875,13.4375c-14.56625,0 -26.875,-6.15437 -26.875,-13.4375zM112.875,131.46179c5.7301,5.03057 15.52718,8.28821 26.875,8.28821c11.34782,0 21.1449,-3.25764 26.875,-8.28821v0.22571c0,7.28313 -12.30875,13.4375 -26.875,13.4375c-14.56625,0 -26.875,-6.15437 -26.875,-13.4375zM53.75,142.21179c5.7301,5.03057 15.52718,8.28821 26.875,8.28821c11.34782,0 21.1449,-3.25764 26.875,-8.28821v0.22571c0,7.28313 -12.30875,13.4375 -26.875,13.4375c-14.56625,0 -26.875,-6.15437 -26.875,-13.4375zM112.875,142.21179c5.7301,5.03057 15.52718,8.28821 26.875,8.28821c11.34782,0 21.1449,-3.25764 26.875,-8.28821v0.22571c0,7.28313 -12.30875,13.4375 -26.875,13.4375c-14.56625,0 -26.875,-6.15437 -26.875,-13.4375zM53.75,152.96179c5.7301,5.03057 15.52718,8.28821 26.875,8.28821c11.34782,0 21.1449,-3.25764 26.875,-8.28821v0.22571c0,7.28313 -12.30875,13.4375 -26.875,13.4375c-14.56625,0 -26.875,-6.15437 -26.875,-13.4375zM112.875,152.96179c5.7301,5.03057 15.52718,8.28821 26.875,8.28821c11.34782,0 21.1449,-3.25764 26.875,-8.28821v0.22571c0,7.28313 -12.30875,13.4375 -26.875,13.4375c-14.56625,0 -26.875,-6.15437 -26.875,-13.4375z"></path>
                                                </g>
                                            </g>
                                        </svg>
                                        <small>INGRESO</small>
                                    </button>
                                    <button onclick="llenar({{$item}})" type="button" class="btn btn-primary btn-sm my-2" data-toggle="modal" data-target="#boxEditModal">
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
        $('button').click(function() {
            if ($(this).data('type') == 'delete') {
                $('#deleteForm').attr('action', 'box/' + $(this).data('id'));

            }
        });
        $('#branch_id').change(function() {
            getBoxes();
        });

        function getBoxes() {
            $('#box_id').empty();
            $.ajax({
                url: "/getBox/" + $('#branch_id').val(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                contentType: "application/json; charset=iso-8859-1",
                data: null,
                dataType: 'html',
                success: function(data) {
                    let boxes = JSON.parse(data);
                    if (boxes.length !== 0) {
                        $('#openBoxButton').prop('disabled', false);
                        //amountInitial
                        $('#amountInitial').prop('hidden', false)
                        $('#initial_cash').prop('required', true)
                    }
                    boxes.forEach((box) => {
                        $('#box_id').append(
                            $('<option></option>').val(box.id).text(box.number)
                        );
                    });
                },
                error: function(e) {
                    console.log("ERROR", e);
                },
            });
        }

    })

    function closeModal() {
        $('#openCashBoxModal').modal('hide');
        $('#closeBoxButton').prop('hidden', true);
    }

    function setIdBox(item) {
        document.getElementById('box_id_income').value = item.id
        document.getElementById('incomeCashBoxModalLabel').innerHTML = "Ingreso a caja " + item.id
    }

    function llenar(item) {
        console.log(item)
        document.getElementById("myFormEdit").action = "/box/" + item.id;

        document.getElementById('number_edit').value = item.number
        document.getElementById('branch_id_edit').value = item.branch.id
    }
</script>

@endsection