@extends('adminlte::page')

@section('content_header')
    <x-pages.page-header :title="$title" :breadcrumbs="[
        ['label' => 'Inicio', 'route' => 'home'],
        ['label' => 'Inventario'],
        ['label' => 'Inventario de sucursales por lotes'],
    ]" icon="fas fa-fw fa-map-marked-alt" />
@stop

@section('content')
    <div class="row">
        @foreach ($branches as $branch)
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <a href="{{ route('inventory_in_branch', $branch) }}" class="info-box-icon">
                        <span class="info-box-icon bg-info">
                            <img src="{{ url('/img/branches.gif') }}" alt="Sucursales por lotes">
                        </span>
                    </a>

                    <div class="info-box-content">
                        <span class="info-box-text">Sucursal {{ $branch->name }}</span>
                        <span class="info-box-number">{{ $branch->totalInventory }} Productos en Stock</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop

@section('js')
    @include('utils.dataTable.dataTableConfig')
@stop
