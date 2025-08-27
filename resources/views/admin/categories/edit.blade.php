@extends('adminlte::page')

{{-- @section('title', 'Categorias') --}}

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
                        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorias</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edición de Categorias</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa-solid fa-clipboard-list"></i>&nbsp;Datos de la categoría</h3>

                    <div class="card-tools">
                        <a href="{{ route('categories.index') }}" class="btn btn-sm px-2">
                            <i class="fa-solid fa-arrow-left"></i>&nbsp;Volver
                        </a>
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <form method="POST" action="{{ route('categories.update', $item->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="form-label">Nombre de la categoría <sup
                                            class="text-danger">*</sup></label>
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text">
                                            <i class="fas fa-tags"></i>
                                        </span>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Ingrese el nombre de la categoría" maxlength="100" required
                                            autofocus value="{{ old('name', $item->name) }}">
                                    </div>
                                    <x-error field="name" class="mt-1" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="form-label">Descripción de la categoría <sup
                                            class="text-danger">(Opcional)</sup></label>
                                    <textarea class="form-control" id="description" name="description" rows="3"
                                        placeholder="Ingrese una descripción para la categoría" maxlength="255">{{ old('description', $item->description) }}</textarea>
                                </div>
                                <x-error field="description" class="mt-1" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ route('categories.edit', $item->id) }}" class="btn btn-secondary"><i
                                            class="fa-solid fa-ban"></i>&nbsp;Cancelar</a>
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
