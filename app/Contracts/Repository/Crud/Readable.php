<?php

namespace App\Contracts\Repository\Crud;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface Readable
 *
 * This interface defines the contract for reading resources in a CRUD application.
 *
 * @package App\Contracts\Crud
 */
interface Readable
{
  /**
   * Retrieve a resource by its ID.
   *
   * @param Model|int $id The ID of the resource to retrieve or the model instance itself.
   * @return mixed The resource if found, null otherwise.
   */
  public function read(Model|int $id);

  /**
   * Retrieve all resources.
   *
   * @return iterable An iterable collection of all resources.
   */
  public function readAll(): iterable;
}
