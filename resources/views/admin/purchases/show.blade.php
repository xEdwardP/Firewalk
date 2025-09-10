@extends('adminlte::page')

@section('content_header')
    <x-pages.page-header :title="$title" :breadcrumbs="[
        ['label' => 'Inicio', 'route' => 'home'],
        ['label' => 'Compras', 'route' => 'purchases'],
        ['label' => 'Datos de la Compra'],
    ]" icon="fas fa-fw fa-shopping-cart" />
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info shadow-sm">
                <div class="card-header py-2">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-file-invoice-dollar"></i>&nbsp;Datos Generales de la Compra
                    </h5>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="text-muted">Proveedor</label>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-tie text-info mr-2"></i>
                                <span class="font-weight-bold">{{ $purchase->supplier->company }}</span>
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="text-muted">Fecha de Compra</label>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar-alt text-info mr-2"></i>
                                <span>{{ $formattedDate }}</span>
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="text-muted">Estado de Compra</label>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-clipboard-check text-info mr-2"></i>
                                <span
                                    class="badge badge-pill
                                {{ $purchase->payment_status === 'finalizada'
                                    ? 'badge-success'
                                    : ($purchase->payment_status === 'pendiente'
                                        ? 'badge-warning'
                                        : 'badge-secondary') }}">
                                    {{ ucfirst($purchase->payment_status) }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="text-muted">Total de la Compra</label>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-money-bill-wave text-info mr-2"></i>
                                <span class="font-weight-bold">L {{ number_format($purchase->total, 2) }}</span>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="text-muted">Sucursal de destino</label>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-store-alt text-info mr-2"></i>
                                <span class="font-weight-bold">{{ $branch->name }}</span>
                            </div>
                        </div>

                        <div class="form-group col-md-12 mt-3">
                            <label class="text-muted">Observaciones</label>
                            <div class="border rounded p-2 bg-light">
                                <i class="fas fa-comment-dots text-info mr-2"></i>
                                {{ $purchase->observations ?? 'Sin observaciones registradas.' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-3">
            <div class="card card-primary shadow-sm">
                <div class="card-header py-2">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-boxes"></i>&nbsp;Detalle de la Compra
                    </h5>
                </div>
                <div class="card-body">
                    @if ($purchase->details->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm">
                                <thead class="thead-light">
                                    <tr class="text-center align-middle">
                                        <th>#</th>
                                        <th>Producto</th>
                                        <th>Lote</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchase->details as $detail)
                                        <tr>
                                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                            <td class="align-middle">
                                                <strong>{{ $detail->product->code }}</strong><br>
                                                <small class="text-muted">{{ $detail->product->name }}</small>
                                            </td>
                                            <td class="text-center align-middle">{{ $detail->batch->batch_code }}</td>
                                            <td class="text-center align-middle">{{ $detail->quantity }}</td>
                                            <td class="text-center align-middle">L
                                                {{ number_format($detail->unit_price, 2) }}</td>
                                            <td class="text-center align-middle">L
                                                {{ number_format($detail->subtotal, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center text-muted py-3">
                            <i class="fas fa-info-circle"></i> No hay productos agregados a esta compra.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
