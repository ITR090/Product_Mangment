<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Category;
use App\Comment;
use App\User;
class Product extends Model
{
    
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'imege',
        'priec',
        'user_id',
        'category_id',
        
    ];

    public function category()
    {
         return $this->belongsTo(Category::class);
    }

    public function comments()
    {
         return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
