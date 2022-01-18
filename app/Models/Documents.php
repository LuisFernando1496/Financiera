<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id','credit_id','document_1','file_1','document_2','file_2','document_3','file_3','document_4','file_4','status'
    ];
}
