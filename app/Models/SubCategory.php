<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
    //  relationship with category for parent category name show into sub category table
    public function RelationWithCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }
}
