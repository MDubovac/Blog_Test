<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    protected $fillable = [
        'title', 'description', 'body', 'image', 'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function deleteImage(){
        Storage::delete($this->image);
    }
}
