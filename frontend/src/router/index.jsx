import { createBrowserRouter } from 'react-router-dom';
import LoginPage from '../pages/LoginPage';
import ProductsPage from '../pages/ProductsPage';
import OrderDetailsPage from '../pages/OrderDetailsPage';
import AppLayout from '../layouts/AppLayout';
import GuestLayout from '../layouts/GuestLayout';
import Auth from "./middleware/auth";
import Guest from "./middleware/guest";
import CartPage from '../pages/CartPage';

const router = createBrowserRouter([
  {
    path: '/',
    element: <Auth>
      <AppLayout />
      </Auth>,
    children: [
      { path: '/', element: <ProductsPage /> },
      { path: '/orders/:id', element: <OrderDetailsPage /> },
      { path: '/cart', element: <CartPage /> },
    ],
  },
  {
    path: '/login',
    element: <Guest><GuestLayout /></Guest>,
    children: [{ path: '', element: <LoginPage /> }],
  },
]);

export default router;
