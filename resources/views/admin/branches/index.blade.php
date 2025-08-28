@extends('adminlte::page')

@section('content_header')
    <x-pages.page-header :title="$title" :breadcrumbs="[
        ['label' => 'Inicio', 'route' => 'home'],
        ['label' => 'Sucursales', 'route' => 'branches'],
        ['label' => 'Listado de Sucursales'],
    ]" icon="fas fa-fw fa-building" />
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
                                <th class="text-center">#</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Dirección</th>
                                <th class="text-center">Teléfono</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td class="text-center">{{ $item->phone }}</td>
                                    <td class="text-center">
                                        @if ($item->is_active == 1)
                                            <span class="badge badge-success rounded-pill px-2">Activo</span>
                                        @else
                                            <span class="badge badge-danger rounded-pill px-2">Inactivo</span>
                                        @endif
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
                                            <x-delete-button :action="route('branches.destroy', $item->id)" :item-id="$item->id" label="Eliminar" />
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
