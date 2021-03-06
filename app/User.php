<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Role;
use App\Category;
use App\Product;
class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
         return $this->belongsToMany(Role::class,'roles_users','user_id','role_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function OwnerCategories()
    {
        return $this->hasMany(Category::class);
    }

    public function categoriesWork()
    {
         return $this->belongsToMany(Category::class,'categories_users');
    }
}
