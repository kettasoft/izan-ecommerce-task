import { Navigate } from 'react-router-dom';
import { useAuth } from '../../contexts/AuthContext';

export default function Guest({ children }) {
  const { user, checked } = useAuth();

  if (checked != null && user != null) return <Navigate to="/" replace />;

  return children;
}
