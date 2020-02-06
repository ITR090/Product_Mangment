<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class Comment extends Model
{
    protected $fillable = [
        'content',
        'user_id',
        'product_id',
        
    ];
    public function product()
    {
         return $this->belongsTo(Product::class);
    }
}
