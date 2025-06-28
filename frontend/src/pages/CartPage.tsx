import { useEffect, useState } from 'react';
import TrashIcon from '../assets/icons/trash.png';
import api from '../services/apiClient';
import type { AxiosError, AxiosResponse } from 'axios';
import { toast } from 'react-toastify';
import Quantity from '../components/Quantity';
import { useNavigate } from 'react-router-dom';

// CartItem.jsx
const CartItem = ({ name, price, stock, quantity, id, cartId }: CartItem) => {
    const handleQuantityChange = (id: number, quantity: number) => {
        api.post(`/api/v1/carts`, {
            product_id: id,
            quantity: quantity,
        });
    };

    const handleRemove = (id: number) => {
        api.delete(`/api/v1/carts/${id}`);
    };

    return (
      <div className="flex overflow-hidden bg-white rounded-lg border border-gray-200 shadow">
        <img src="https://placehold.co/192x217" className="" alt="" />
        <div className="flex flex-col justify-between p-4 w-full">
            <div className='flex justify-between'>
                <div className="flex gap-6 items-center">
                    <h3 className="text-lg font-semibold">{name}</h3>
                    <div className="px-2 py-1 font-light bg-gray-100 rounded-lg">Polo</div>
                </div>

                <img src={TrashIcon} onClick={() => handleRemove(cartId)} width={'20px'} height={'20px'} alt="" />
            </div>
            <div className="flex justify-between items-start mt-2">
            <div>
                <p className="font-bold">${price}</p>
                <p className="text-sm text-gray-500">Stock: {stock}</p>
            </div>
            </div>
            <div className='w-44'>
                <Quantity max={stock} value={quantity} onChange={(quantity) => handleQuantityChange(id, quantity)} />
            </div>
        </div>
      </div>
    );
  };

  interface OrderSummaryProps {
    orderNumber: string;
    date: string;
    shipping: string;
    tax: string;
    cartItems: CartItem[];
  }

  // OrderSummary.jsx
  const OrderSummary = ({ orderNumber, date, shipping, tax, cartItems }: OrderSummaryProps) => {
    const subtotal = cartItems.reduce((sum, item) => sum + item.product.price * item.quantity, 0);
    return (
      <>
        <div className="mb-6 border-b border-gray-200">
            <h2 className="text-xl font-semibold">Order Summary ( #{orderNumber} )</h2>
            {/* <p className="mt-2 font-bold">{date}</p> */}

            <div className="mt-4 space-y-2">
            <div className="flex justify-between">
                <span>Subtotal</span>
                <span>${subtotal.toFixed(2)}</span>
            </div>
            <div className="flex justify-between">
                <span>Shipping</span>
                <span>${shipping}</span>
            </div>
            <div className="flex justify-between mb-6">
                <span>Tax</span>
                <span>${tax}</span>
            </div>
            </div>
        </div>

        <div className="flex justify-between text-xl font-bold">
            <div>Total:</div>
            <div>${(subtotal + parseInt(shipping) + parseInt(tax)).toFixed(2)}</div>
        </div>
      </>
    );
  };

  // CartPage.jsx
  const CartPage = () => {
    interface CartItem {
        id: number;
        product: {
            id: number;
            name: string;
            price: number;
            stock: number;
        };
        quantity: number;
    }
    const [cartItems, setCartItems] = useState<CartItem[]>([]);
    const navigate = useNavigate();

    const createOrder = () => {
        api.post('/api/v1/orders', {
            items: cartItems.map((item) => ({
                product_id: item.product.id,
                quantity: item.quantity,
            })),
        })
          .then((res: AxiosResponse) => {
            toast.success("Order created successfully");
            navigate('/');
          })
          .catch((err: AxiosError) => {
            toast.error("Failed to create order");
          })
      };

    useEffect(() => {
        api.get('/api/v1/carts')
          .then((res: AxiosResponse) => {
            if (!res.data.data.length) {
                toast.error("No cart items found");
                return navigate('/');
            }
            setCartItems(res.data.data);
          })
          .catch((err: AxiosError) => {
            toast.error("Failed to get cart items");
          })
      }, []);

    return (
      <div className="p-6">
        <h1 className="mb-6 text-2xl font-bold">Your cart</h1>

        <div className="flex gap-4 justify-between items-start">
            <div className="lg:flex-2/3">
                <div className="px-6 py-4 space-y-6 bg-white rounded-2xl border border-gray-200">
                {cartItems.map((item: CartItem) => (
                <CartItem
                key={item.product.id}
                name={item.product.name}
                price={item.product.price}
                stock={item.product.stock}
                quantity={item.quantity}
                id={item.product.id}
                cartId={item.id}
                />
            ))}
                </div>
            </div>

            <div className="px-4 py-6 bg-white rounded-2xl border border-gray-200 lg:flex-1/3">
                <OrderSummary
                orderNumber="123"
                date="5 May 2025"
                shipping="15.00"
                tax="12.50"
                cartItems={cartItems}
                />

                <div className="pt-4 mt-6 border-t border-gray-200">
                <button className="px-4 py-3 w-full font-semibold text-white bg-black rounded transition hover:bg-gray-800" onClick={() => createOrder()}>
                    Place the order
                </button>
                </div>
            </div>
        </div>
      </div>
    );
  };

  export default CartPage;
