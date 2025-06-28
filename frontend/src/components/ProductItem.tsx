import React from "react";

import Quantity from "./Quantity";
import api from "../services/apiClient";

export default function ProductItem({product}) {

    const addToCart = (quantity: number = 1) => {
        api.post('/api/v1/carts', {
            product_id: product.id,
            quantity: quantity,
        });
    };

  return (
    <>
      <div className="overflow-hidden bg-white rounded shadow">
        <img src="https://placehold.co/264x256" className="w-full" alt="" />

        <div className="p-4">
          <div className="flex gap-4 justify-between items-center mb-4">
            <div className="text-lg font-bold h-fit">{product.name}</div>
            <div className="px-2 py-1 font-light bg-gray-100 rounded-lg">Polo</div>
          </div>

          <div className="flex justify-between mb-4">
            <b>${product.price}</b>
            <div className="text-gray-500">Stock: {product.stock}</div>
          </div>

          <div className="w-24">
            <Quantity max={product.stock} onChange={addToCart}></Quantity>
          </div>

          <div className="mt-5">
            <button onClick={() => addToCart()} className="py-3 w-full text-white rounded-lg cursor-pointer bg-zinc-900">Add to cart</button>
          </div>
        </div>
      </div>
    </>
  );
}
