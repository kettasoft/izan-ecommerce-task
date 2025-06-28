<?php

namespace Modules\Orders\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Orders\Models\Relations\OrderRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Orders\Database\Factories\OrderFactory;

class Order extends Model
{
    use HasFactory, OrderRelations;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'total',
        'status',
    ];

    // protected static function newFactory(): OrderFactory
    // {
    //     // return OrderFactory::new();
    // }
}
