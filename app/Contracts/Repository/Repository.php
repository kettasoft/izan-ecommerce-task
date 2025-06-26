<?php

namespace App\Contracts\Repository;

use App\Contracts\Repository\Crud\Creatable;
use App\Contracts\Repository\Crud\Deletable;
use App\Contracts\Repository\Crud\Readable;
use App\Contracts\Repository\Crud\Updatable;

/**
 * Interface Repository
 * 
 * This interface defines the contract for a repository in a CRUD application.
 * It extends the basic CRUD operations: create, read, update, and delete.
 * * Implementing classes should provide concrete implementations for these methods.
 * * The repository pattern is used to abstract data access and provide a clean API for interacting with data sources.
 *
 * * @method mixed create(mixed $data) Create a new resource with the provided data.
 * * @method mixed read(int|Model $id) Retrieve a resource by its ID or model instance.
 * * @method iterable readAll() Retrieve all resources.
 * * @method Model update(int|Model $model, mixed $data = null) Update a resource by its ID or model instance, optionally with new data.
 * * @method bool delete(int|Model $id) Delete a resource by its ID or model instance.
 * 
 * * @see Creatable
 * * @see Readable
 * * @see Updatable
 * * @see Deletable
 * @author Abdalrhman Emad Saad <kettasoft@gmail.com>
 * @package App\Contracts
 */
interface Repository extends Creatable, Readable, Updatable, Deletable {}
