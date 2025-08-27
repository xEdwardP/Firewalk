<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
    // public function rules(): array
    // {
    //     return [
    //         'name' => ['required', 'string', 'max:150', 'unique:categories,name'],
    //         'description' => ['nullable', 'string', 'max:255'],
    //     ];
    // }

    public function rules(): array
    {
        $rules = [
            'description' => ['nullable', 'string', 'max:255'],
        ];

        if ($this->isMethod('post')) {
            // Validación al crear
            $rules['name'] = ['required', 'string', 'max:150', 'unique:categories,name'];
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            // Validación al editar
            $category = $this->route('category'); // Asume que estás usando route model binding

            if ($this->input('name') !== $category->name) {
                $rules['name'] = [
                    'required',
                    'string',
                    'max:150',
                    Rule::unique('categories', 'name')->ignore($category->id),
                ];
            } else {
                // Si no se modificó el nombre, solo se valida formato
                $rules['name'] = ['required', 'string', 'max:150'];
            }
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la categoría es obligatorio',
            'name.string' => 'El nombre debe ser una cadena de texto válida',
            'name.max' => 'El nombre no puede exceder los :max caracteres',
            'name.unique' => 'Esta categoría ya existe en el sistema',
            'description.string' => 'La descripción debe ser una cadena de texto válida',
            'description.max' => 'La descripción no puede exceder los :max caracteres',
        ];
    }

    public function attributes(): array
    {
        return
            [
                'name' => 'nombre de categoría',
                'description' => 'descripción de categoría',
            ];
    }
}
