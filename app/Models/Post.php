<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'content', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

  


    public function isLikedBy($userId)
    {
        foreach ($this->likes as $like) {
            if ($like->user_id == $userId) {
                return true;
            }
        }
        return false;
    }

   
    



   
 public function countLikes()
    {
        
    
    $count = 0;
        foreach ($this->likes as $like) {
            $count++;
        }
        return $count;
    }
}