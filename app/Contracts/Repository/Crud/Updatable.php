<?php

namespace App\Contracts\Repository\Crud;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface Updatable
 *
 * This interface defines the contract for updating resources in a CRUD application.
 *
 * @package App\Contracts\Crud
 */
interface Updatable
{
  /**
   * Update a resource by its ID.
   * @param Model $model The model instance to update.
   * @param int|Model $model The ID of the resource to update or the model instance itself.
   * @param mixed $data The data to update the resource with.
   * @return Model The updated model instance.
   */
  public function update(Model|int $model, mixed $data = null): Model;
}
