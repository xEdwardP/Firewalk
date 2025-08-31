@extends('adminlte::page')

@section('content_header')
    <x-pages.page-header :title="$title" :breadcrumbs="[
        ['label' => 'Inicio', 'route' => 'home'],
        ['label' => 'Productos', 'route' => 'products'],
        ['label' => 'Creación de Productos'],
    ]" icon="fas fa-fw fa-boxes" />
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa-solid fa-clipboard-list"></i>&nbsp;Datos de el producto</h3>

                    <div class="card-tools">
                        <a href="{{ route('products') }}" class="btn btn-sm px-2">
                            <i class="fa-solid fa-arrow-left"></i>&nbsp;Volver
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-row">
                            <div class="col-md-9">
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-3">
                                        <x-ui.form.text-input name="code" label="Código del producto"
                                            placeholder="Ingrese el código del producto" icon="fas fa-barcode" required
                                            autofocus maxlength="255" :value="old('code', $item->code ?? '')" />
                                    </div>

                                    <div class="form-group col-md-4 mb-3">
                                        <x-ui.form.text-input name="name" label="Nombre del producto"
                                            placeholder="Ingrese el nombre del producto" icon="fas fa-box" required
                                            maxlength="100" :value="old('name', $item->name ?? '')" />
                                    </div>

                                    <div class="form-group col-md-4 mb-3">
                                        <x-ui.form.select-input name="category_id" label="Categoría" :options="$categories"
                                            selected="{{ old('category_id', $item->category_id ?? '') }}" icon="fas fa-tags"
                                            required />
                                    </div>

                                    <div class="form-group col-md-12 mb-3">
                                        <x-ui.form.textarea-input name="description" label="Descripción"
                                            placeholder="Ingrese una descripción breve" icon="fas fa-align-left"
                                            maxlength="255" :value="old('description', $item->description ?? '')" />
                                    </div>

                                    <div class="form-group col-md-3 mb-3">
                                        <x-ui.form.number-input name="purchase_price" label="Precio de compra"
                                            icon="fas fa-dollar-sign" step="0.01" min="0" :value="old('purchase_price', $item->purchase_price ?? '')"
                                            required />
                                    </div>

                                    <div class="form-group col-md-3 mb-3">
                                        <x-ui.form.number-input name="selling_price" label="Precio de venta"
                                            icon="fas fa-dollar-sign" step="0.01" min="0" :value="old('selling_price', $item->selling_price ?? '')"
                                            required />
                                    </div>

                                    <div class="form-group col-md-3 mb-3">
                                        <x-ui.form.number-input name="min_stock" label="Stock mínimo" icon="fas fa-boxes"
                                            min="0" :value="old('min_stock', $item->min_stock ?? '')" required />
                                    </div>

                                    <div class="form-group col-md-3 mb-3">
                                        <x-ui.form.number-input name="max_stock" label="Stock máximo" icon="fas fa-boxes"
                                            min="0" :value="old('max_stock', $item->max_stock ?? '')" required />
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <x-ui.form.text-input name="presentation" label="Presentación"
                                            placeholder="Ej. unidad, caja, paquete" icon="fas fa-cube" maxlength="50"
                                            :value="old('presentation', $item->presentation ?? '')" required />
                                    </div>

                                    <div class="form-group col-md-6 mb-3 d-flex align-items-center">
                                        <x-ui.form.toggle-switch-input name="is_active" label="¿Activo?" :checked="$item->is_active ?? false" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <x-ui.form.file-input name="product_image" label="Imagen del producto"
                                        icon="fas fa-image" accept="image/*" preview/>
                                </div>
                            </div>
                        </div>

                        <div class="form-row mt-4">
                            <div class="col-md-12">
                                <a href="{{ route('products.create') }}" class="btn btn-secondary">
                                    <i class="fa-solid fa-ban"></i>&nbsp;Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
