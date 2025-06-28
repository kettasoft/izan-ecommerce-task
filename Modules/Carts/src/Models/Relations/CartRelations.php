<?php

namespace Modules\Carts\Models\Relations;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Products\Models\Product;

/**
 * @package \Modules\Carts\Models\Cart
 */
trait CartRelations
{
  public function product(): BelongsTo
  {
    return $this->belongsTo(Product::class);
  }
}
