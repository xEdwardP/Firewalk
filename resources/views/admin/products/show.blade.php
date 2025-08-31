@extends('adminlte::page')

@section('content_header')
    <x-pages.page-header :title="$title" :breadcrumbs="[
        ['label' => 'Inicio', 'route' => 'home'],
        ['label' => 'Productos', 'route' => 'products'],
        ['label' => 'Datos de el Producto'],
    ]" icon="fas fa-fw fa-boxes" />
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa-solid fa-clipboard-list"></i>&nbsp;Datos de el producto</h3>

                    <div class="card-tools">
                        <a href="{{ route('products') }}" class="btn btn-sm px-2">
                            <i class="fa-solid fa-arrow-left"></i>&nbsp;Volver
                        </a>
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <div class="form-row">
                        <div class="col-md-9">
                            <div class="form-row">
                                <div class="form-group col-md-4 mb-3">
                                    <x-ui.form.text-input name="code" label="Código del producto"
                                        placeholder="Ingrese el código del producto" icon="fas fa-barcode" readonly required
                                        :value="old('code', $item->code ?? '')" />
                                </div>

                                <div class="form-group col-md-4 mb-3">
                                    <x-ui.form.text-input name="name" label="Nombre del producto" icon="fas fa-box"
                                        required readonly :value="old('name', $item->name ?? '')" />
                                </div>

                                <div class="form-group col-md-4 mb-3">
                                    <x-ui.form.text-input name="category_id" label="Nombre de la categoría" required
                                        icon="fas fa-tags" readonly :value="old('category_id', $item->category->name)" />
                                </div>

                                <div class="form-group col-md-12 mb-3">
                                    <x-ui.form.textarea-input name="description" label="Descripción"
                                        icon="fas fa-align-left" :value="old('description', $item->description ?? '')" readonly />
                                </div>

                                <div class="form-group col-md-3 mb-3">
                                    <x-ui.form.number-input name="purchase_price" label="Precio de compra" required
                                        icon="fas fa-dollar-sign" step="0.01" min="0" :value="old('purchase_price', $item->purchase_price ?? '')"
                                        readonly />
                                </div>

                                <div class="form-group col-md-3 mb-3">
                                    <x-ui.form.number-input name="selling_price" label="Precio de venta" required
                                        icon="fas fa-dollar-sign" step="0.01" min="0" :value="old('selling_price', $item->selling_price ?? '')"
                                        readonly />
                                </div>

                                <div class="form-group col-md-3 mb-3">
                                    <x-ui.form.number-input name="min_stock" label="Stock mínimo" icon="fas fa-boxes"
                                        required min="0" :value="old('min_stock', $item->min_stock ?? '')" readonly />
                                </div>

                                <div class="form-group col-md-3 mb-3">
                                    <x-ui.form.number-input name="max_stock" label="Stock máximo" icon="fas fa-boxes"
                                        required min="0" :value="old('max_stock', $item->max_stock ?? '')" readonly />
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <x-ui.form.text-input name="presentation" label="Presentación"
                                        placeholder="Ej. unidad, caja, paquete" icon="fas fa-cube" :value="old('presentation', $item->presentation ?? '')"
                                        readonly required />
                                </div>

                                <div class="form-group col-md-6 mb-3 d-flex align-items-center">
                                    <x-ui.form.toggle-switch-input name="is_active" label="¿Activo?" :checked="$item->is_active ?? false" disabled/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <x-ui.form.preview-image :src="$item->product_image" />
                                {{-- <img src="{{ asset('storage/' . $item->product_image) }}" alt=""> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
