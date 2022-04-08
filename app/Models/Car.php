<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    public $brand;
    public $model;
    public $engine;
    public $engine_capacity;
    public $year;
    public $mileage;
    public $offer;
    public $weekoffer;
    public $href;
    public $price;
    public $imagePath;
    public $created_at;
    public $updated_at;
}
