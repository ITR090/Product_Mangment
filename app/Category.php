<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Product;
class Category extends Model
{
    

    protected $fillable = [
        'name',
    ];


    public function UsersWork()
    {
         return $this->belongsToMany(User::class,'categories_users');
    }

    public function products()
    {
         return $this->hasMany(Product::class);
    }
}
