<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Food extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "food";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'nama',
        'berat',
        'kalorigram',
        'urt',
        'kaloriurt',
        'kategori',
    ];

}
