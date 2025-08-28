<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        return view('admin.branches.index', [
            'title' => 'Sucursales',
            'items' => Branch::latest()->get()
        ]);
    }

    public function create()
    {
        return view('admin.branches.create', [
            'title' => 'Crear Sucursal'
        ]);
    }

    public function store(BranchRequest $request)
    {
        try {
            Branch::create($request->validated());
            return to_route('branches')->with('success', '¡Sucursal creada exitosamente!');
        } catch (\Throwable $e) {
            return to_route('branches')->with('error', 'No se pudo guardar la sucursal.' . $e->getMessage());
        }
    }

    public function show(Branch $branch)
    {
        return view('admin.branches.show', [
            'title' => 'Detalle de Sucursal',
            'item' => $branch
        ]);
    }

    public function edit(Branch $branch)
    {
        return view('admin.branches.edit', [
            'title' => 'Editar Sucursal',
            'item' => $branch
        ]);
    }


    public function update(BranchRequest $request, Branch $branch)
    {
        try {
            $branch->update($request->validated());
            return to_route('branches')->with('success', '¡Sucursal actualizada!');
        } catch (\Throwable $e) {
            return to_route('branches')->with('error', 'No se pudo actualizar: ' . $e->getMessage());
        }
    }

    public function destroy(Branch $branch)
    {
        try {
            $branch->delete();
            return to_route('branches')->with('success', '¡Sucursal eliminada!');
        } catch (\Throwable $e) {
            return to_route('branches')->with('error', 'No se pudo eliminar: ' . $e->getMessage());
        }
    }
}
