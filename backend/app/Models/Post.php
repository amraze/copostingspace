<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
    ];

    protected $casts = [
        'body' => 'array'
    ];

    public function getTitleUppercaseAttribute()
    {
        return strtoupper($this->title);
    }

    public function setTitleLowercaseAttribute($title)
    {
        $this->attributes['title'] = strtolower($title);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'post_user', 'post_id', 'user_id');
    }
}
