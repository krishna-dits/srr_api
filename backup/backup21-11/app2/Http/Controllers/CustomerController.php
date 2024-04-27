<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use DB;

class CustomerController extends Controller
{
    public function CustomerCreate(Request $request)
    {
        $last_number = Customer::latest()->first();
        $is_number = $last_number->cus_id;
        $originalString = $is_number;
        $numericPart = preg_replace('/[^0-9]/', '', $originalString);
        $is_numbers = intval($numericPart) + 1;
        $formattedNumber = str_pad($is_numbers, strlen($numericPart), '0', STR_PAD_LEFT);
        $CustNumber = "CUST/" . $is_numbers;

        return view('setup.customer.create-customer', compact('CustNumber'));
    }

    public function Customerlist()
    {
        $customer  = Customer::get();
        return view('setup.customer.customer-list', compact('customer'));
    }

    public function CustomerCreateAction(Request $request)
    {

        $request->validate([
            'cus_name' => "required|",
            'address1' => 'required',
        ]);

        

            

            $customer = new Customer();
            $customer->cus_id =  'CUST/' . $request->id;
            $customer->cus_name = $request->cus_name;
            $customer->address1 = $request->address1;
            $customer->address2 = $request->address2;
            //dd($customer);
            $customer->save();

            return redirect()->route('Customer-list')->with('success', 'Customer Created Sucessfully');
       
    }

    public function Customer_delete($id)
    {
        try {
            DB::beginTransaction();
            $u_id = base64_decode($id);
            $user = Customer::find($u_id);
            $user->delete();
            DB::commit();
            return redirect()->route('Customer-list')->with('success', 'Customer Deleted Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('Customer-list')->with('error', $th->getMessage());
        }
    }

    public function Customer_edit(Request $request, $id)
    {
        $u_id = base64_decode($id);

        $editCustomer = Customer::where('id', $u_id)->first();

        return view('setup.customer.edit-customer', compact('editCustomer'));
    }

    public function Customer_update(Request $request)
    {

        $request->validate([
            'cus_name' => "required",
            'address1' => 'required',
        ]);

        try {

            DB::beginTransaction();

            $customer = Customer::where('id', $request->id)->first();
            $customer->cus_name = $request->cus_name;
            $customer->address1 = $request->address1;
            $customer->address2 = $request->address2;
            $customer->save();

            DB::commit();
            return redirect()->route('Customer-list')->with('success', 'Customer Updated Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
