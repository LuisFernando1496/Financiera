<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Client extends Model
{
    use HasFactory;

    protected $fillable = [ 'id','name','last_name','email','rfc','curp','phone','cellphone','genre','int_number','ext_number','suburb','street','postal_code','city','state','country','status','user_id','branch_id','status_credit','visit_status', 'imgClient'];

    public function insurance(){
        return $this->belongsTo(Insurance::class,'id','client_id');
    }

    public function changeStatus($data){
        return $this->fill(["status"=>$data])->save();
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function accepted_credits(){
        return $this->hasMany(Credit::class)->where('status',1);
    }


    public function rejected_credits(){
        return $this->hasMany(Credit::class)->where('status',0);
    }



}
