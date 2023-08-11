<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'porsi_minum',
        'jam_tidur',
        'olahraga',
        'sinar_matahari',
        'kondisi_kulit1',
        'kondisi_kulit2',
        'kondisi_kulit3'
    ];
}
