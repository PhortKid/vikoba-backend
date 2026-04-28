<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers=Customer::all();
        return response()->json($customers);
    }

     public function save(Request $request)
    {
        Customer::create(
            [
                'first_name'=>$request->first_name,
                'middle_name'=>$request->middle_name,
                'last_name'=>$request->last_name,
                'national_id'=>$request->national_id,
                'image'=>$request->image,
                'address'=>$request->address,
                'gender'=>$request->gender,
                'mobile'=>$request->mobile,
                'email'=>$request->email,
          
                'employment_type'=>$request->employment_type,
                'salary'=>$request->salary
            ]
        );


        return response()->json(
            [
                'status'=>'success',
                'message'=>'Customer Created'
            ]
        );
    }


        public function update(Request $request, $id)
    {
       
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['status' => 'error', 'message' => 'Customer not found'], 404);
        }

       
        $customer->update([
            'first_name'      => $request->first_name,
            'middle_name'     => $request->middle_name,
            'last_name'       => $request->last_name,
            'national_id'     => $request->national_id,
            'image'           => $request->image,
            'address'         => $request->address,
            'gender'          => $request->gender,
            'mobile'          => $request->mobile,
            'email'           => $request->email,
            'employment_type' => $request->employment_type,
            'salary'          => $request->salary
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Customer Updated Successfully'
        ]);
       
        
    }

         public function view(Request $request, $id)
    {
       
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['status' => 'error', 'message' => 'Customer not found'], 404);
        }

      
       
        return response()->json($customer);
       
        
    }


     public function delete(Request $request, $id)
    {
       
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['status' => 'error', 'message' => 'Customer not found'], 404);
        }

       $customer->delete();
       
        return response()->json([
            'status'  => 'success',
            'message' => 'Customer Deleted Successfully'
        ]);
       
        
    }


}
