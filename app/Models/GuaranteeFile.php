<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuaranteeFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'corporate_reference_number', // Corporate Reference Number as foreign key
        'file_type',
        'file_content',
    ];



    /**
     * Define the relationship with the Guarantee model.
     */
    public function guarantee()
    {
        return $this->belongsTo(Guarantee::class, 'corporate_reference_number', 'corporate_reference_number');
    }
}
