@extends('adminlte::page')

@section('content_header')
    <x-pages.page-header :title="$title" :breadcrumbs="[
        ['label' => 'Inicio', 'route' => 'home'],
        ['label' => 'Compras', 'route' => 'purchases'],
        ['label' => $label],
    ]" icon="fas fa-fw fa-shopping-cart" />
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info shadow-sm">
                <div class="card-header py-2">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-file-invoice"></i>&nbsp;Paso 1 | Datos Generales de la Compra
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

                        <div class="form-group col-md-3">
                            <label class="text-muted">Fecha de Compra</label>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar-day text-info mr-2"></i>
                                <span>{{ $formattedDate }}</span>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="text-muted">Estado de Compra</label>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-receipt text-info mr-2"></i>
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

                        <div class="form-group col-md-12 mt-3">
                            <label class="text-muted">Observaciones</label>
                            <div class="border rounded p-2 bg-light">
                                <i class="fas fa-comment-alt text-info mr-2"></i>
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
                        <i class="fas fa-box-open"></i>&nbsp;Paso 2 | Agregar Productos
                    </h5>
                </div>
                <div class="card-body">
                    <livewire:admin.purchases.items-purchase :purchase="$purchase" />
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-3">
            <div class="card card-success shadow-sm">
                <div class="card-header py-2">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-check-double"></i>&nbsp;Paso 3 | Finalizar Compra
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('purchases.completePurchase', $purchase) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="branch_id">Sucursal <sup class="text-danger">*</sup></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-store-alt"></i></span>
                                        </div>
                                        <select name="branch_id" id="branch_id" class="form-control" required
                                            @if ($purchase->payment_status === 'finalizada') disabled @endif>>
                                            <option value="">Seleccione una Sucursal...</option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}">
                                                    {{ $branch->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-error field="branch_id" class="mt-1" />
                                </div>
                                <button type="submit" class="btn btn-outline-success btn-block"
                                    @if ($purchase->payment_status === 'finalizada') disabled @endif>
                                    <i class="fas fa-check-circle"></i>
                                    <span class="d-none d-md-inline">&nbsp;Finalizar Compra</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop


@section('css')
    <style>
        .select2-container .select2-selection--single {
            height: 40px !important;
        }
    </style>
    @livewireStyles
@stop

@section('js')
    {{-- <script>
        $('.select2').select2({});
    </script> --}}
    @livewireScripts
@stop
