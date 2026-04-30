<?php

namespace App\Http\Controllers;

use App\Models\LoanProduct;
use Illuminate\Http\Request;

class LoanProductController extends Controller
{
    public function index()
    {
        return response()->json(
            LoanProduct::with(['branch', 'company', 'fees'])->latest()->get()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'CompanyId' => 'required|integer',
            'BranchId' => 'nullable|integer',
            'ProductCode' => 'required|unique:loan_products,ProductCode',
            'ProductName' => 'required|string',
            'ProductDescription' => 'nullable|string',
            'MinLoanAmount' => 'required|numeric',
            'MaxLoanAmount' => 'required|numeric',
            'InterestRate' => 'required|numeric',
            'InterestType' => 'required|string',
            'MinTermDays' => 'required|integer',
            'MaxTermDays' => 'required|integer',
            'RepaymentFrequency' => 'required|string',
            'CollateralRequired' => 'boolean',
            'CollateralPercent' => 'nullable|numeric',
        ]);

        $product = LoanProduct::create($data);

        return response()->json([
            'message' => 'Loan product created successfully',
            'data' => $product
        ]);
    }

    public function show($id)
    {
        return response()->json(
            LoanProduct::with(['fees', 'branch', 'company'])->findOrFail($id)
        );
    }

    public function update(Request $request, $id)
    {
        $product = LoanProduct::findOrFail($id);

        $product->update($request->all());

        return response()->json([
            'message' => 'Loan product updated successfully',
            'data' => $product
        ]);
    }

    public function destroy($id)
    {
        LoanProduct::destroy($id);

        return response()->json([
            'message' => 'Loan product deleted successfully'
        ]);
    }
}