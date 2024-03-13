<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\ProductRequest;
use App\Models\Product;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;

class ProductController extends Controller
{
    use DisableAuthorization;
    /**
     * Fully-qualified model class name
     */
    protected $model = Product::class;

    protected $request = ProductRequest::class;
}
