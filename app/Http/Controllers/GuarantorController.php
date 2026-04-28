<?php

namespace App\Http\Controllers;
use App\Models\Guarantor;
use Illuminate\Http\Request;

class GuarantorController extends Controller
{
    //
    public function index(){
       $guarantors=Guarantor::all();

       return response()->json($guarantors);
    }

     public function save(Request $request)
    {
        Guarantor::create(
            [
                'first_name'=>$request->first_name,
                'middle_name'=>$request->middle_name,
                'last_name'=>$request->last_name,
                'national_id'=>$request->national_id,
                'address'=>$request->address,
                'mobile'=>$request->mobile,
                'email'=>$request->email,
                'employment_type'=>$request->employment_type,
               
            ]
        );


        return response()->json(
            [
                'status'=>'success',
                'message'=>'Guarantor Created'
            ]
        );
    }


        public function update(Request $request, $id)
    {
       
        $guarantor = Guarantor::find($id);

        if (!$guarantor) {
            return response()->json(['status' => 'error', 'message' => 'Guarantor not found'], 404);
        }

       
       $guarantor->update([
           'first_name'         =>$request->first_name,
           'middle_name'        =>$request->middle_name,
           'last_name'          =>$request->last_name,
           'national_id'        =>$request->national_id,
           'address'            =>$request->address,
           'mobile'             =>$request->mobile,
           'email'              =>$request->email,
           'employment_type'    =>$request->employment_type,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Guarantor Updated Successfully'
        ]);
       
        
    }

      public function view(Request $request, $id)
    {
       
        $guarantor = Guarantor::find($id);

        if (!$guarantor) {
            return response()->json(['status' => 'error', 'message' => 'Guarantor not found'], 404);
        }

     
       
        return response()->json($guarantor);
       
        
    }


     public function delete(Request $request, $id)
    {
       
        $guarantor = Guarantor::find($id);

        if (!$guarantor) {
            return response()->json(['status' => 'error', 'message' => 'Guarantor not found'], 404);
        }

       $guarantor->delete();
       
        return response()->json([
            'status'  => 'success',
            'message' => 'Guarantor Deleted Successfully'
        ]);
       
        
    }


}
