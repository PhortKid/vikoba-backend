<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';
   

    protected $fillable = [
        //'CompanyId',
        'BranchCode',
        'BranchName',
        'Region',
        'District',
        'Ward',
        'Street',
        'PhysicalAddress',
        'Longitude',
        'Latitude',
        'Phone',
        'Email',
        'MinLoanAmountAllowed',
        'MaxLoanAmountAllowed',
        'MaxLoanApprovalLimit',
        'DailyLoanDisbursementLimit',
        'DailyCollectionTarget',
        'CashHoldingLimit',
        'Active',
    ];

    protected $casts = [
        'Active' => 'boolean',
        'Longitude' => 'float',
        'Latitude' => 'float',
    ];

    // Branch belongs to Company
   /* public function company()
    {
        return $this->belongsTo(Company::class, 'CompanyId', 'CompanyId');
    }*/

    // Branch has many Loan Products
    public function loanProducts()
    {
        return $this->hasMany(LoanProduct::class, 'BranchId', 'BranchId');
    }
}