<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
        'is_public',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // --- Rens farlige/støjende attributter, men bevar href/src ---
    protected function content(): Attribute
    {
        return Attribute::make(
            set: fn($value) => self::cleanHtml($value)
        );
    }

    // Lille “one-liner”-agtig sanitizer uden eksterne pakker
    public static function cleanHtml(?string $html): string
    {
        $html = (string) $html;
        if ($html === '') return '';

        // Normalisér &nbsp; → mellemrum (valgfrit)
        $html = str_replace('&nbsp;', ' ', $html);

        // Fjern data-*, on*, class, style — bevar fx href/src/alt/width/height
        $patterns = [
            '/\s(?:data-[\w:-]+|on\w+|class|style)\s*=\s*"[^"]*"/i',
            "/\s(?:data-[\w:-]+|on\w+|class|style)\s*=\s*'[^']*'/i",
            '/\s(?:data-[\w:-]+|on\w+|class|style)\s*=\s*[^\s>]+/i',
        ];
        $html = preg_replace($patterns, '', $html);

        // Fjern helt tomme <p>’er
        $html = preg_replace('#<p>(\s|&nbsp;)*</p>#i', '', $html);

        return $html;
    }

    // Slug-setup som før (evt. gør den unik om du vil)
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($insight) {
            $insight->slug = Str::slug($insight->title);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function isLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
