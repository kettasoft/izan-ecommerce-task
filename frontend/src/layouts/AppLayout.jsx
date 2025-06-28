import { Outlet, Link, useNavigate } from 'react-router-dom';
import { useEffect } from 'react';
import api, {getCSRFToken} from '../services/apiClient';
import Logo from "../assets/logo.png";
import CartIcon from '../assets/icons/cart.png';
import { useAuth } from '../contexts/AuthContext';
import { toast } from 'react-toastify';

export default function AppLayout() {
  const navigate = useNavigate();
  const { setUser, setChecked } = useAuth();

  const handleLogout = async () => {
    try {
      await getCSRFToken();
      await api.post('api/v1/logout').then(() => {
        setUser(null);
        setChecked(false);
        toast.success('Logged out successfully');
        navigate('/login');
      });
    } catch (error) {
      console.error('Logout failed', error);
    }
  };

  useEffect(() => {
    //
  }, []);

  return (
        <div className="min-h-screen text-gray-800 bg-gray-100">
        <nav className="flex justify-between items-center p-4 bg-white shadow">
            <div className='flex items-center'>
            <img src={Logo} className='me-4' alt="Logo" />
            <h1 className="">
                <Link to="/">Products</Link>
            </h1>
            </div>
            <div className="flex items-center space-x-4">
            <Link to="/cart" className="cursor-pointer hover:underline">
                <img src={CartIcon} alt="Cart" />
            </Link>
            <button
                onClick={handleLogout}
                className="px-3 py-1 text-white rounded bg-zinc-900 hover:bg-zinc-950"
            >
                Logout
            </button>
            </div>
        </nav>

        <main className="container p-6 m-auto">
            <Outlet />
        </main>
        </div>
  );
}
