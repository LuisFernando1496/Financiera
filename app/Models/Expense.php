<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['quantity', 'description', 'price', 'branch_id', 'user_id'];

    public function edit($data)
    {
        return $this->fill($data)->save();
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function changeStatus($data)
    {
        return $this->fill(["status" => $data])->save();
    }
}
