<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\CategoryRequest;
use App\Models\Category;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;

class CategoryController extends Controller
{
    use DisableAuthorization;

    /**
     * Fully-qualified model class name
     */
    protected $model = Category::class;

    protected $request = CategoryRequest::class;
}
