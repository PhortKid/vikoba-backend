<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Show ONLY latest company (system behaves like single company setup)
     */
    public function show()
    {
        $company = Company::latest()->first();

        return response()->json([
            'message' => 'Company details loaded',
            'data' => $company
        ]);
    }

    /**
     * Update ONLY the latest company
     */
    public function update(Request $request)
    {
        $company = Company::latest()->first();

        if (!$company) {
            return response()->json([
                'message' => 'No company found to update'
            ], 404);
        }

        $data = $request->validate([
            'CompanyName' => 'sometimes|string',
            'CompanyShortCode' => 'sometimes|string|max:3',
            'RegistrationNumber' => 'nullable|string',
            'LicenseNumber' => 'nullable|string',
            'TIN' => 'nullable|string',
            'Address' => 'nullable|string',
            'Region' => 'nullable|string',
            'District' => 'nullable|string',
            'Phone' => 'nullable|string',
            'Email' => 'nullable|email',

            'BaseCurrency' => 'nullable|string',
            'MinimumLoanAmount' => 'nullable|numeric',
            'MaximumLoanAmount' => 'nullable|numeric',
            'InterestRate' => 'nullable|numeric',
            'PenaltyRate' => 'nullable|numeric',

            'HighRiskLevel' => 'nullable|numeric',
            'MediumRiskLevel' => 'nullable|numeric',
            'LowRiskLevel' => 'nullable|numeric',

            'KYCRequired' => 'boolean',
            'AMLPolicyEnabled' => 'boolean',
            'AMLPolicyMaxAmount' => 'nullable|numeric',
            'AgreementCompanyPolicy' => 'nullable|string',
        ]);

        $company->update($data);

        return response()->json([
            'message' => 'Company updated successfully',
            'data' => $company->fresh()
        ]);
    }
}