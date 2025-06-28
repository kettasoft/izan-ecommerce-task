<?php

namespace Modules\Carts\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Carts\Models\Relations\CartRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Carts\Database\Factories\CartFactory;

class Cart extends Model
{
    use HasFactory, CartRelations;

    public $table = 'cart_items';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity'
    ];

    protected static function newFactory(): CartFactory
    {
        return CartFactory::new();
    }
}
