<?php

namespace Modules\Products\Repositories;

use App\Contracts\Repository\Repository;
use Illuminate\Database\Eloquent\Model;
use Modules\Products\Models\Product;
use Modules\Products\Http\Filters\ProductFilter;

class ProductRepository implements Repository
{
    /**
     * ArticleRepository constructor.
     * @param ProductFilter $filter
     */
    public function __construct(protected ProductFilter $filter) {}

    /**
     * @inheritDoc
     */
    public function create(mixed $data)
    {
        $product = Product::create($data);
        return $product;
    }

    /**
     * @inheritDoc
     */
    public function read(Model|int $model)
    {
        if (is_int($model)) {
            $product = Product::find($model);
            if (!$product) {
                throw new \Exception("Product not found with ID: {$model}");
            }
            return $product;
        }

        if ($model instanceof Model) {
            return $model; // Assuming the model is already an instance of Product
        }

        throw new \InvalidArgumentException('Invalid model type provided.');
    }

    /**
     * @inheritDoc
     */
    public function readAll(): iterable
    {
        // Implementation for reading all products
        return Product::filter($this->filter)->paginate(); // Returns an iterable collection of all products
    }

    /**
     * @inheritDoc
     */
    public function update(Model|int $model, mixed $data = null): Model
    {
        if (is_int($model)) {
            $product = Product::findOrFail($model);
            if (!$product) {
                throw new \Exception("Product not found with ID: {$model}");
            }
        } elseif ($model instanceof Model) {
            $product = $model; // Assuming the model is already an instance of Product
        } else {
            throw new \InvalidArgumentException('Invalid model type provided.');
        }

        // Update the product with the provided data
        $product->update($data);
        return $product;
    }

    /**
     * @inheritDoc
     */
    public function delete(Model|int $id): bool
    {
        if (is_int($id)) {
            $product = Product::findOrFail($id);
            if (!$product) {
                throw new \Exception("Product not found with ID: {$id}");
            }
        } elseif ($id instanceof Model) {
            $product = $id; // Assuming the model is already an instance of Product
        } else {
            throw new \InvalidArgumentException('Invalid model type provided.');
        }

        return $product->delete();
    }
}
