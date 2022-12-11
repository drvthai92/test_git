<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //Tình trạng đơn hàng
    const STATUS_PENDING = 'pending';
    const STATUS_SHOPPING = 'shopping';
    const STATUS_DONE = 'done';
    const STATUS_CANCEL = 'cancel';
    use HasFactory;
    protected $table = 'order';
    protected $fillable = [
        'adress',
        'country',
        'city',
        'state',
        'phone',
        'postcode',
        'note',
        'total',
        'status',
        'user_id'

    ];
    public function products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }
}
