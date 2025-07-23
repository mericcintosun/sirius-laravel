<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            $orders = $user->orders()
                          ->with(['orderItems.product'])
                          ->orderBy('created_at', 'desc')
                          ->get();

            return response()->json([
                'data' => OrderResource::collection($orders)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch orders',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function store(CreateOrderRequest $request): JsonResponse
    {
        try {
            $user = $request->user();
            $cartItems = $user->cartItems()->with('product')->get();

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'message' => 'Cart is empty'
                ], 400);
            }

            DB::beginTransaction();

            // Validate stock for all items
            foreach ($cartItems as $cartItem) {
                if ($cartItem->quantity > $cartItem->product->stock) {
                    DB::rollback();
                    return response()->json([
                        'message' => "Not enough stock for product: {$cartItem->product->name}"
                    ], 400);
                }

                if (!$cartItem->product->is_active) {
                    DB::rollback();
                    return response()->json([
                        'message' => "Product is no longer available: {$cartItem->product->name}"
                    ], 400);
                }
            }

            // Calculate total amount
            $totalAmount = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });

            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => Order::generateOrderNumber(),
                'status' => 'pending',
                'total_amount' => $totalAmount,
                'delivery_address' => $request->delivery_address,
                'notes' => $request->notes,
            ]);

            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ]);

                $cartItem->product->decrement('stock', $cartItem->quantity);
            }

            // Clear cart
            $user->cartItems()->delete();

            DB::commit();

            $order->load(['orderItems.product']);

            return response()->json([
                'data' => new OrderResource($order),
                'message' => 'Order created successfully'
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Failed to create order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Request $request, string $id): JsonResponse
    {
        try {
            $user = $request->user();
            $order = $user->orders()
                         ->with(['orderItems.product'])
                         ->findOrFail($id);

            return response()->json([
                'data' => new OrderResource($order)
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Order not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch order',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function track(Request $request, string $orderNumber): JsonResponse
    {
        try {
            $user = $request->user();
            $order = $user->orders()
                         ->where('order_number', $orderNumber)
                         ->with(['orderItems.product'])
                         ->firstOrFail();

            return response()->json([
                'data' => new OrderResource($order)
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Order not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to track order',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
