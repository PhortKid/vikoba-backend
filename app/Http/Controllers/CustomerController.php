<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index()
    {
        $customers=Customer::all();
        return response()->json($customers);
    }

     public function save(Request $request)
    {
        $data = $request->validate([
            'first_name'      => 'required|string|max:255',
            'middle_name'     => 'nullable|string|max:255',
            'last_name'       => 'required|string|max:255',
            'national_id'     => 'required|string|max:255',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
            'address'         => 'nullable|string|max:1000',
            'gender'          => 'nullable|in:male,female,none',
            'mobile'          => 'nullable|string|max:50',
            'email'           => 'nullable|email|max:255',
            'employment_type' => 'nullable|in:government,private,student,business',
            'salary'          => 'nullable|numeric'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('customers', 'public');
        }

        $data['gender'] = $data['gender'] ?? 'none';
        $data['employment_type'] = $data['employment_type'] ?? 'business';

        Customer::create($data);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Customer Created'
            ],
            201
        );
    }


        public function update(Request $request, $id)
    {
       
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['status' => 'error', 'message' => 'Customer not found'], 404);
        }

       
        $data = $request->validate([
            'first_name'      => 'sometimes|required|string|max:255',
            'middle_name'     => 'nullable|string|max:255',
            'last_name'       => 'sometimes|required|string|max:255',
            'national_id'     => 'sometimes|required|string|max:255',
         //   'image'           => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
            'address'         => 'nullable|string|max:1000',
            'gender'          => 'sometimes|required|in:male,female,none',
            'mobile'          => 'nullable|string|max:50',
            'email'           => 'nullable|email|max:255',
            'employment_type' => 'sometimes|required|in:government,private,student,business',
            'salary'          => 'nullable|numeric'
        ]);

        if ($request->hasFile('image')) {
            if ($customer->image && Storage::disk('public')->exists($customer->image)) {
                Storage::disk('public')->delete($customer->image);
            }

            $data['image'] = $request->file('image')->store('customers', 'public');
        }

        $customer->update($data);

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
