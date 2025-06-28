import { Navigate } from 'react-router-dom';
import { useAuth } from '../../contexts/AuthContext';

export default function Auth({ children }) {
  const { user, checked } = useAuth();

  if (!checked) return <div>Loading...</div>;

  if (!user || !checked) return <Navigate to="/login" replace />;

  return children;
}
