<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        return view('admin.suppliers.index', [
            'title' => 'Proveedores',
            'items' => Supplier::latest()->get(),
        ]);
    }

    public function store(SupplierRequest $request)
    {
        try {
            Supplier::create($request->validated());
            return redirect()->route('suppliers')->with('success', 'Proveedor creado exitosamente.');
        } catch (\Exception $e) {
            return to_route('suppliers')->with('error', 'Error al crear el proveedor: ' . $e->getMessage());
        }
    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {
        try {
            $supplier->update($request->validated());
            return to_route('suppliers')->with('success', 'Proveedor actualizado exitosamente.');
        } catch (\Throwable $e) {
            return to_route('suppliers')->with('error', 'Error al actualizar el proveedor: ' . $e->getMessage());
        }
    }

    public function destroy(Supplier $supplier)
    {
        try {
            $supplier->delete();
            return to_route('suppliers')->with('success', 'Proveedor eliminado exitosamente.');
        } catch (\Throwable $e) {
            return to_route('suppliers')->with('error', 'Error al eliminar el proveedor: ' . $e->getMessage());
        }
    }
}
