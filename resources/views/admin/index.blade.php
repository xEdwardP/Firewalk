@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <x-pages.page-header :title="$title" :breadcrumbs="[['label' => 'Inicio', 'route' => 'home']]" icon="fas fa-fw fa-home" />
@stop

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="{{ route('branches') }}" class="info-box-icon">
                    <span class="info-box-icon bg-info">
                        <img src="{{ url('/img/branches.gif') }}" alt="Sucursales">
                    </span>
                </a>

                <div class="info-box-content">
                    <span class="info-box-text">Cantidad de Sucursales</span>
                    <span class="info-box-number">{{ $totalBranches }} Sucursales</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="{{ route('categories.index') }}" class="info-box-icon">
                    <span class="info-box-icon bg-info">
                        <img src="{{ url('/img/categories.gif') }}" alt="Categorias">
                    </span>
                </a>

                <div class="info-box-content">
                    <span class="info-box-text">Cantidad de Categorias</span>
                    <span class="info-box-number">{{ $totalCategories }} Categorias</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="{{ route('suppliers') }}" class="info-box-icon">
                    <span class="info-box-icon bg-info">
                        <img src="{{ url('/img/suppliers.gif') }}" alt="Proveedores">
                    </span>
                </a>

                <div class="info-box-content">
                    <span class="info-box-text">Cantidad de Proveedores</span>
                    <span class="info-box-number">{{ $totalSuppliers }} Proveedores</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="{{ route('products') }}" class="info-box-icon">
                    <span class="info-box-icon bg-info">
                        <img src="{{ url('/img/products.gif') }}" alt="Productos">
                    </span>
                </a>

                <div class="info-box-content">
                    <span class="info-box-text">Cantidad de Productos</span>
                    <span class="info-box-number">{{ $totalProducts }} Productos</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="{{ route('purchases') }}" class="info-box-icon">
                    <span class="info-box-icon bg-info">
                        <img src="{{ url('/img/cart.gif') }}" alt="Compras">
                    </span>
                </a>

                <div class="info-box-content">
                    <span class="info-box-text">Cantidad de Compras</span>
                    <span class="info-box-number">{{ $totalPurchases }} Compras</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="#" class="info-box-icon">
                    <span class="info-box-icon bg-info">
                        <img src="{{ url('/img/users.gif') }}" alt="Usuarios">
                    </span>
                </a>

                <div class="info-box-content">
                    <span class="info-box-text">Cantidad de Usuarios</span>
                    <span class="info-box-number">{{ $totalUsers }} Usuarios</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="{{ route('batches') }}" class="info-box-icon">
                    <span class="info-box-icon bg-info">
                        <img src="{{ url('/img/box_uncheck.gif') }}" alt="Lotes Vencidos">
                    </span>
                </a>

                <div class="info-box-content">
                    <span class="info-box-text">Lotes Vencidos</span>
                    <span class="info-box-number">{{ $totalExpiredBatches }} Lotes</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="{{ route('batches') }}" class="info-box-icon">
                    <span class="info-box-icon bg-info">
                        <img src="{{ url('/img/box_check.gif') }}" alt="Lotes Activos">
                    </span>
                </a>

                <div class="info-box-content">
                    <span class="info-box-text">Lotes Activos</span>
                    <span class="info-box-number">{{ $totalActiveBatches }} Lotes</span>
                </div>
            </div>
        </div>
    </div>
@stop
