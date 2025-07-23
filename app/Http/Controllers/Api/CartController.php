<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Requests\Cart\UpdateCartRequest;
use App\Http\Resources\CartItemResource;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            $cartItems = $user->cartItems()->with('product')->get();

            $totalItems = $cartItems->sum('quantity');
            $totalAmount = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });

            return response()->json([
                'items' => CartItemResource::collection($cartItems),
                'total_items' => $totalItems,
                'total_amount' => round($totalAmount, 2)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch cart items',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function store(AddToCartRequest $request): JsonResponse
    {
        try {
            $user = $request->user();
            $product = Product::findOrFail($request->product_id);

            DB::beginTransaction();

            $existingItem = CartItem::where('user_id', $user->id)
                                  ->where('product_id', $product->id)
                                  ->first();

            if ($existingItem) {
                // Update quantity
                $newQuantity = $existingItem->quantity + $request->quantity;
                
                if ($newQuantity > $product->stock) {
                    return response()->json([
                        'message' => 'Not enough stock available'
                    ], 400);
                }

                $existingItem->update(['quantity' => $newQuantity]);
                $cartItem = $existingItem->load('product');
            } else {
                // Create new cart item
                $cartItem = CartItem::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                ]);
                $cartItem->load('product');
            }

            DB::commit();

            return response()->json([
                'data' => new CartItemResource($cartItem),
                'message' => 'Product added to cart successfully'
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Failed to add product to cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateCartRequest $request, string $id): JsonResponse
    {
        try {
            $user = $request->user();
            $cartItem = CartItem::where('user_id', $user->id)
                              ->where('id', $id)
                              ->with('product')
                              ->firstOrFail();

            DB::beginTransaction();

            $cartItem->update(['quantity' => $request->quantity]);

            DB::commit();

            return response()->json([
                'data' => new CartItemResource($cartItem->fresh('product')),
                'message' => 'Cart item updated successfully'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Cart item not found'
            ], 404);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Failed to update cart item',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * destroy function
     */
    public function destroy(Request $request, string $id): JsonResponse
    {
        try {
            $user = $request->user();
            $cartItem = CartItem::where('user_id', $user->id)
                              ->where('id', $id)
                              ->firstOrFail();

            $cartItem->delete();

            return response()->json([
                'message' => 'Product removed from cart successfully'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Cart item not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to remove product from cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * clear function
     */
    public function clear(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            $user->cartItems()->delete();

            return response()->json([
                'message' => 'Cart cleared successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to clear cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
