<?php

namespace Modules\Orders\Repositories;

use App\Contracts\Repository\Crud\Creatable;
use Modules\Carts\Models\Cart;
use Modules\Orders\Models\Order;

class OrderRepository implements Creatable
{
    /**
     * @inheritDoc
     */
    public function create(mixed $data)
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();

        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $cartItems->sum(fn($item) => $item->product->price * $item->quantity),
        ]);

        foreach ($cartItems as $item) {
            $order->items()->attach($item->product_id, [
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        Cart::where('user_id', auth()->id())->delete();

        return $order;
    }
}
