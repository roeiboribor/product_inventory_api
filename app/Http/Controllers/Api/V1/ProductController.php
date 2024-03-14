<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\ProductRequest;
use App\Http\Requests\Api\Products\StockRequest;
use App\Models\InventoryLevel;
use App\Models\Product;
use App\Traits\Helpers;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Orion\Http\Requests\Request;

class ProductController extends Controller
{
    use DisableAuthorization, Helpers;
    /**
     * Fully-qualified model class name
     */
    protected $model = Product::class;

    protected $request = ProductRequest::class;

    /**
     * The attributes that are used for searching.
     *
     * @return array
     */
    public function searchableBy(): array
    {
        return ['name'];
    }

    /**
     * The attributes that are used for filtering.
     *
     * @return array
     */
    public function filterableBy(): array
    {
        return ['category.name', 'price'];
    }

    /**
     * The relations that are allowed to be included together with a resource.
     *
     * @return array
     */
    public function includes(): array
    {
        return ['category.*'];
    }

    public function afterIndex()
    {

        // Your code here

        return view('');
    }

    //* >>>>>>>>> CUSTOM FUNCTIONS <<<<<<<<<<<<<
    public function adjustStock(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer'],
            'quantity' => ['required', 'numeric', 'not_in:0'],
        ], [
            'not_in' => 'Value must not be zero (0)'
        ]);

        $responses = [
            'status' => 500,
            'message' => 'Oops! Something went wrong!',
        ];

        try {
            $product = Product::select('id', 'name', 'quantity')->findOrFail($request->product_id);
            $adjustmentQty = (int)$data['quantity'];
            $total = $product->quantity + ($adjustmentQty);
            $responses['status'] = 200;

            // check if negative value of stock
            if ($this->checkPositiveOrNegative($total) == 'negative') {
                $responses['message'] = 'Invalid stock negative value!';
            } else {
                // Update Products current stock
                $product->quantity = $total;
                $product->save();

                // Add Inventory Activity Logs
                InventoryLevel::create([
                    'product_id' => $product->id,
                    'quantity' => $adjustmentQty
                ]);

                $responses['message'] = 'Successfully updated the Inventory level!';
                $responses['data'] = $product;
            }
        } catch (\Exception $err) {
            \Log::error('Error: ' . $err);
        }

        return response()->json([
            ...$responses
        ]);
    }
}
