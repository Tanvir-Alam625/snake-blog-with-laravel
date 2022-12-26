<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    
    public function RelationWithTag()
    {
        return $this->belongsToMany(Post::class,'table_post_tags', 'tag_id', 'post_id')->withTimestamps();
    }
}
