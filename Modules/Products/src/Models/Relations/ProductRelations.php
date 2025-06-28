<?php

namespace Modules\Products\Models\Relations;

use Modules\Orders\Models\Order;
use Modules\Categories\Models\Category;

trait ProductRelations
{
    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot(['quantity', 'price'])
            ->withTimestamps()->as('order');
    }
}
