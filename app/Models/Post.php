<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $date = [
        'published_at'
    ];

    protected $fillable = [
        'name',
        'content',
        'description',
        'image',
        'published_at',
        'category_id',
        'user_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now());
    }

    public function scopeSearched($query)
    {
        $search = request()->query('search');

        if(!$search){
            return $query->published();
        }
        else{
            return $query->published()->where('title', 'LIKE', "%{$search}%");
        }
    }

    /**
     *unlink old image from public folder.
     */
    public function deleteImage()
    {
        $image_path = public_path("uploads/{$this->image}");

        if (isset($image_path)) {
            unlink($image_path);
        }
    }

}
