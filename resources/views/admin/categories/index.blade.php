@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/categories') }}">Categorias</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Listado de Categorias</li>
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
                    <h3 class="card-title">Categorias Registradas</h3>

                    <div class="card-tools">
                        <a href="{{ url('/admin/categories/create') }}" class="btn btn-primary btn-sm rounded-pill">
                            <i class="bi bi-plus-circle me-2"></i>Nueva Categoría
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase small text-muted fw-semibold">
                                    Nombre</th>
                                <th class="text-center text-uppercase small text-muted fw-semibold">
                                    Descripción</th>
                                <th class="text-center text-uppercase small text-muted fw-semibold">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="fw-medium ps-4">{{ $item->name }}</td>
                                    <td class="fw-medium ps-4">{{ $item->description }}</td>
                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="#" class="btn btn-sm btn-primary rounded-pill px-3">
                                                <i class="bi bi-pencil-square me-1"></i>Editar
                                            </a>
                                            <a href="#" class="btn btn-sm btn-danger rounded-pill px-3 ml-2">
                                                <i class="bi bi-trash3 me-1"></i>Eliminar
                                            </a>
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
