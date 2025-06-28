<?php

namespace Modules\Orders\Models\Relations;

use Modules\Orders\Models\Order;
use Modules\Products\Models\Product;

/**
 * @package Order
 */
trait OrderRelations
{
    public function items()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')->withPivot('quantity', 'price')->withTimestamps()->as('item');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')->withPivot('quantity', 'price')->withTimestamps();
    }
}
