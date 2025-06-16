<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Insight extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'content',
        'published_at',
        'affiliate_url',
        'image_url',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($insight) {
            $insight->slug = Str::slug($insight->title);
        });
    }

    // Relation til kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}
