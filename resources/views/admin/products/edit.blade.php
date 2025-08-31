@extends('adminlte::page')

@section('content_header')
    <x-pages.page-header :title="$title" :breadcrumbs="[
        ['label' => 'Inicio', 'route' => 'home'],
        ['label' => 'Productos', 'route' => 'products'],
        ['label' => 'Edición de Productos'],
    ]" icon="fas fa-fw fa-boxes" />
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa-solid fa-clipboard-list"></i>&nbsp;Datos de el producto</h3>

                    <div class="card-tools">
                        <a href="{{ route('products') }}" class="btn btn-sm px-2">
                            <i class="fa-solid fa-arrow-left"></i>&nbsp;Volver
                        </a>
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <form method="POST" action="{{ route('products.update', $item->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="product_image">Imagen del producto <sup
                                                    class="text-red">(*)</sup></label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-image"></i></span>
                                                </div>
                                                <input type="file" class="form-control" id="product_image"
                                                    name="product_image" accept="image/*" onchange="previewImage(event)">
                                            </div>

                                            <div class="d-flex justify-content-center">
                                                <img id="imgPreview" src="{{ asset('storage/' . $item->product_image) }}"
                                                alt="Vista previa" class="img-fluid img-thumbnail" width="100%"/>
                                            </div>

                                            <script>
                                                function previewImage(event) {
                                                    const input = event.target;
                                                    const file = input.files[0];

                                                    if (file) {
                                                        const reader = new FileReader();
                                                        reader.onload = function(e) {
                                                            const imgPreview = document.getElementById('imgPreview');
                                                            imgPreview.src = e.target.result;
                                                            imgPreview.style.display = 'block';
                                                        }
                                                        reader.readAsDataURL(file);
                                                    }
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ route('products.edit', $item->id) }}" class="btn btn-secondary"><i
                                            class="fa-solid fa-ban"></i>&nbsp;Cancelar</a>
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
