<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarDesign extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'model', 'description'];
}
