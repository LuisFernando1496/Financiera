<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingPayment extends Model
{
    use HasFactory;
    protected $fillable = ['saving_id','fecha','monto','cambio','efectivo','resta','status','folio','concepto'];

    public function savings(){
        return $this->belongsTo(Saving::class);
    }
}
