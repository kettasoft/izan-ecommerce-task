<?php

namespace App\Contracts\Repository\Crud;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface Deletable
 *
 * This interface defines the contract for deleting resources in a CRUD application.
 *
 * @package App\Contracts\Crud
 */
interface Deletable
{
  /**
   * Delete a resource by its ID.
   *
   * @param Model $model The model instance to delete from.
   * @return bool True if the deletion was successful, false otherwise.
   */
  public function delete(Model|int $model): bool;
}
