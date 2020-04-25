<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Product;
class Category extends Model
{
    

    protected $fillable = [
        'name','user_id','categor_id'
    ];


    public function UsersCategories()
    {
         return $this->belongsToMany(User::class,'categories_users');
    }

    public function products()
    {
         return $this->hasMany(Product::class);
    }


    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
