<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guarantee extends Model
{
    use HasFactory;

    protected $fillable = [
        'corporate_reference_number', 
        'guarantee_type', 
        'nominal_amount', 
        'nominal_amount_currency', 
        'expiry_date', 
        'applicant_name', 
        'applicant_address', 
        'beneficiary_name', 
        'beneficiary_address'
    ];
}
