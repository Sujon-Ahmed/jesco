<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = [
        'title', 'category_id', 'image', 'description'
    ];

    public function relationWithCategory() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
