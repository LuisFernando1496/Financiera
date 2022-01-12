<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'total', 'MonthTotal', 'interesTotal', 'returnTotal', 'status','winningTotal'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function changeStatus($data)
    {
        return $this->fill(["status" => $data])->save();
    }
    public function payments(){
        return $this->hasMany(SavingPayment::class);

    }
}
