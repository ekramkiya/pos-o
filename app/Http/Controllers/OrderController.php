<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{


    public function __construct()
    {
       $this->middleware('permission:order view',['only'=>['index']]);
        $this->middleware('permission:order edit',['only'=>['edit', 'update']]);
        $this->middleware('permission:order delete',['only'=>['destroy']]);

    }

    public function index(Request $request)
    {
        $orders = new Order();
        if ($request->start_date) {
            $orders = $orders->where('created_at', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $orders = $orders->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }
        
       
        if ($request->filled('query')) {
            $searchQuery = $request->query('query');
            $orders = $orders->where(function ($query) use ($searchQuery) {
                $query->whereHas('customer', function ($query) use ($searchQuery) {
                    $query->where('first_name', 'like', '%' . $searchQuery . '%')
                        ->orWhere('last_name', 'like', '%' . $searchQuery . '%');
                })->orWhere('id', $searchQuery);
            });

        }
    
        $orders = $orders->with(['items', 'payments', 'customer'])->latest()->paginate(10);
    
        $total = $orders->map(function ($i) {
            return $i->total();
        })->sum();
        $receivedAmount = $orders->map(function ($i) {
            return $i->receivedAmount();
        })->sum();
    
        // Determine which view to render based on a condition
        if ($request->has('unpaid_only')) {
            return view('orders.unpaid_orders', compact('orders', 'total', 'receivedAmount'));
        } elseif ($request->has('paid_only')) {
            $todayPayments = Order::whereDate('created_at', today())->get();
            return view('orders.paid_orders', compact('todayPayments', 'orders', 'total', 'receivedAmount'));
        } else {
            return view('orders.index', compact('orders', 'total', 'receivedAmount'));
        }
    }

    public function store(OrderStoreRequest $request)
    {
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'user_id' => $request->user()->id,
        ]);

        $cart = $request->user()->cart()->get();
        foreach ($cart as $item) {
            $order->items()->create([
                'price' => $item->price * $item->pivot->quantity,
                'quantity' => $item->pivot->quantity,
                'product_id' => $item->id,
            ]);
            $item->quantity = $item->quantity - $item->pivot->quantity;
            $item->save();
        }
        $request->user()->cart()->detach();
        $order->payments()->create([
            'amount' => $request->amount,
            'user_id' => $request->user()->id,
        ]);
        return 'success';
    }


    public function edit(Order $order)
    {
        $recieved_amount =  Payment::all();
        return view('orders.edit')->with(compact('order', 'recieved_amount'));
    }


    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
        ]);

        $order->payments()->update([
            'amount' => $validatedData['amount'],
        ]);

        return redirect()->route('orders.index')->with('success', 'Received amount updated successfully!');
    }


    public function destroy(Order $order)
    {
        $order->delete();

        return new JsonResponse([
            'success' => true
        ]);
    }
}
