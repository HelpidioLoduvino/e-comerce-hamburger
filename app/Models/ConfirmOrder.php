<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfirmOrder extends Model
{
    use HasFactory;
    protected $table = 'confirm_orders';
    public $timestamps = false;
    protected $fillable = ['user_id', 'total', 'status', 'payment_method'];
}
