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
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa-solid fa-clipboard-list"></i>&nbsp;Paso 1 | Datos Generales de la
                        compra</h3>
                    {{-- <div class="card-tools">
                        <a href="{{ route('purchases') }}" class="btn btn-sm px-2">
                            <i class="fa-solid fa-arrow-left"></i>&nbsp;Volver
                        </a>
                    </div> --}}
                </div>
                <div class="card-body" style="display: block;">
                    <div class="form-row">
                        <div class="form-group col-md-3 mb-2">
                            <label for="">Proveedor</label>
                            <p>{{ $purchase->supplier->company }}</p>
                        </div>
                        <div class="form-group col-md-3 mb-2">
                            <label for="">Fecha de Compra</label>
                            <p>{{ $purchase->purchased_at }}</p>
                        </div>
                        <div class="form-group col-md-3 mb-2">
                            <label for="">Estado de Compra</label>
                            <p>{{ $purchase->payment_status }}</p>
                        </div>
                        <div class="form-group col-md-3 mb-2">
                            <label for="">Observaciones</label>
                            <p>{{ $purchase->observations }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa-solid fa-clipboard-list"></i>&nbsp;Paso 2 | Agregar productos</h3>
                </div>
                <div class="card-body" style="display: block;">
                    <livewire:admin.purchases.items-purchase :purchase="$purchase" />
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
