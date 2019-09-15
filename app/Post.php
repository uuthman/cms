<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['title','content','description','published_at','image','category_id'];

    /**
     * Delete post image from storage
     *
     * @return void
     */
    public function deleteImage(){
        Storage::delete($this->image);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function hasTags($tagId){
        return in_array($tagId,$this->tags->pluck('id')->toArray());
    }
}
