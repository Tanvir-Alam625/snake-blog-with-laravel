<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends Model
{
    use HasFactory,SoftDeletes;
    public function RelationWithTag()
    {
        return $this->belongsToMany(Tag::class,'table_post_tags', 'post_id', 'tag_id')->withTimestamps();
    }
    public function RelationWithCategory()
    {
        return $this->belongsTo(Category::class ,'post_category', 'id');
    }
}
