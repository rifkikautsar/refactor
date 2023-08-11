<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diseases extends Model
{
    use HasFactory;

    // attributes allow to assigned
    protected $fillable = [
        'nama',
        'image',
        'rekomendasi',
        'larangan',
        'created_at',
        'updated_at'
    ];
}
