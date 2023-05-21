<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carmodel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'production_started', 'min_price'];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
}
