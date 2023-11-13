<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldItem extends Model
{
    use HasFactory;
    protected $table = 'sold_items';
    public $timestamps = false;
    protected $fillable = ['sale_id', 'product_id', 'quantity'];
}
