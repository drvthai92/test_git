<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ProductCategory extends Model
{
    use HasFactory, Sluggable;
    protected $table = 'product_categories';

    protected $fillable = [
        'name',
        'slug'

    ];
    public function getProducts()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
