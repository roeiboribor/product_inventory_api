<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\RelationController;

class CategoryProductsController extends RelationController
{
    use DisableAuthorization;
    /**
     * Fully-qualified model class name
     */
    protected $model = Category::class;

    /**
     * Name of the relationship as it is defined on the Category model
     */
    protected $relation = 'products';
}
