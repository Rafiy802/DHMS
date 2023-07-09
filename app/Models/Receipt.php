<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class)->withPivot('quantity', 'price');
    }

    public function treatments()
    {
        return $this->belongsToMany(Treatment::class)->withPivot('price');
    }
}
