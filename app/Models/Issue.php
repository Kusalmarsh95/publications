<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;
    protected $guarded = [ ];

    public function worker()
    {
        return $this->belongsTo(Worker::class,  'worker_id');
    }
    public function details()
    {
        return $this->hasMany(IssueDetails::class);
    }
}
