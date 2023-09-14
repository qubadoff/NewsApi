<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'parent_id',
        'order',
        'title',
        'excerpt'
    ];

    protected $guarded = [];

    protected $casts = [
        'parent_id' => 'array'
    ];

    public function post(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
