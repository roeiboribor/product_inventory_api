<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Product;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\RelationController;

class ProductCategoryController extends RelationController
{
    use DisableAuthorization;
    /**
     * Fully-qualified model class name
     */
    protected $model = Product::class; // or "App\Models\Product"

    /**
     * Name of the relationship as it is defined on the Product model
     */
    protected $relation = 'category';
}
