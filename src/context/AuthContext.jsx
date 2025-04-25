import { createContext, useContext, useEffect, useState } from 'react';
import axios from 'axios';

const AuthContext = createContext();

export const useAuth = () => useContext(AuthContext);

export const AuthProvider = ({ children }) => {
    const [user, setUser] = useState(null);
    const [token, setToken] = useState(localStorage.getItem('token') || null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const verifyToken = async () => {
            if (token) {
                try {
                    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

                    try {
                        const response = await axios.get('http://localhost:8000/api/user');
                        setUser(response.data);
                    } catch (error) {
                        console.error('Error al obtener datos del usuario:', error);
                        logout();
                    }
                } catch (error) {
                    console.error('Error al verificar el token:', error);
                    logout();
                }
            }
            setLoading(false);
        };

        verifyToken();
    }, [token]);

    const login = (newToken, userData) => {
        localStorage.setItem('token', newToken);
        setToken(newToken);
        setUser(userData);

        axios.defaults.headers.common['Authorization'] = `Bearer ${newToken}`;
    };
    const logout = () => {
        localStorage.removeItem('token');
        setToken(null);
        setUser(null);

        delete axios.defaults.headers.common['Authorization'];
    };
    const value = {
        user,
        token,
        login,
        logout,
        isAuthenticated: !!user,
        isAdmin: user?.rol === 'admin',
        isProfesor: user?.rol === 'profesor',
        isAlumno: user?.rol === 'alumno',
        loading
    };

    return (
        <AuthContext.Provider value={value}>
            {children}
        </AuthContext.Provider>
    );
};