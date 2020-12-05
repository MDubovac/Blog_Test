<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    // Soft Delete
    use SoftDeletes;

    // User fillable fields
    protected $fillable = [
        'title', 'description', 'body', 'image', 'category_id'
    ];

    // Relationships
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // Delete image for post
    public function deleteImage(){
        Storage::delete($this->image);
    }
}
