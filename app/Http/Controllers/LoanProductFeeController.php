<?php

namespace App\Http\Controllers;

use App\Models\LoanProductFee;
use Illuminate\Http\Request;

class LoanProductFeeController extends Controller
{
    public function index()
    {
        return response()->json(
            LoanProductFee::with('loanProduct')->latest()->get()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'LoanProductId' => 'required|integer',
            'FeeType' => 'required|string',
            'CalculationType' => 'required|string',
            'Value' => 'required|numeric',
            'ApplyOn' => 'nullable|string',
            'Frequency' => 'nullable|string',
            'IsMandatory' => 'boolean',
            'IsActive' => 'boolean',
        ]);

        $fee = LoanProductFee::create($data);

        return response()->json([
            'message' => 'Fee created successfully',
            'data' => $fee
        ]);
    }

    public function show($id)
    {
        return response()->json(
            LoanProductFee::with('loanProduct')->findOrFail($id)
        );
    }

    public function update(Request $request, $id)
    {
        $fee = LoanProductFee::findOrFail($id);

        $fee->update($request->all());

        return response()->json([
            'message' => 'Fee updated successfully',
            'data' => $fee
        ]);
    }

    public function destroy($id)
    {
        LoanProductFee::destroy($id);

        return response()->json([
            'message' => 'Fee deleted successfully'
        ]);
    }
}