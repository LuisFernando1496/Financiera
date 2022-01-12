@extends('layouts.light.master')
@section('title', 'Layout Light')
@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Usuarios</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Listado</li>
<li class="breadcrumb-item active">Usuarios</li>
@endsection

@include('users.create')
@include('users.edit')
@include('users.delete')

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
                    <div class="float-right">
                        <button id="newUser" class=" btn btn-outline-primary">Nuevo Usuario</button>
                    </div>
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Nombre(s)</th>
                                <th>Apellidos</th>
                                <th>Correo</th>
                                <th>Sucursal</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                @if($user->status == 1)
                                <td style="color: green;">Activo</td>
                                @else
                                <td style="color: red;">Inactivo</td>
                                @endif
                                <td>{{$user->name}}</td>
                                <td>{{$user->last_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->branch->name}}</td>
                                @if($user->getRoleNames()->first() == 'manager')
                                <td>Gerente</td>
                                @else
                                <td>Administrador</td>
                                @endif
                                <td>
                                    <button onclick="llenar({{$user}})" class="btn btn-info" data-toggle="modal" data-target="#userModalEdit">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                        </svg>
                                    </button>
                                    <button onclick="confirmDelete({{$user}})" class="btn btn-danger" data-toggle="modal" data-target="#deleteuserModal">
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
        $('#newUser').click(function() {
            $('#userModal').modal();
        });
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
    }

    function llenar(item) {
        document.getElementById("userModalEditForm").action = "/user/" + item.id;

        console.log(item.roles)
        document.getElementById('nameEdit').value = item.name
        document.getElementById('last_nameEdit').value = item.last_name
        document.getElementById('emailEdit').value = item.email
        document.getElementById('branch_idEdit').value = item.branch.id
        document.getElementById('rolEdit').value = item.roles[0].name
    }


    function confirmDelete(item) {
        $('#deleteForm').attr('action', 'user/' + item.id);
    }
</script>

@endsection