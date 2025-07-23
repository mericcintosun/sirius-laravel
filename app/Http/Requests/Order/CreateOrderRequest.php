<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
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
            'delivery_address' => ['nullable', 'string', 'max:1000'],
            'notes' => ['nullable', 'string', 'max:500']
        ];
    }

    public function messages(): array
    {
        return [
            'delivery_address.string' => 'Delivery address must be text.',
            'delivery_address.max' => 'Delivery address cannot exceed 1000 characters.',
            'notes.string' => 'Notes must be text.',
            'notes.max' => 'Notes cannot exceed 500 characters.'
        ];
    }
}
