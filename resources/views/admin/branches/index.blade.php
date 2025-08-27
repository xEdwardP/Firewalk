@extends('adminlte::page')

{{-- @section('title', 'Sucursales') --}}

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fa-solid fa-list"></i>&nbsp;{{ $title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('branches') }}">Sucursales</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Listado de Sucursales</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title "><i class="fa-solid fa-clipboard-list"></i>&nbsp;Sucursales Registradas</h3>

                    <div class="card-tools">
                        <a href="{{ route('branches.create') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                            <i class="fa-solid fa-circle-plus"></i>&nbsp; Nueva Sucursal
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase small text-muted fw-semibold">
                                    #</th>
                                <th class="text-center text-uppercase small text-muted fw-semibold">
                                    Nombre</th>
                                <th class="text-center text-uppercase small text-muted fw-semibold">
                                    Dirección</th>
                                <th class="text-center text-uppercase small text-muted fw-semibold">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('branches.show', $item->id) }}"
                                                class="btn btn-sm btn-info rounded-pill px-3">
                                                <i class="fa-solid fa-eye"></i>&nbsp;Ver
                                            </a>
                                            <a href="{{ route('branches.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning rounded-pill px-3 ml-2">
                                                <i class="fa-solid fa-pen-to-square"></i>&nbsp;Editar
                                            </a>
                                            <x-delete-button :action="route('branches.destroy', $item->id)" :item-id="$item->id"
                                                label="Eliminar" />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    @include('utils.dataTable.dataTableConfig')
@stop
