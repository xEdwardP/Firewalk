@extends('adminlte::page')

@section('content_header')
    <x-pages.page-header :title="$title" :breadcrumbs="[
        ['label' => 'Inicio', 'route' => 'home'],
        ['label' => 'Inventario'],
        ['label' => 'Lotes'],
        ['label' => 'Listado de Lotes'],
    ]" icon="fas fa-box" />
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center py-2">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-warehouse"></i>&nbsp;Lotes Registrados
                    </h5>
                </div>

                <div class="card-body table-responsive">
                    <table id="dataTable" class="table table-bordered table-hover table-sm">
                        <thead class="thead-light">
                            <tr class="text-center align-middle">
                                <th>#</th>
                                <th>Código de Lote</th>
                                <th>Producto</th>
                                <th>Proveedor</th>
                                <th>Vencimiento</th>
                                <th>Cantidad Actual</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($batches as $batch)
                                <tr class="{{ $batch->is_expired ? 'table-danger' : '' }}">
                                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                    <td class="text-center align-middle">{{ $batch->batch_code }}</td>
                                    <td class="align-middle">{{ $batch->product->name }}</td>
                                    <td class="align-middle">{{ $batch->supplier->name }}</td>
                                    <td class="text-center align-middle">{{ $batch->expires_at }}</td>
                                    <td class="text-center align-middle">{{ $batch->remaining_quantity }}</td>
                                    <td class="text-center align-middle">
                                        <span
                                            class="badge badge-pill
                                        {{ $batch->is_expired ? 'badge-danger' : 'badge-success' }}">
                                            {{ $batch->is_expired ? 'Vencido' : 'Vigente' }}
                                        </span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <button type="button" class="btn btn-sm btn-info rounded-pill px-3"
                                            data-toggle="modal" data-target="#ModalShow{{ $batch->id }}">
                                            <i class="fas fa-eye"></i>&nbsp;Ver
                                        </button>

                                        <div class="modal fade" id="ModalShow{{ $batch->id }}" tabindex="-1"
                                            role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content border-0 shadow">
                                                    <div class="modal-header bg-info text-white">
                                                        <h5 class="modal-title">
                                                            <i class="fas fa-box-open"></i>&nbsp;Detalles del Lote
                                                        </h5>
                                                        <button type="button" class="close text-white" data-dismiss="modal"
                                                            aria-label="Cerrar">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="text-muted">Código de Lote</label>
                                                                <p class="font-weight-bold mb-0">{{ $batch->batch_code }}
                                                                </p>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="text-muted">Producto</label>
                                                                <p class="mb-0">{{ $batch->product->name }}</p>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label class="text-muted">Proveedor</label>
                                                                <p class="mb-0">{{ $batch->supplier->name }}</p>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="text-muted">Estado</label>
                                                                <div class="d-flex align-items-center justify-content-center">
                                                                    <i
                                                                        class="fas {{ $batch->is_expired ? 'fa-times-circle text-danger' : 'fa-check-circle text-success' }} mr-2"></i>
                                                                    <span
                                                                        class="badge badge-pill {{ $batch->is_expired ? 'badge-danger' : 'badge-success' }}">
                                                                        {{ $batch->is_expired ? 'Vencido' : 'Vigente' }}
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label class="text-muted">Fecha de Entrada</label>
                                                                <p class="mb-0">{{ $batch->received_at }}</p>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="text-muted">Fecha de Vencimiento</label>
                                                                <p class="mb-0">{{ $batch->expires_at }}</p>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label class="text-muted">Cantidad Inicial</label>
                                                                <p class="mb-0">{{ $batch->starting_quantity }}</p>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="text-muted">Cantidad Actual</label>
                                                                <p class="mb-0">{{ $batch->remaining_quantity }}</p>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label class="text-muted">Precio de Compra</label>
                                                                <p class="mb-0">L
                                                                    {{ number_format($batch->purchase_price, 2) }}</p>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="text-muted">Precio de Venta</label>
                                                                <p class="mb-0">L
                                                                    {{ number_format($batch->sale_price, 2) }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
