<?php

namespace Modules\Carts\Repositories;

use App\Contracts\Repository\Crud\Creatable;
use App\Contracts\Repository\Crud\Deletable;
use App\Contracts\Repository\Crud\Updatable;
use Modules\Carts\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Repository\Repository;

class CartRepository implements Creatable, Deletable
{
    /**
     * @inheritDoc
     */
    public function create(mixed $data)
    {
        $item = Cart::where('user_id', auth()->id())
            ->where('product_id', $data['product_id'])
            ->first();

        if ($item) {
            $item->quantity = $data['quantity'];
            $item->save();
        } else {
            $item = Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
            ]);
        }

        return $item;
    }

    /**
     * @inheritDoc
     */
    public function readAll(): iterable
    {
        return Cart::with('product')->where('user_id', auth()->id())->get();
    }

    /**
     * @inheritDoc
     */
    public function delete(Model|int $id): bool
    {
        return Cart::where('user_id', auth()->id())->where('id', $id)->delete();
    }
}
