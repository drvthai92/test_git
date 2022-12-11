<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';

    protected $fillable = [
        'name',
        'content',
        'image',
        'category_id'
    ];




    //1 bai viet thuoc 1 category
    public function category()
    {
        return $this->belongsTo(category::class, 'category_id');
    }
}
