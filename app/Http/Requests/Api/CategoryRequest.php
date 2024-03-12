<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;
use Orion\Http\Requests\Request;

class CategoryRequest extends Request
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
            'name' => ['required', 'string', 'max:255', Rule::unique('categories')]
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
            'name' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($this->category)]
        ];
    }
}
