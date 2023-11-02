<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductUnit;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['search'] ?? '';
        if ($search != "") {
            $products = Product::where('product_name', 'LIKE', "%$search%")->orWhere('product_code', 'LIKE', "%$search%")->paginate(5);
        } else {
            $products = Product::orderBy('id', 'DESC')->paginate(5);
        }

        return view('product.productList', compact('products', 'search'))->with('sl', 1);
    }

    public function create()
    {
        $units = ProductUnit::all();
        return view('product.productCreate', compact('units'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'product_name' => 'required',
                'product_code' => 'required|unique:products',
                'product_unit' => 'required',
                'image' => 'sometimes|image:gif,png,jpeg,jpg'
            ]
        );
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->unit_id = $request->product_unit;

        $product->save();

        if ($request->image) {
            $ext = $request->image->getClientOriginalExtension();
            $newFileName = time() . '.' . $ext;
            $request->image->move(public_path() . '/uploads/products', $newFileName);
            $product->image = $newFileName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product Added Successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $image_path = public_path() . '/uploads/products/' . $product->image;
   

        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $product->inventoryDetails()->delete();
        $product->delete();
        return redirect()->route('products.index')->with('success', "Product deleted successfully");
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('product.productEdit', ['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'product_name' => 'required',
                'product_code' => "required|unique:products,product_code," . $id,
                'image' => 'sometimes|image:gif,png,jpeg,jpg'
            ]
        );
        $product = Product::findOrFail($id);
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->save();

        if ($request->image) {
            $oldImage = $product->image;
            $ext = $request->image->getClientOriginalExtension();
            $newFileName = time() . '.' . $ext;
            $request->image->move(public_path() . '/uploads/products', $newFileName);
            $product->image = $newFileName;
            $product->save();
            $image_path = public_path() . '/uploads/products/' . $oldImage;

            if (File::exists($image_path)) {
            File::delete($image_path);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product Updated Successfully');
    }
}
