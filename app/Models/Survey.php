<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'business_line',
        'antiquity',
        'self_inversion',
        'gain',
        'other_gains',
        'other_credits',
        'credit_amount',
        'bad_record',
        'self_record',
        'name_giver',
        'family_knows',
        'how_financial'
    ];
}
