<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAssign extends Model
{
    use HasFactory;
    protected $guarded = [ ];

    public function order()
    {
        return $this->belongsTo(Order::class,  'id', 'order_id');
    }
}
