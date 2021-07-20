<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;

class Food extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'category_id',
    ];

    // creating the one-to-one relationships
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
