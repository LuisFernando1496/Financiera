<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [ 'name','street','int_number','ext_number','suburb','postal_code','city','state','country','status'];

    public function changeStatus($status)
    {
      return $this->fill(["status"=>$status])->save();
    }
    public function edit($data){
      return $this->fill($data)->save();
  }


}
