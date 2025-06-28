import { useState } from "react";
import Field from '../components/Field';
import { useAuth } from '../contexts/AuthContext';
import { useNavigate } from 'react-router-dom';
import api, { getCSRFToken } from '../services/apiClient';
import { toast } from 'react-toastify';

export default function LoginPage() {
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState("");
  const navigate = useNavigate();
  const { setUser } = useAuth();

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError("");

    try {
      await getCSRFToken(); // ✅ CSRF Cookie

      const res = await api.post('/api/v1/login', {
        username,
        password,
      });

      if (res.data.success) {
        setUser(res.data.data);
        toast.success("Login successful");
        navigate('/');
      } else {
        setError("Invalid credentials");
      }

    } catch (err) {
      setError(err.response?.data?.message || err.message || "Login failed");
    }
  };

  return (
    <div className="flex justify-center items-center min-h-screen bg-gray-50">
      <div className="p-6 mx-auto mt-10 max-w-md text-center bg-white rounded-xl shadow">
        <h2 className="mb-4 text-2xl font-semibold">Welcome back</h2>
        <p className="mb-6 text-gray-600">Please enter your details to sign in</p>
        <form className="space-y-4 text-left" onSubmit={handleSubmit}>
          <Field
            label="Email"
            type="text"
            id="username"
            placeholder="you@example.com"
            required
            value={username}
            onChange={(e) => setUsername(e.target.value)}
          />
          <Field
            label="Password"
            type="password"
            id="password"
            placeholder="********"
            required
            value={password}
            onChange={(e) => setPassword(e.target.value)}
          />
          {error && <div className="text-sm text-red-600">{error}</div>}
          <button
            type="submit"
            className="py-2 w-full text-white rounded-lg transition cursor-pointer bg-zinc-900 hover:bg-zinc-900"
          >
            Sign In
          </button>
        </form>
      </div>
    </div>
  );
}
