<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
        return [
            'company' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'company.required' => 'El campo Empresa es obligatorio.',
            'company.string' => 'El campo Empresa debe ser una cadena de texto.',
            'company.max' => 'El campo Empresa no debe exceder los 100 caracteres.',
            'address.required' => 'El campo Dirección es obligatorio.',
            'address.string' => 'El campo Dirección debe ser una cadena de texto.',
            'address.max' => 'El campo Dirección no debe exceder los 255 caracteres.',
            'name.required' => 'El campo Nombre es obligatorio.',
            'name.string' => 'El campo Nombre debe ser una cadena de texto.',
            'name.max' => 'El campo Nombre no debe exceder los 100 caracteres.',
            'phone.required' => 'El campo Teléfono es obligatorio.',
            'phone.string' => 'El campo Teléfono debe ser una cadena de texto.',
            'phone.max' => 'El campo Teléfono no debe exceder los 20 caracteres.',
            'email.required' => 'El campo Correo Electrónico es obligatorio.',
            'email.email' => 'El campo Correo Electrónico debe ser una dirección de correo válida.',
            'email.max' => 'El campo Correo Electrónico no debe exceder los 100 caracteres.',
        ];
    }

    public function attributes(): array
    {
        return [
            'company' => 'Empresa o Razón Social',
            'address' => 'Dirección',
            'name' => 'Nombre del Contacto',
            'phone' => 'Teléfono',
            'email' => 'Correo Electrónico',
        ];
    }
}
