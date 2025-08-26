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
                        <li class="breadcrumb-item active" aria-current="page">Creación de Categorias</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos de la categoría</h3>

                    <div class="card-tools">
                        <a href="{{ url('/admin/categories') }}" class="btn btn-sm px-2">
                            <i class="bi bi-plus-circle me-2"></i>Volver
                        </a>
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <form method="POST" action="{{ url('admin/categories/store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="form-label">Nombre de la categoría <sup class="text-danger">*</sup></label>
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text">
                                            <i class="fas fa-tags"></i>
                                        </span>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Ingrese el nombre de la categoría" maxlength="100" autofocus required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="form-label">Descripción de la categoría <sup class="text-danger">(Opcional)</sup></label>
                                    <textarea class="form-control" id="description" name="description" rows="3"
                                        placeholder="Ingrese una descripción para la categoría" maxlength="255"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('/admin/categories/create') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save2 me-2"></i>Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
