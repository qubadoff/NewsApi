<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'excerpt',
        'meta_description',
        'meta_tags',
        'body',
        'cover_image',
        'slug',
        'status',
        'is_future'
    ];

    protected $guarded = [];

    protected $casts = [];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
