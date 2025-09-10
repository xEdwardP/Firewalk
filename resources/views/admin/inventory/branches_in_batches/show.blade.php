@extends('adminlte::page')

@section('content_header')
    <x-pages.page-header :title="$title" :breadcrumbs="[
        ['label' => 'Inicio', 'route' => 'home'],
        ['label' => 'Inventario'],
        ['label' => 'Inventario de sucursales por lotes', 'route' => 'branches_in_batches'],
        ['label' => 'Inventario de sucursal'],
    ]" icon="fas fa-fw fa-map-marked-alt" />
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title "><i class="fa-solid fa-clipboard-list"></i>&nbsp;Inventario Registrado</h3>
                </div>
                <div class="card-body table-responsive">
                    <table id="dataTable"
                        class="table table-bordered table-striped table-hover table-sm table-responsive-sm table-responsive-md">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Lote</th>
                                <th class="text-center">Producto</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Proveedor</th>
                                <th class="text-center">Fecha de Entrada</th>
                                <th class="text-center">Fecha de Vencimiento</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->batch->batch_code }}</td>
                                    <td>{{ $item->batch->product->name }}</td>
                                    <td class="text-center">{{ $item->branch_quantity }}</td>
                                    <td class="text-center">{{ $item->batch->supplier->name }}</td>
                                    <td class="text-center">{{ $item->batch->received_at | date('Y-m-d') }}</td>
                                    <td class="text-center">{{ $item->batch->expires_at | date('Y-m-d') }}</td>
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

