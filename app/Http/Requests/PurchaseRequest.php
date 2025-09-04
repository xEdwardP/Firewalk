<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
            'supplier_id'     => 'required|exists:suppliers,id',
            'purchased_at'    => 'required|date',
            // 'total'           => ['required', 'numeric', 'min:0'],
            // 'payment_status'  => ['required', 'string', 'max:100'],
            'observations'    => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'supplier_id.required'    => 'El proveedor es obligatorio.',
            'supplier_id.exists'      => 'El proveedor seleccionado no existe.',
            'purchased_at.required'   => 'La fecha de compra es obligatoria.',
            'purchased_at.date'       => 'La fecha de compra debe ser válida.',
            // 'total.required'          => 'El total es obligatorio.',
            // 'total.numeric'           => 'El total debe ser un número.',
            // 'payment_status.required' => 'El estado de pago es obligatorio.',
            // 'payment_status.max'      => 'El estado de pago no puede exceder 100 caracteres.',
            'observations.string'     => 'Las observaciones deben ser una cadena de texto.',
            'observations.max'        => 'Las observaciones no pueden exceder 255 caracteres.',
        ];
    }

    public function attributes()
    {
        return [
            'supplier_id'     => 'Proveedor',
            'purchased_at'    => 'Fecha de Compra',
            // 'total'           => 'Total',
            // 'payment_status'  => 'Estado de Pago',
            'observations'    => 'Observaciones',
        ];
    }
}
