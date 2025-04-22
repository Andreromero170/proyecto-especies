import { useState } from 'react';
import axios from 'axios';
import { useAuth } from '../context/AuthContext';

const useLogin = () => {
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);
    const { login: authLogin } = useAuth();

    const login = async (email, password) => {
        setLoading(true);
        setError(null);

        try {
            const response = await axios.post('https://juditlg25.iesmontenaranco.com:8000/api/login', {
                email,
                password
            });

            if (response.data && response.data.access_token) {
                authLogin(response.data.access_token, response.data.user);
                setLoading(false);
                return true;
            } else {
                throw new Error('Respuesta inválida del servidor');
            }
        } catch (err) {
            if (err.response) {
                if (err.response.status === 401) {
                    setError('Credenciales incorrectas. Por favor, verifica tu email y contraseña.');
                } else if (err.response.data && err.response.data.message) {
                    setError(err.response.data.message);
                } else {
                    setError('Error al intentar iniciar sesión. Por favor, inténtalo de nuevo.');
                }
            } else if (err.request) {
                setError('No se pudo conectar con el servidor. Verifica tu conexión a internet.');
            } else {
                setError('Error al procesar tu solicitud. Por favor, inténtalo de nuevo.');
            }

            setLoading(false);
            return false;
        }
    };

    return { login, loading, error };
};

export default useLogin;