<?php

namespace App\Http\Requests\Api\Products;

use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
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
            'product_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer', 'min:-9999', 'max:9999'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'product_id' => (int)$this->product_id,
            'quantity' => (int)$this->quantity,
        ]);
    }
}
