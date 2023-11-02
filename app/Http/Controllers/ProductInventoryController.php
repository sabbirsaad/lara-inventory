<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductInventoryController extends Controller
{
    public function index()
    {

        $inventories = ProductInventory::orderBy('product_inventory_id', 'desc')->paginate(5);
        return view('inventories.inventoryList', compact('inventories'))->with('sl', 1);
    }
    public function create()
    {
        $products = Product::all();
        return view('inventories.inventoryCreate', compact('products'));
    }

    public function store(Request $request)
    {
        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }
        // dd($request->all());
        $inventory = new ProductInventory();
        $inventory->supplier = $request->supplier;
        $inventory->chalan_no = $request->chalan_no;
        $inventory->remarks = $request->remarks;
        $inventory->received_date = $request->received_date;
        $inventory->created_by = $data->id;
        $inventory->save();

        $products = $request->product_id;
        $purchase_price = $request->purchase_price;
        $quantity = $request->quantity;
        $sub_total = $request->sub_total;

        for ($i = 0; $i < count($products); $i++) {
            $data = [
                'product_inventory_id' => $inventory->product_inventory_id,
                'product_id' => $products[$i],
                'purchase_price' => $purchase_price[$i],
                'quantity' => $quantity[$i],
                'sub_total' => $sub_total[$i],

            ];
            DB::table('product_inventory_details')->insert($data);

            $item_exists = Stock::where('product_id', $products[$i])->where('price', number_format($purchase_price[$i], 2))->get();
            // add item to product_stocks table if not exists
            if (count($item_exists) == 0) {
                Stock::create([
                    'product_id' => $products[$i],
                    'price' =>  $purchase_price[$i],
                    'stock' => $quantity[$i],

                ]);
            } else {
                // update stock if exists
                $item_exists->first()->update([
                    'stock' => DB::raw("stock + {$quantity[$i]}"),
                ]);
            }
        }



        return redirect()->route('inventories.index')->with('success', 'Added Successfully into Inventory');
    }
}
