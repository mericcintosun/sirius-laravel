<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\CartItem;

class UpdateCartRequest extends FormRequest
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
            'quantity' => ['required', 'integer', 'min:1']
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($this->has('quantity')) {
                $cartItem = CartItem::find($this->route('id'));
                
                if ($cartItem && $cartItem->product && $this->quantity > $cartItem->product->stock) {
                    $validator->errors()->add('quantity', 'Requested quantity exceeds available stock.');
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            'quantity.required' => 'Quantity is required.',
            'quantity.integer' => 'Quantity must be a number.',
            'quantity.min' => 'Quantity must be at least 1.'
        ];
    }
}
