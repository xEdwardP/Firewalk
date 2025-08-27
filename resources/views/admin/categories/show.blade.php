@extends('adminlte::page')

{{-- @section('title', 'Categorias') --}}

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fa-solid fa-list"></i>&nbsp;Categoría: {{ $item->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorias</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Datos de la categoría</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa-solid fa-clipboard-list"></i>&nbsp;Datos de la categoría</h3>

                    <div class="card-tools">
                        <a href="{{route('categories.index')}}" class="btn btn-sm px-2">
                            <i class="fa-solid fa-arrow-left"></i>&nbsp;Volver
                        </a>
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="form-label">Nombre de la categoría</label>
                                <div class="input-group-prepend mb-3">
                                    <span class="input-group-text">
                                        <i class="fas fa-tags"></i>
                                    </span>
                                    <input type="text" class="form-control" readonly value="{{ $item->name }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description" class="form-label">Descripción de la categoría</label>
                                <textarea class="form-control" rows="3" readonly>{{ $item->description }}</textarea>
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
