<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::orderBy('order_id', 'DESC')->paginate(5);
        return view('order.orderList', compact('orders'))->with('sl', 1);
    }
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        $stocks = Stock::all();
        return view('order.orderCreate', ['customers' => $customers, 'products' => $products, 'stocks' => $stocks]);
    }

    public function store(Request $request)
    {
        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }
        $order = new Order();
        $order->customer_id = $request->customer_id;
        $order->sale_no = $request->sale_no;
        $order->remarks = $request->remarks;
        $order->created_by = $data->id;
        $order->save();

        $products = $request->product_id;
        $product_price = $request->product_price;
        $quantity = $request->product_quantity;
        $sub_total = $request->sub_total;

        for ($i = 0; $i < count($products); $i++) {
            $data = [
                'order_id' => $order->order_id,
                'product_id' => $products[$i],
                'price' => $product_price[$i],
                'quantity' => $quantity[$i],
                'sub_total' => $sub_total[$i],

            ];
            DB::table('order_details')->insert($data);

            // update stock
            Stock::findOrFail($products[$i])->update([
                'stock' => DB::raw("stock - {$quantity[$i]}"),

            ]);
        }



        return redirect()->route('orders.index')->with('success', 'Order Successful');
    }

    // public function product_stock(Request $request)
    // {
    //     $product_id = $request->get('product_id');
    //     echo  $stock = DB::table('product_inventories')->where('product_id', $product_id)->sum('quantity');
    //     die;
    // }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('order.orderShow', compact('order'));
    }
}
