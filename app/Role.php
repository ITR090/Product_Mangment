<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Role extends Model
{
    protected $fillable = [
       'id', 'role_name', 'primissions',
    ];
    
    public function users()
    {
         return $this->belongsToMany(User::class,'roles_users','role_id','user_id');
    }
}
