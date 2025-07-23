<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Product::active();

            if ($request->has('search') && !empty($request->search)) {
                $query->search($request->search);
            }

            if ($request->has('category') && !empty($request->category)) {
                $query->byCategory($request->category);
            }

            $perPage = $request->get('per_page', 20);
            $perPage = min($perPage, 100); // Max 100 items per page

            $products = $query->orderBy('created_at', 'desc')
                            ->paginate($perPage);

            return response()->json([
                'data' => ProductResource::collection($products->items()),
                'current_page' => $products->currentPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
                'last_page' => $products->lastPage(),
                'from' => $products->firstItem(),
                'to' => $products->lastItem(),
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch products',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * show function
     */
    public function show(string $id): JsonResponse
    {
        try {
            $product = Product::active()->findOrFail($id);

            return response()->json([
                'data' => new ProductResource($product)
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * categories function
     */
    public function categories(): JsonResponse
    {
        try {
            $categories = Product::active()
                               ->select('category')
                               ->distinct()
                               ->whereNotNull('category')
                               ->orderBy('category')
                               ->pluck('category');

            return response()->json([
                'data' => $categories
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch categories',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * featured function
     */
    public function featured(): JsonResponse
    {
        try {
            $products = Product::active()
                             ->orderBy('created_at', 'desc')
                             ->limit(10)
                             ->get();

            return response()->json([
                'data' => ProductResource::collection($products)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch featured products',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
