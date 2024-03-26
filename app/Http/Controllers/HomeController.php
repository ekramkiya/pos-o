<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Expenses;
use App\Models\OrderItem;
use App\Models\Product;


use App\Models\ProductBuy;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::with(['items', 'payments'])->get();
        $customers_count = Customer::count();
        $users_count = User::count();
        $expenses_count = Expenses::sum('amount');
        $purchase_sum = ProductBuy::sum('price');

        $total_shortage_quantity = Product::where('quantity', '<', 10)->count('quantity');

        $currentDate = Carbon::now()->toDateString();

        $expenses_daily = Expenses::whereDate('created_at', $currentDate)->sum('amount');

        return view('home', [
            'orders_count' => $orders->count(),
            'income' => $orders->map(function ($i) {
                if ($i->receivedAmount() > $i->total()) {
                    return $i->total();
                }
                return $i->receivedAmount();
            })->sum(),


            'unpaid_count' => $orders->filter(function ($i) {
                return $i->receivedAmount() < $i->total();
            })->count(),

            'unpaid' => $orders->filter(function ($i) {
                return $i->receivedAmount() < $i->total();
            })->map(function ($i) {
                return $i->total() - $i->receivedAmount();
            })->sum(),

            'income_today' => $orders->where('created_at', '>=', date('Y-m-d') . ' 00:00:00')->map(function ($i) {
                if ($i->receivedAmount() > $i->total()) {
                    return $i->total();
                }
                return $i->receivedAmount();
            })->sum(),


            'customers_count' => $customers_count,
            'users_count' => $users_count,
            'expenses_count' => $expenses_count,
            'expenses_daily' => $expenses_daily,
            'purchase_sum' => $purchase_sum,
        'total_shortage_quantity' => $total_shortage_quantity,
            

            



        ]);
      

        
    }
}
