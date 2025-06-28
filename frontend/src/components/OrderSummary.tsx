import { useEffect, useState } from 'react';
import TrashIcon from '../assets/icons/trash.png';
import api from '../services/apiClient';
import Quantity from './Quantity';
import type { AxiosError, AxiosResponse } from 'axios';
import { toast } from 'react-toastify';
import { useNavigate } from 'react-router-dom';

export default function OrderSummary() {
  const navigate = useNavigate();
  const shipping = 15.0;
  const tax = 12.5;


  const [cartItems, setCartItems] = useState([]);

  const subtotal = cartItems.reduce((sum, item) => sum + item.product.price * item.quantity, 0);
  const total = subtotal + shipping + tax;

  useEffect(() => {
    getCartItems()
  }, []);

  /**
   * Handle remove item from cart
   */
  const handleRemove = (id: number) => {
    api.delete(`/api/v1/carts/${id}`);

    getCartItems()
  };

  const handleCheckout = () => {
    navigate('/cart');
  };

  const handleQuantityChange = (id: number, quantity: number) => {
    api.post(`/api/v1/carts`, {
        product_id: id,
        quantity: quantity,
    });

    getCartItems()
  };

  /**
   * Get cart items
   */
  const getCartItems = () => {
    api.get('/api/v1/carts')
      .then((res: AxiosResponse) => {
        setCartItems(res.data.data);
      })
      .catch((err: AxiosError) => {
        toast.error("Failed to get cart items");
      })
  };

  return (
    <div className="p-6 w-full max-w-sm bg-white rounded-lg shadow-md">
      <h2 className="mb-4 text-lg font-bold">Order Summary</h2>

      {/* Cart Items */}
      <div className="space-y-4">
        {cartItems.map((item) => (
          <div key={item.id} className="flex gap-4 justify-between items-start">
            <img src={item.product.image} alt={item.product.name} className="object-cover w-16 h-16 rounded" />

            <div className="flex-1">
              <h3 className="font-medium">{item.product.name}</h3>

              {/* Quantity Controls */}
              <div className="flex items-center mt-2 space-x-2 rounded border w-fit">
                <Quantity max={item.product.stock} value={item.quantity} onChange={(quantity) => handleQuantityChange(item.product.id, quantity)}></Quantity>
              </div>
            </div>

            {/* Price & Delete */}
            <div className="flex flex-col items-end text-right">
              <span className="text-sm font-medium text-gray-800">${item.product.price}</span>
              <button
                onClick={() => handleRemove(item.id)}
                className="mt-2 text-sm text-red-500"
              >
                <img src={TrashIcon} alt="Remove" />
              </button>
            </div>
          </div>
        ))}
      </div>

      {/* Summary */}
      <div className="mt-6 space-y-2 text-sm text-gray-700">
        <div className="flex justify-between">
          <span>Subtotal</span>
          <span>${subtotal.toFixed(2)}</span>
        </div>
        <div className="flex justify-between">
          <span>Shipping</span>
          <span>${shipping.toFixed(2)}</span>
        </div>
        <div className="flex justify-between">
          <span>Tax</span>
          <span>${tax.toFixed(2)}</span>
        </div>
        <div className="flex justify-between pt-2 text-base font-semibold text-black border-t">
          <span>Total</span>
          <span>${total.toFixed(2)}</span>
        </div>
      </div>

      {/* Checkout Button */}
      <button
        onClick={() => handleCheckout()}
        className="py-2 mt-5 w-full text-white bg-black rounded hover:bg-gray-900"
      >
        Proceed to Checkout
      </button>
    </div>
  );
}
