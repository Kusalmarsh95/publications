<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueDetails extends Model
{
    use HasFactory;
    protected $guarded = [ ];

    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
