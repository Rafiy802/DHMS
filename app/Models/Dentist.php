<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dentist extends Model
{
    use HasFactory;

    protected $primaryKey = 'dentist_id';

    protected $fillable = [
        'dentist_id',
        'user_id',
        'name',
        'ICnum',
    ];
}
