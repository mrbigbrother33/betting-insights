<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id',
        'insight_id',
    ];

    public function insight()
    {
        return $this->belongsTo(Insight::class);
    }
}
