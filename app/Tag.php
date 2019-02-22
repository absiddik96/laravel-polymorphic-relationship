<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    /**
     * Get all of the posts that are assigned this model.
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    /**
     * Get all of the videos that are assigned this model.
     */
    public function videos()
    {
        return $this->morphedByMany(Video::class, 'taggable');
    }
}
