<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitModel extends Model
{
    use HasFactory;

    protected $table = 'visits';

    protected $fillable = ['id_client', 'status', 'fecha', 'descripcion'];

    public function clientV()
    {
        return $this->belongsTo(Client::class, 'id', 'id_client');
    }
}
