<?php

namespace App\Http\Controllers\custom;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $products = Product::with(['user', 'order'])->where('name', 'like', '%' . $search . '%')->get();
        return view('admin.index', compact(['products']));
    }

    public function show()
    {
        $order = Order::with(['product', 'user', 'transaction'])->get();
        return view('admin.order.index', compact(['order']));
    }
    public function confirm($id)
    {
        $order = Order::find($id);
        $order->is_confirmed = true;
        $order->save();

        $product = Product::find($order->product_id);
        $newStock = $product->stock - $order->amount;
        $product->stock = $newStock;
        $product->save();

        if ($product->stock === 0) {
            Product::destroy($id);
        }
        return redirect()->route('orderAdmin.show')->with('success', 'Pesanan Dikonfirmasi');
    }
    public function cancel($id)
    {
        $order = Order::find($id);
        $order->is_confirmed = false;
        $order->save();
        return redirect()->route('orderAdmin.show')->with('success', 'Pesanan Unkonfirmasi');
    }
    public function transactionshow()
    {
        $transaction = Transaction::with(['order'])->get();
        return view('admin.transaction.index', compact(['transaction']));
    }
}
