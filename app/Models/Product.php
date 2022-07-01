<?php

namespace App\Models;

use GuzzleHttp\Handler\Proxy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded = [];
    public function relation_to_category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function rel_to_thumbnail()
    {
        return $this->hasMany(ProductThumbnail::class, 'product_id');
    }
}