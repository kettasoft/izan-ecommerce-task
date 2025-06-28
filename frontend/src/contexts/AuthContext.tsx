import { createContext, useContext, useEffect, useState } from 'react';
import api, { getCSRFToken } from '../services/apiClient';

const AuthContext = createContext();

export function AuthProvider({ children }) {
  const [user, setUser] = useState(null);
  const [checked, setChecked] = useState(false);

  const fetchUser = async () => {
    try {
      await getCSRFToken();
      const { data } = await api.get('api/profile');
      setUser(data);
    } catch {
      setUser(null);
    } finally {
      setChecked(true);
    }
  };

  useEffect(() => {
    fetchUser();
  }, []);

  return (
    <AuthContext.Provider value={{ user, setUser, checked }}>
      {children}
    </AuthContext.Provider>
  );
}

export function useAuth() {
  return useContext(AuthContext);
}
