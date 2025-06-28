<?php

namespace Modules\Products\Http\Filters;

use App\Http\Filters\BaseFilters;

class ProductFilter extends BaseFilters
{
    protected $filters = [
        'name',
        'categories',
        'price'
    ];

    public function name($value)
    {
        return $this->builder->where('name', 'like', "%{$value}%");
    }

    public function categories($value)
    {
        return $this->builder->whereHas('category', function ($query) use ($value) {
            $query->whereIn('id', $value);
        });
    }

    public function price($value)
    {
        return $this->builder->whereBetween('price', $value);
    }
}
