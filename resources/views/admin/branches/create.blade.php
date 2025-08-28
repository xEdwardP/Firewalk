@extends('adminlte::page')

@section('content_header')
    <x-pages.page-header :title="$title" :breadcrumbs="[
        ['label' => 'Inicio', 'route' => 'home'],
        ['label' => 'Sucursales', 'route' => 'branches'],
        ['label' => 'Creación de Sucursales'],
    ]" icon="fas fa-fw fa-building" />
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa-solid fa-clipboard-list"></i>&nbsp;Datos de la sucursal</h3>

                    <div class="card-tools">
                        <a href="{{ route('branches') }}" class="btn btn-sm px-2">
                            <i class="fa-solid fa-arrow-left"></i>&nbsp;Volver
                        </a>
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <form method="POST" action="{{ route('branches.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 mb-2">
                                <x-ui.form.text-input name="name" label="Nombre de la sucursal"
                                    placeholder="Ingrese el nombre de la sucursal" icon="fas fa-building" required autofocus
                                    maxlength="100" :value="old('name', $item->name ?? '')"/>
                            </div>

                            <div class="form-group col-md-6 mb-2">
                                <x-ui.form.text-input name="phone" label="Teléfono" placeholder="Ingrese el teléfono"
                                    icon="fas fa-phone" maxlength="20" />
                            </div>

                            <div class="form-group col-md-12 mb-2">
                                <x-ui.form.textarea-input name="address" label="Dirección"
                                    placeholder="Ingrese la dirección" icon="fas fa-map-marker-alt" required
                                    maxlength="255" />
                            </div>

                            <div class="form-group col-md-12 mb-2 d-flex align-items-center">
                                <x-ui.form.toggle-switch-input name="is_active" label="¿Activo?" :checked="$item->is_active ?? false" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ route('branches.create') }}" class="btn btn-secondary"><i
                                            class="fa-solid fa-ban"></i>&nbsp;Cancelar</a>
                                    <button type="submit" class="btn btn-primary">
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
