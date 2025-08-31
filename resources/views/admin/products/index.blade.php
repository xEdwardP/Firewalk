@extends('adminlte::page')

@section('content_header')
    <x-pages.page-header :title="$title" :breadcrumbs="[
        ['label' => 'Inicio', 'route' => 'home'],
        ['label' => 'Productos', 'route' => 'products'],
        ['label' => 'Listado de Productos'],
    ]" icon="fas fa-fw fa-boxes" />
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title "><i class="fa-solid fa-clipboard-list"></i>&nbsp;Productos Registrados</h3>

                    <div class="card-tools">
                        <a href="{{ route('products.create') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                            <i class="fa-solid fa-circle-plus"></i>&nbsp; Nuevo Producto
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="dataTable" class="table table-bordered table-striped table-hover table-sm table-responsive-sm table-responsive-md">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Código</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Categoría</th>
                                <th class="text-center">Precio Venta</th>
                                <th class="text-center">Presentación</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-center">{{ $item->category->name }}</td>
                                    <td class="text-center">L&nbsp;{{ $item->selling_price }}</td>
                                    <td class="text-center">{{ $item->presentation }}</td>
                                    <td class="text-center">
                                        @if ($item->is_active == 1)
                                            <span class="badge badge-success rounded-pill px-2">Activo</span>
                                        @else
                                            <span class="badge badge-danger rounded-pill px-2">Inactivo</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('products.show', $item->id) }}"
                                                class="btn btn-sm btn-info rounded-pill px-3">
                                                <i class="fa-solid fa-eye"></i>&nbsp;Ver
                                            </a>
                                            <a href="{{ route('products.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning rounded-pill px-3 ml-2">
                                                <i class="fa-solid fa-pen-to-square"></i>&nbsp;Editar
                                            </a>
                                            <x-delete-button :action="route('products.destroy', $item->id)" :item-id="$item->id" label="Eliminar" />
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
