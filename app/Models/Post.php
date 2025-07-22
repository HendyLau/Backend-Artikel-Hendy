<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
     use HasFactory;
  protected $casts = [
    'published_at' => 'datetime',
];
    protected $fillable = [
        'title', 'slug', 'short_description', 'content', 'image', 'status', 'published_at','locale'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}

