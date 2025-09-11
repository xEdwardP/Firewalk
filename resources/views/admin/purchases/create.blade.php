@extends('adminlte::page')

@section('content_header')
    <x-pages.page-header :title="$title" :breadcrumbs="[
        ['label' => 'Inicio', 'route' => 'home'],
        ['label' => 'Compras', 'route' => 'purchases'],
        ['label' => 'Creación de Compra'],
    ]" icon="fas fa-fw fa-shopping-cart" />
@stop

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa-solid fa-clipboard-list"></i>&nbsp;Paso 1 | Datos Generales de la compra</h3>

                    <div class="card-tools">
                        <a href="{{ route('purchases') }}" class="btn btn-sm px-2">
                            <i class="fa-solid fa-arrow-left"></i>&nbsp;Volver
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('purchases.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-8 mb-2">
                                <x-ui.form.select-input name="supplier_id" label="Proveedor" :options="$suppliers"
                                    selected="{{ old('supplier_id', $item->supplier_id ?? '') }}" icon="fas fa-truck"
                                    required />
                            </div>

                            <div class="form-group col-md-4 mb-2">
                                <x-ui.form.date-input name="purchased_at" label="Fecha de compra" :value="old('purchased_at', $item->purchased_at ?? '')"
                                    required />
                            </div>

                            <div class="form-group col-md-12 mb-2">
                                <x-ui.form.textarea-input name="observations" label="Observaciones"
                                    placeholder="Ingrese la observacion" icon="fas fa-comment-alt" maxlength="255" />
                            </div>
                        </div>

                        <div class="form-row mt-2">
                            <div class="col-md-12">
                                <a href="{{ route('purchases.create') }}" class="btn btn-secondary">
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
