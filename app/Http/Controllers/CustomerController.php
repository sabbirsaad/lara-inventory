<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {
        $customers = Customer::orderBy('customer_id', 'DESC')->paginate(5);
        return view('customer.customerList', compact('customers'))->with('sl', 1);
    }


    public function create()
    {
        return view('customer.customerCreate');
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'customer_name' => 'required',
                'phone' => 'required|max:11',
                'email' => 'required|email'
            ]
        );
        $customer = new Customer();
        $customer->customer_name = $request->customer_name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->save();

        return redirect()->route('customers.index')->with('success', 'Customer Added Successfully');
    }



    public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        return view('customer.customerEdit', compact('customer'));
    }


    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'customer_name' => 'required',
                'phone' => 'required|max:11',
                'email' => 'required|email'
            ]
        );
        $customer = Customer::findOrFail($id);
        $customer->customer_name = $request->customer_name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->save();

        return redirect()->route('customers.index')->with('success', 'Customer Updated Successfully');
    }

    public function search(Request $request)
    {

        $customers = Customer::where('customer_name', 'LIKE', '%' . $request->search . '%')->orWhere('email', 'LIKE', '%' . $request->search . '%')->orWhere('phone', 'LIKE', '%' . $request->search . '%')->orWhere('address', 'LIKE', '%' . $request->search . '%')->get();
        return response()->json(['customers' => $customers]);
    }
}
