<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanProduct extends Model
{
    protected $table = 'loan_products';


    protected $fillable = [
        'CompanyId',
        'BranchId',
        'ProductCode',
        'ProductName',
        'ProductDescription',
        'MinLoanAmount',
        'MaxLoanAmount',
        'InterestRate',
        'InterestType',
        'MinTermDays',
        'MaxTermDays',
        'RepaymentFrequency',
        'CollateralRequired',
        'CollateralPercent',
        'Active',
    ];

    protected $casts = [
        'CollateralRequired' => 'boolean',
        'Active' => 'boolean',
        'InterestRate' => 'float',
        'CollateralPercent' => 'float',
    ];

    // Belongs to Company
    public function company()
    {
        return $this->belongsTo(Company::class, 'CompanyId', 'CompanyId');
    }

    // Belongs to Branch (optional)
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'BranchId', 'BranchId');
    }

    // Has many Fees
    public function fees()
    {
        return $this->hasMany(LoanProductFee::class, 'LoanProductId', 'LoanProductId');
    }
}