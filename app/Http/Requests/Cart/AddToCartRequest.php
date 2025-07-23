<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

class AddToCartRequest extends FormRequest
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
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1']
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($this->has('product_id') && $this->has('quantity')) {
                $product = Product::find($this->product_id);
                
                if ($product && !$product->is_active) {
                    $validator->errors()->add('product_id', 'This product is not available.');
                }
                
                if ($product && $this->quantity > $product->stock) {
                    $validator->errors()->add('quantity', 'Requested quantity exceeds available stock.');
                }
            }
        });
    }
    public function messages(): array
    {
        return [
            'product_id.required' => 'Product ID is required.',
            'product_id.exists' => 'Selected product does not exist.',
            'quantity.required' => 'Quantity is required.',
            'quantity.integer' => 'Quantity must be a number.',
            'quantity.min' => 'Quantity must be at least 1.'
        ];
    }
}
