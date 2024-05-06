<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $guarded = [ ];

    public function services()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
