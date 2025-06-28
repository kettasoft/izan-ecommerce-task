<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

/**
 * @method static Builder|$this filter(BaseFilters $filters = null)
 */
trait Filterable
{
    /**
     * Apply all relevant thread filters.
     *
     * @param Builder $query
     * @param BaseFilters|null $filters
     * @return Builder
     */
    public function scopeFilter($query, BaseFilters|null $filters = null)
    {
        if (!$filters) {
            $filters = App::make($this->filter);
        }

        return $filters->apply($query);
    }

    /**
     * Get the number of models to return per page.
     *
     * @return int
     */
    public function getPerPage()
    {
        return request('perPage', parent::getPerPage());
    }
}
