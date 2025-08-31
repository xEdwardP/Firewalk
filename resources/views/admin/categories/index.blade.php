@extends('adminlte::page')

{{-- @section('title', 'Categorias') --}}

@section('content_header')
    <x-pages.page-header :title="$title" :breadcrumbs="[
        ['label' => 'Inicio', 'route' => 'home'],
        ['label' => 'Categorias', 'route' => 'categories.index'],
        ['label' => 'Listado de Categorias'],
    ]" icon="fas fa-fw fa-list" />
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title "><i class="fa-solid fa-clipboard-list"></i>&nbsp;Categorias Registradas</h3>

                    <div class="card-tools">
                        <a href="{{ url('/admin/categories/create') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                            <i class="fa-solid fa-circle-plus"></i>&nbsp; Nueva Categoría
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered table-striped table-hover table-sm table-responsive-sm table-responsive-md">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #</th>
                                <th class="text-center">
                                    Nombre</th>
                                <th class="text-center">
                                    Descripción</th>
                                <th class="text-center">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('categories.show', $item->id) }}"
                                                class="btn btn-sm btn-info rounded-pill px-3">
                                                <i class="fa-solid fa-eye"></i>&nbsp;Ver
                                            </a>
                                            <a href="{{ route('categories.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning rounded-pill px-3 ml-2">
                                                <i class="fa-solid fa-pen-to-square"></i>&nbsp;Editar
                                            </a>
                                            <x-delete-button :action="route('categories.destroy', $item->id)" :item-id="$item->id" label="Eliminar" />
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
