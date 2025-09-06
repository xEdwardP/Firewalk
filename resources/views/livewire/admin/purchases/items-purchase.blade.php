<div>
    <div class="row">
        {{-- Formulario de ingreso --}}
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-header py-2">
                    <h5 class="card-title mb-0">Agregar producto</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="productId">Producto <sup class="text-danger">*</sup></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-box"></i></span>
                            </div>
                            <select wire:model.live="productId" name="product_id" id="productId" class="form-control select2"
                                required>
                                <option value="">Seleccione un producto...</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->code . ' - ' . $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <x-error field="productId" class="mt-1" />
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="batch_code">Lote <sup class="text-danger">*</sup></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                                </div>
                                <input wire:model="batchCode" type="text" name="batch_code" id="batch_code"
                                    class="form-control" maxlength="255" placeholder="Ingrese el lote" required>
                            </div>
                            <x-error field="batchCode" class="mt-1" />
                        </div>

                        <div class="col-md-6">
                            <label for="quantity">Cantidad <sup class="text-danger">*</sup></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-sort-numeric-up"></i></span>
                                </div>
                                <input type="number" name="quantity" id="quantity" class="form-control text-center"
                                    min="1" placeholder="0" wire:model="quantity" required>
                            </div>
                            <x-error field="quantity" class="mt-1" />
                        </div>
                    </div>

                    <div class="form-row mt-3">
                        <div class="col-md-6">
                            <label for="purchasePrice">Precio Compra <sup class="text-danger">*</sup></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="number" name="purchasePrice" id="purchasePrice"
                                    class="form-control text-center" min="0" step="0.01" placeholder="0.00"
                                    wire:model="purchasePrice" required>
                            </div>
                            <x-error field="purchasePrice" class="mt-1" />
                        </div>

                        <div class="col-md-6">
                            <label for="salePrice">Precio Venta <sup class="text-danger">*</sup></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="number" name="salePrice" id="salePrice" class="form-control text-center"
                                    min="0" step="0.01" placeholder="0.00" wire:model="salePrice" required>
                            </div>
                            <x-error field="salePrice" class="mt-1" />
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label for="expires_at">Fecha Vencimiento <small class="text-muted">(Opcional)</small></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="date" name="expires_at" id="expires_at" class="form-control text-center"
                                wire:model="dueDate">
                        </div>
                        <x-error field="dueDate" class="mt-1" />
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-sm btn-block" wire:click="addItems">
                            <i class="fas fa-circle-plus"></i>
                            <span class="d-none d-md-inline">&nbsp;Agregar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabla de productos agregados --}}
        <div class="col-md-8">
            <div class="card card-secondary card-outline">
                <div class="card-header py-2">
                    <h5 class="card-title mb-0">Productos de la compra</h5>
                </div>
                <div class="card-body">
                    @if ($purchase->details->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm">
                                <thead class="thead-light">
                                    <tr class="text-center align-middle">
                                        <th>#</th>
                                        <th>Producto</th>
                                        <th>Lote</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Subtotal</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchase->details as $detail)
                                        <tr>
                                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                            <td class="align-middle">
                                                <strong>{{ $detail->product->code }}</strong><br>
                                                <small class="text-muted">{{ $detail->product->name }}</small>
                                            </td>
                                            <td class="text-center align-middle">{{ $detail->batch->batch_code }}</td>
                                            <td class="text-center align-middle">{{ $detail->quantity }}</td>
                                            <td class="text-center align-middle">L
                                                {{ number_format($detail->unit_price, 2) }}</td>
                                            <td class="text-center align-middle">L
                                                {{ number_format($detail->subtotal, 2) }}</td>
                                            <td class="text-center align-middle">
                                                <button class="btn btn-outline-danger btn-sm"
                                                    wire:click="removeItem({{ $detail->id }})" title="Eliminar">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="border-0"></td>
                                        <td class="text-right font-weight-bold">Total:</td>
                                        <td class="text-center text-success font-weight-bold">
                                            L {{ number_format($purchase->total, 2) }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <div class="text-center text-muted py-3">
                            <i class="fas fa-info-circle"></i> No hay productos agregados a esta compra.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div x-data
        x-on:show-alert.window="
        Swal.fire({
            icon: $event.detail.icon,
            title: $event.detail.title,
            text: $event.detail.text,
            showConfirmButton: false,
            timer: 1500,
            })">
    </div>
</div>
