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
                            <p>{{ $item->supplier->company }}</p>
                        </div>
                        <div class="form-group col-md-3 mb-2">
                            <label for="">Fecha de Compra</label>
                            <p>{{ $item->purchased_at }}</p>
                        </div>
                        <div class="form-group col-md-3 mb-2">
                            <label for="">Estado de Compra</label>
                            <p>{{ $item->payment_status }}</p>
                        </div>
                        <div class="form-group col-md-3 mb-2">
                            <label for="">Total</label>
                            <p>L {{ $item->total }}</p>
                        </div>
                        <div class="form-group col-md-12 mb-2">
                            <label for="">Observaciones</label>
                            <p>{{ $item->observations }}</p>
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
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    @livewireStyles
@stop

@section('js')
    @livewireScripts
@stop