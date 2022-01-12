<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['credit_id','tipo','fecha','moratorios','fecha_limite','monto','cambio','efectivo','resta','status','folio','concepto'];

    public function credit(){
        return $this->belongsTo(Credit::class);
    }
    
}
