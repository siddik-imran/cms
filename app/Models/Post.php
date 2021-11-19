<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'content',
        'description',
        'image',
        'published_at',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
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
