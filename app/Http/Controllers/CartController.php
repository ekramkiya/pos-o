<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;



class CartController extends Controller


{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return response(
                $request->user()->cart()->get()
            );
        }
        return view('cart.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'barcode' => 'required|exists:products,barcode',
        ]);
        $barcode = $request->barcode;

        $product = Product::where('barcode', $barcode)->first();
        $cart = $request->user()->cart()->where('barcode', $barcode)->first();
        if ($cart) {
            // check product quantity
            if ($product->quantity <= $cart->pivot->quantity) {
                return response([
                    'message' => 'Product available only: ' . $product->quantity,
                ], 400);
            }
            // update only quantity
            $cart->pivot->quantity = $cart->pivot->quantity + 1;
            $cart->pivot->save();
        } else {
            if ($product->quantity < 1) {
                return response([
                    'message' => 'Product out of stock',
                ], 400);
            }
            $request->user()->cart()->attach($product->id, ['quantity' => 1]);
        }

        return response('', 204);
    }

    public function changeQty(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);
        $cart = $request->user()->cart()->where('id', $request->product_id)->first();

        if ($cart) {
            // check product quantity
            if ($product->quantity < $request->quantity) {
                return response([
                    'message' => 'Product available only: ' . $product->quantity,
                ], 400);
            }
            $cart->pivot->quantity = $request->quantity;
            $cart->pivot->save();
        }

        return response([
            'success' => true
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id'
        ]);
        $request->user()->cart()->detach($request->product_id);

        return response('', 204);
    }

    public function empty(Request $request)
    {
        $request->user()->cart()->detach();

        return response('', 204);
    }

    public function receivedAmount($orderId)
    {
       
        $order = Order::find($orderId);

       
        $receivedAmount = $order->receivedAmount();

        return $receivedAmount;
    }


    public function print()
    {
        $products = DB::table('products')->latest('id')->get();
        $latestOrderId = DB::table('order_items')->latest('id')->value('order_id');
        $orderItems = DB::table('order_items')->where('order_id', $latestOrderId)->get();
        $orders = Order::all();
      
        // Fetch product details for each order item
        foreach ($orderItems as $orderItem) {
            $productId = $orderItem->product_id;
            $product = $products->firstWhere('id', $productId);

            $orderItem->name = $product->name;
            $orderItem->description = $product->description;
        }

        $createdDate = $orderItems->first()->created_at;

       
        $receivedAmount = $this->receivedAmount($latestOrderId);

        return view('cart.print', compact('products', 'orderItems', 'createdDate', 'receivedAmount'));
    }

   
}
