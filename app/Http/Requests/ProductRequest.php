<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:255'],
            'product_image' => ['nullable', 'image'],
            'purchase_price' => ['required', 'numeric', 'min:0'],
            'selling_price' => ['required', 'numeric', 'min:0'],
            'min_stock' => ['required', 'integer', 'min:0'],
            'max_stock' => ['required', 'integer', 'min:0'],
            'presentation' => ['required', 'string', 'max:50'],
            'status' => ['boolean'],
            'category_id' => ['required', 'exists:categories,id'],
        ];

        if ($this->isMethod('post')) {
            // Validación al crear
            $rules['code'] = ['required', 'string', 'max:255', 'unique:products,code'];
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            // Validación al editar
            $product = $this->route('product');

            if ($this->input('code') !== $product->code) {
                $rules['code'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('products', 'code')->ignore($product->id),
                ];
            } else {
                $rules['code'] = ['required', 'string', 'max:255'];
            }
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'code.required' => 'El código es obligatorio.',
            'code.string' => 'El código debe ser una cadena de texto.',
            'code.max' => 'El código no debe exceder los 255 caracteres.',
            'code.unique' => 'El código ya está en uso.',

            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe exceder los 100 caracteres.',

            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no debe exceder los 255 caracteres.',

            'product_image.image' => 'La imagen del producto debe ser un archivo de imagen.',

            'purchase_price.required' => 'El precio de compra es obligatorio.',
            'purchase_price.numeric' => 'El precio de compra debe ser un número.',
            'purchase_price.min' => 'El precio de compra no puede ser negativo.',

            'selling_price.required' => 'El precio de venta es obligatorio.',
            'selling_price.numeric' => 'El precio de venta debe ser un número.',
            'selling_price.min' => 'El precio de venta no puede ser negativo.',

            'min_stock.required' => 'El stock mínimo es obligatorio.',
            'min_stock.integer' => 'El stock mínimo debe ser un número entero.',
            'min_stock.min' => 'El stock mínimo no puede ser negativo.',

            'max_stock.required' => 'El stock máximo es obligatorio.',
            'max_stock.integer' => 'El stock máximo debe ser un número entero.',
            'max_stock.min' => 'El stock máximo no puede ser negativo.',

            'presentation.required' => 'La presentación es obligatoria.',
            'presentation.string' => 'La presentación debe ser una cadena de texto.',
            'presentation.max' => 'La presentación no debe exceder los 50 caracteres.',

            'status.boolean' => 'El estado debe ser activo o inactivo.',

            'category_id.required' => 'La categoría es obligatoria.',
            'category_id.exists' => 'La categoría seleccionada no es válida.',
        ];
    }

    public function attributes(): array
    {
        return
            [
                'code' => 'código',
                'name' => 'nombre',
                'description' => 'descripción',
                'product_image' => 'imagen del producto',
                'purchase_price' => 'precio de compra',
                'selling_price' => 'precio de venta',
                'min_stock' => 'stock mínimo',
                'max_stock' => 'stock máximo',
                'presentation' => 'presentación',
                'status' => 'estado',
                'category_id' => 'categoría',
            ];
    }
}
