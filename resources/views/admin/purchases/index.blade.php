@extends('adminlte::page')

@section('content_header')
    <x-pages.page-header :title="$title" :breadcrumbs="[
        ['label' => 'Inicio', 'route' => 'home'],
        ['label' => 'Compras', 'route' => 'purchases'],
        ['label' => 'Listado de Compras'],
    ]" icon="fas fa-fw fa-shopping-cart" />
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title "><i class="fa-solid fa-clipboard-list"></i>&nbsp;Compras Registradas</h3>

                    <div class="card-tools">
                        <a href="{{ route('purchases.create') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                            <i class="fa-solid fa-circle-plus"></i>&nbsp;Nueva Compra
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="dataTable"
                        class="table table-bordered table-striped table-hover table-sm table-responsive-sm table-responsive-md">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Proveedor</th>
                                <th class="text-center">Fecha de Compra</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->supplier->company }}</td>
                                    <td class="text-center">{{ $item->purchased_at | date('Y-m-d') }}</td>
                                    <td class="text-center">L&nbsp;{{ $item->total }}</td>
                                    <td class="text-center">
                                        @switch($item->payment_status)
                                            @case('pagada')
                                                <span class="badge badge-success rounded-pill px-2">Pagada</span>
                                            @break

                                            @case('pendiente')
                                                <span class="badge badge-warning rounded-pill px-2">Pendiente</span>
                                            @break

                                            @case('cancelada')
                                                <span class="badge badge-secondary rounded-pill px-2">Cancelada</span>
                                            @break

                                            @default
                                                <span class="badge badge-danger rounded-pill px-2">?</span>
                                        @endswitch
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('purchases.show', $item->id) }}"
                                                class="btn btn-sm btn-info rounded-pill px-3">
                                                <i class="fa-solid fa-eye"></i>&nbsp;Ver
                                            </a>
                                            <a href="{{ route('purchases.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning rounded-pill px-3 ml-2">
                                                <i class="fa-solid fa-pen-to-square"></i>&nbsp;Editar
                                            </a>
                                            <x-delete-button :action="route('purchases.destroy', $item->id)" :item-id="$item->id" label="Eliminar" />
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
