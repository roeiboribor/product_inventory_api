<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;
use Orion\Http\Requests\Request;

class ProductRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function storeRules(): array
    {
        return [
            'category_id' => ['required', 'integer'],
            'name' => [
                'required', 'string', 'max:255',
                Rule::unique('products')
                    ->where('category_id', $this->category_id)
            ],
            'description' => ['required', 'string'],
            'price' => ['required', 'decimal:2'],
        ];
    }

    /**
     * Update Rules for Category -> Ignore Self
     *
     * @return array
     */
    public function updateRules(): array
    {
        return [
            'category_id' => ['required', 'integer'],
            'name' => [
                'required', 'string', 'max:255',
                Rule::unique('products')
                    ->where('category_id', $this->category_id)
                    ->ignore($this->product)
            ],
            'description' => ['required', 'string'],
            'price' => ['required', 'decimal:2'],
        ];
    }
}
