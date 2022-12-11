<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model

{
    use HasFactory;
    protected $table = 'categories';

    //1 category co nhieu bai viet
    public function posts()
    {
        return  $this->hasMany(Post::class, 'category_id');
    }
}
