<?php

namespace Modules\Categories\Models\Relations;

trait CategoryRelations
{
  /**
   * Get the categories that belong to this category.
   */
  public function categories()
  {
    return $this->hasMany(self::class, 'parent_id');
  }

  /**
   * Get the parent category of this category.
   */
  public function parent()
  {
    return $this->belongsTo(self::class, 'parent_id');
  }
}
