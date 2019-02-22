<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id','title','body'];

    /**
     * Get all of the image's models.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
