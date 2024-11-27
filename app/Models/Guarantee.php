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
        'beneficiary_address',
    ];

    protected $casts = [
        'nominal_amount' => 'float',
        'expiry_date' => 'date',
    ];

    public static function rules()
    {
        return [
            'corporate_reference_number' => 'required|string|unique:guarantees',
            'guarantee_type' => 'required|in:Bank,Bid Bond,Insurance,Surety',
            'nominal_amount' => 'required|numeric|min:0',
            'nominal_amount_currency' => 'required|string|size:3',
            'expiry_date' => 'required|date|after:today',
            'applicant_name' => 'required|string',
            'applicant_address' => 'required|string',
            'beneficiary_name' => 'required|string',
            'beneficiary_address' => 'required|string',
        ];
    }
}
