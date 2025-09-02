@extends('adminlte::page')

@section('content_header')
    <x-pages.page-header :title="$title" :breadcrumbs="[
        ['label' => 'Inicio', 'route' => 'home'],
        ['label' => 'Proveedores', 'route' => 'suppliers'],
        ['label' => 'Listado de Proveedores'],
    ]" icon="fas fa-fw fa-truck" />
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title "><i class="fa-solid fa-clipboard-list"></i>&nbsp;Proveedores Registrados</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" data-toggle="modal"
                            data-target="#ModalCreate">
                            <i class="fa-solid fa-circle-plus"></i>&nbsp; Nuevo Proveedor
                        </button>
                        <div class="modal fade" tabindex="-1" id="ModalCreate" aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title">Creación de un Nuevo Proveedor</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('suppliers.store') }}" method="POST">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-md-12 mb-2">
                                                    <x-ui.form.text-input name="company" label="Nombre de la compañia"
                                                        placeholder="Ingrese el nombre de la compañia o razón social"
                                                        icon="fas fa-truck" required autofocus maxlength="100"
                                                        :value="old('company', $item->company ?? '')" />
                                                </div>
                                                <div class="form-group col-md-12 mb-2">
                                                    <x-ui.form.textarea-input name="address" label="Dirección"
                                                        placeholder="Ingrese la dirección" icon="fas fa-map-marker-alt"
                                                        :value="old('address', $item->address ?? '')" required maxlength="255" />
                                                </div>
                                                <div class="form-group col-md-12 mb-2">
                                                    <x-ui.form.text-input name="name"
                                                        label="Nombre de el representante o contacto"
                                                        placeholder="Ingrese el nombre de el representante o contacto"
                                                        icon="fas fa-person" required autofocus maxlength="100"
                                                        :value="old('name', $item->name ?? '')" />
                                                </div>
                                                <div class="form-group col-md-12 mb-2">
                                                    <x-ui.form.number-input name="phone"
                                                        label="Numero de contacto de la compañia"
                                                        placeholder="Ingrese el numero de la compañia o razón social"
                                                        icon="fas fa-phone" required autofocus maxlength="20"
                                                        :value="old('phone', $item->phone ?? '')" />
                                                </div>
                                                <div class="form-group col-md-12 mb-2">
                                                    <x-ui.form.text-input name="email"
                                                        label="Correo electronico de la compañia"
                                                        placeholder="Ingrese el correo electronico de la compañia o razón social"
                                                        icon="fas fa-envelope" required autofocus maxlength="100"
                                                        :value="old('email', $item->email ?? '')" type="email" />
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                                        class="fa-solid fa-ban"></i>&nbsp;Cancelar</button>
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="dataTable"
                        class="table table-bordered table-striped table-hover table-sm table-responsive-sm table-responsive-md">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Compañia</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Teléfono</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->company }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-center">{{ $item->phone }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-sm btn-info rounded-pill px-3"
                                                data-toggle="modal" data-target="#ModalShow{{ $item->id }}">
                                                <i class="fa-solid fa-eye"></i>&nbsp;Ver
                                            </button>
                                            <div class="modal fade" tabindex="-1" id="ModalShow{{ $item->id }}"
                                                aria-labelledby="" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-info text-white">
                                                            <h5 class="modal-title">Datos del Proveedor</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row text-left">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Nombre de la compañia o razón social</label>
                                                                        <p>{{ $item->company }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Dirección</label>
                                                                        <p>{{ $item->address }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Nombre del representante o contacto</label>
                                                                        <p>{{ $item->name }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Numero de contacto de la compañia</label>
                                                                        <p>{{ $item->phone }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Correo electronico de la compañia</label>
                                                                        <p>{{ $item->email }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-warning rounded-pill px-3"
                                                data-toggle="modal" data-target="#ModalEdit{{ $item->id }}">
                                                <i class="fa-solid fa-pen-to-square"></i>&nbsp;Editar
                                            </button>
                                            <div class="modal fade" tabindex="-1" id="ModalEdit{{ $item->id }}"
                                                aria-labelledby="" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-warning text-white">
                                                            <h5 class="modal-title">Edición de Proveedor</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('suppliers.update', $item) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-row text-left">
                                                                    <div class="form-group col-md-12 mb-2">
                                                                        <x-ui.form.text-input name="company"
                                                                            label="Nombre de la compañia"
                                                                            placeholder="Ingrese el nombre de la compañia o razón social"
                                                                            icon="fas fa-truck" required autofocus
                                                                            maxlength="100" :value="old(
                                                                                'company',
                                                                                $item->company ?? '',
                                                                            )" />
                                                                    </div>
                                                                    <div class="form-group col-md-12 mb-2">
                                                                        <x-ui.form.textarea-input name="address"
                                                                            label="Dirección"
                                                                            placeholder="Ingrese la dirección"
                                                                            icon="fas fa-map-marker-alt" required
                                                                            maxlength="255" :value="old(
                                                                                'address',
                                                                                $item->address ?? '',
                                                                            )" />
                                                                    </div>
                                                                    <div class="form-group col-md-12 mb-2">
                                                                        <x-ui.form.text-input name="name"
                                                                            label="Nombre de el representante o contacto"
                                                                            placeholder="Ingrese el nombre de el representante o contacto"
                                                                            icon="fas fa-person" required autofocus
                                                                            maxlength="100" :value="old('name', $item->name ?? '')" />
                                                                    </div>
                                                                    <div class="form-group col-md-12 mb-2">
                                                                        <x-ui.form.number-input name="phone"
                                                                            label="Numero de contacto de la compañia"
                                                                            placeholder="Ingrese el numero de la compañia o razón social"
                                                                            icon="fas fa-phone" required autofocus
                                                                            maxlength="20" :value="old('phone', $item->phone ?? '')" />
                                                                    </div>
                                                                    <div class="form-group col-md-12 mb-2">
                                                                        <x-ui.form.text-input name="email"
                                                                            label="Correo electronico de la compañia"
                                                                            placeholder="Ingrese el correo electronico de la compañia o razón social"
                                                                            icon="fas fa-envelope" required autofocus
                                                                            maxlength="100" :value="old('email', $item->email ?? '')"
                                                                            type="email" />
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal"><i
                                                                            class="fa-solid fa-ban"></i>&nbsp;Cancelar</button>
                                                                    <button type="submit" class="btn btn-primary"><i
                                                                            class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-delete-button :action="route('suppliers.destroy', $item->id)" :item-id="$item->id" label="Eliminar" />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    @include('utils.dataTable.dataTableConfig')

    @if ($errors->any())
        <script>
            @if (session('modal_id'))
                var modalId = "{{ session('modal_id') }}";
                $('#ModalEdit' + modalId).modal('show');
            @else
                $('#ModalCreate').modal('show');
            @endif
        </script>
    @endif
@stop
