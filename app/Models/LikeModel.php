<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeModel extends Model
{
    protected $table = 'likes';
    protected $fillable = ['user_id', 'post_id'];

    public function post()
    {
        return $this->belongsTo(PostModel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeGetLikedPosts($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }
}
