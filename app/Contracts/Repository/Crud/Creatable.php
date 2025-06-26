<?php

namespace App\Contracts\Repository\Crud;

/**
 * Interface Creatable
 *
 * This interface defines a contract for creating resources.
 *
 * @package App\Contracts\Crud
 */
interface Creatable
{
  /**
   * Create a new resource.
   *
   * @param mixed $data
   * @return mixed
   */
  public function create(mixed $data);
}
