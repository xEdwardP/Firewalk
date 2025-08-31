<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $title = 'Categorias';
        $items = Category::all();
        return view('admin.categories.index', compact('title', 'items'));
        // return response()->json($categories);
    }

    public function create()
    {
        $title = 'Crear Categoria';
        return view('admin.categories.create', compact('title'));
    }

    public function store(CategoryRequest $request)
    {
        try {
            Category::create($request->validated());
            return to_route('categories.index')->with('success', '¡Categoría creada exitosamente!');
        } catch (\Throwable $e) {
            return to_route('categories.index')->with('error', 'No se pudo guardar la categoría.' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $title = 'Detalle de Categoria';
        $item = Category::findOrFail($id);
        return view('admin.categories.show', compact('title', 'item'));
    }

    public function edit($id)
    {
        $title = 'Editar Categoria';
        $item = Category::findOrFail($id);
        return view('admin.categories.edit', compact('title', 'item'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $category->update($request->validated());
            return to_route('categories.index')->with('success', '¡Categoría actualizada!');
        } catch (\Throwable $e) {
            return to_route('categories.index')->with('error', 'No se pudo actualizar: ' . $e->getMessage());
        }
    }


    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return to_route('categories.index')->with('success', '¡Categoría eliminada!');
        } catch (\Throwable $e) {
            return to_route('categories.index')->with('error', 'No se pudo eliminar: ' . $e->getMessage());
        }
    }
}
