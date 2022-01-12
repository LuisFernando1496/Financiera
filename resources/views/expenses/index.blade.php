@extends('layouts.light.master')
@section('title', 'Layout Light')
@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Gastos-Desembolsos</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Listado</li>
<li class="breadcrumb-item active">Gasto-Desembolso</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-right" style="padding-bottom: 2%;">
                    <a class="btn btn-outline-primary" href="/new-expense">Nuevo gasto</a>
                      
                    </div>
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Usuario autorizado</th>
                                <th>Sucursal</th>
                            
                         
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($expenses as $item)
                            <tr>
                                <td>{{$item->quantity}} </td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->branch->name}}</td>
                               
                                
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