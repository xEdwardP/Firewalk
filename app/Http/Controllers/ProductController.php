<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index', [
            'title' => 'Productos',
            'items' => Product::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.products.create', [
            'title' => 'Crear Producto',
            'categories' => Category::pluck('name', 'id'),
        ]);
    }

    public function store(ProductRequest $request)
    {
        try {
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->code = $request->code;
            $product->name = $request->name;
            $product->description = $request->description;
            if ($request->hasFile('product_image')) {
                $product->product_image = $request->file('product_image')->store('images/products', 'public');
            }
            $product->purchase_price = $request->purchase_price;
            $product->selling_price = $request->selling_price;
            $product->min_stock = $request->min_stock;
            $product->max_stock = $request->max_stock;
            $product->presentation = $request->presentation;
            $product->is_active = $request->is_active;
            $product->save();
            return to_route('products')->with('success', '¡Producto creado exitosamente!');
        } catch (\Throwable $e) {
            return to_route('products')->with('error', 'No se pudo guardar el producto. ' . $e->getMessage());
        }
    }


    public function show(Product $product)
    {
        return view('admin.products.show', [
            'title' => 'Detalle de Producto',
            'categories' => Category::pluck('name', 'id'),
            'item' => $product,
        ]);
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'title' => 'Editar Producto',
            'categories' => Category::pluck('name', 'id'),
            'item' => $product,
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
            $product = Product::find($product->id);
            $product->category_id = $request->category_id;
            $product->code = $request->code;
            $product->name = $request->name;
            $product->description = $request->description;
            if ($request->hasFile('product_image')) {
                if ($product->product_image) {
                    Storage::disk('public')->delete($product->product_image);
                }
                $product->product_image = $request->file('product_image')->store('images/products', 'public');
            }
            $product->purchase_price = $request->purchase_price;
            $product->selling_price = $request->selling_price;
            $product->min_stock = $request->min_stock;
            $product->max_stock = $request->max_stock;
            $product->presentation = $request->presentation;
            $product->is_active = $request->is_active;
            $product->save();
            return to_route('products')->with('success', '¡Producto actualizado!');
        } catch (\Throwable $e) {
            return to_route('products')->with('error', 'No se pudo actualizar: ' . $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        try {
            Storage::disk('public')->delete($product->product_image);
            $product->delete();
            return to_route('products')->with('success', '¡Producto eliminado!');
        } catch (\Throwable $e) {
            return to_route('products')->with('error', 'No se pudo eliminar: ' . $e->getMessage());
        }
    }
}
