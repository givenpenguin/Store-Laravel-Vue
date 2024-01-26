<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = false;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'size_product', 'product_id', 'size_id');
    }

    public function getImageUrlAttribute()
    {
        return url('storage/' . $this->preview_image);
    }
}
