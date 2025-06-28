<?php

namespace Modules\Products\Models;

use App\Http\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Products\Database\Factories\ProductFactory;
use Modules\Products\Models\Relations\ProductRelations;

class Product extends Model
{
    use HasFactory, Filterable, ProductRelations;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'category_id', // Assuming category_id can be nullable
    ];

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }
}
