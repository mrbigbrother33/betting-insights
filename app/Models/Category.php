<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function insights()
    {
        return $this->hasMany(\App\Models\Insight::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
