<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'CompanyName',
        'CompanyShortCode',
        'RegistrationNumber',
        'LicenseNumber',
        'TIN',
        'Address',
        'Region',
        'District',
        'Phone',
        'Email',

        'BaseCurrency',
        'MinimumLoanAmount',
        'MaximumLoanAmount',
        'InterestRate',
        'PenaltyRate',

        'HighRiskLevel',
        'MediumRiskLevel',
        'LowRiskLevel',
        'KYCRequired',
        'AMLPolicyEnabled',
        'AMLPolicyMaxAmount',
        'AgreementCompanyPolicy',
    ];
}