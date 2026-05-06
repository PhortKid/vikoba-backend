<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanProductFee extends Model
{
    protected $table = 'loan_product_fees';


    protected $fillable = [
        'LoanProductId',
        'FeeType',
        'CalculationType',
        'Value',
        'ApplyOn',
        'Frequency',
        'IsMandatory',
        'IsActive',
    ];

    protected $casts = [
        'IsMandatory' => 'boolean',
        'IsActive' => 'boolean',
        'Value' => 'float',
    ];

    // Fee belongs to Loan Product
    public function loanProduct()
    {
        return $this->belongsTo(LoanProduct::class, 'LoanProductId', 'id');
    }
}