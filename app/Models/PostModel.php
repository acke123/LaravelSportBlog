<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title','description','post_image','category_id','user_id'];

    public function tags()
    {
        return $this->hasMany(TagModel::class,'post_id','id');
    }

    public function likes()
    {
        return $this->hasMany(LikeModel::class,'post_id','id');
    }

    public function comments()
    {
        return $this->hasMany(CommentModel::class,'post_id','id');
    }
}
