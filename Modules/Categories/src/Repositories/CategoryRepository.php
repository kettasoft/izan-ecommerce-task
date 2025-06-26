<?php

namespace Modules\Categories\Repositories;

use Illuminate\Database\Eloquent\Model;
use Modules\Categories\Models\Category;
use App\Contracts\Repository\Repository;

class CategoryRepository implements Repository
{
    /**
     * @inheritDoc
     */
    public function create(mixed $data)
    {
        $category = Category::create($data);

        return $category;
    }

    /**
     * @inheritDoc
     */
    public function read(Model|int $model)
    {
        if ($model instanceof Model) {
            return $model; // Assuming the model is already an instance of Category
        }

        if (is_int($model)) {
            return Category::find($model); // Fetching the category by ID
        }

        throw new \InvalidArgumentException('Invalid model type provided.');
    }

    /**
     * @inheritDoc
     */
    public function readAll(): iterable
    {
        // Implementation for reading all categories
        return Category::paginate(); // Assuming we want to return all categories
    }

    /**
     * @inheritDoc
     */
    public function update(Model|int $model, mixed $data = null): Model
    {
        if ($model instanceof Model) {
            $category = $model; // Assuming the model is already an instance of Category
        } elseif (is_int($model)) {
            $category = Category::findOrFail($model); // Fetching the category by ID
        } else {
            throw new \InvalidArgumentException('Invalid model type provided.');
        }

        $category->update($data);

        return $category;
    }

    /**
     * @inheritDoc
     */
    public function delete(Model|int $id): bool
    {
        if ($id instanceof Model) {
            return $id->delete(); // Assuming the model is already an instance of Category
        }

        if (is_int($id)) {
            $category = Category::find($id);
            if ($category) {
                return $category->delete(); // Deleting the category by ID
            }
            return false; // If no category found, return false
        }

        throw new \InvalidArgumentException('Invalid model type provided.');
    }
}
