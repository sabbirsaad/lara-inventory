<?php

namespace App\Http\Controllers;

use App\Models\ProductUnit;
use Illuminate\Http\Request;

class ProductUnitController extends Controller
{
    public function index()
    {
        $units = ProductUnit::all();
        return view('productUnit.productUnit', compact('units'))->with('sl', 1);
    }
    public function store(Request $request)
    {
        $request->validate([
            'unit_name' => 'required'
        ]);

        $store = new ProductUnit();
        $store->unit_name = $request->unit_name;
        $store->save();

        return back()->with('success', 'Unit Added successfully');
    }
    public function edit($unit_id)
    {
        $unit = ProductUnit::findOrFail($unit_id);
        $units = ProductUnit::all();
        return view('productUnit.productUnit', compact('units', 'unit'))->with('sl', 1);
    }


    public function update(Request $request, $unit_id)
    {
        $request->validate([
            'unit_name' => 'required'
        ]);

        $store = ProductUnit::findOrFail($unit_id);
        $store->unit_name = $request->unit_name;
        $store->save();

        return redirect()->route('units.index')->with('success', 'Unit Updated successfully');
    }
}
