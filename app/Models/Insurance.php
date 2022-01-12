<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;

    protected $fillable = ['client_id','insurance_type','beneficiario','interes','contado','monthTotal','credit','cost','status'];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function changeStatus($data)
    {
        return $this->fill(["status" => $data])->save();
    }
}
