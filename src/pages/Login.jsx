import { useState, useEffect } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { Helmet } from 'react-helmet';
import useLogin from '../hooks/useLogin';
import { useAuth } from '../context/AuthContext';
import './Login.css';

function Login() {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const { login, loading, error } = useLogin();
    const navigate = useNavigate();
    const { isAuthenticated } = useAuth();

    useEffect(() => {
        if (isAuthenticated) {
            navigate('/');
        }
    }, [isAuthenticated, navigate]);

    const handleSubmit = async (e) => {
        e.preventDefault();
        const success = await login(email, password);
        if (success) {
            navigate('/');
        }
    };

    return (
        <div className="login-page">
            <Helmet>
                <title>Login</title>
            </Helmet>

            <div className="login-container">
                <div className="login-card">
                    <div className="login-logo">
                        <Link to="/" className="logo-text">
                            Naranco<span>Bio</span>Explorer
                        </Link>
                    </div>

                    <h2 className="login-title">Iniciar Sesión</h2>
                    <p className="login-subtitle">Accede a tu cuenta de NarancoBioExplorer</p>

                    <form onSubmit={handleSubmit} className="login-form">
                        <div className="form-group">
                            <label htmlFor="email">Correo Electrónico</label>
                            <div className="input-container">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="input-icon" viewBox="0 0 16 16">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                </svg>
                                <input
                                    type="email"
                                    id="email"
                                    value={email}
                                    onChange={(e) => setEmail(e.target.value)}
                                    placeholder="tu@email.com"
                                    required
                                    disabled={loading}
                                />
                            </div>
                        </div>

                        <div className="form-group">
                            <label htmlFor="password">Contraseña</label>
                            <div className="input-container">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="input-icon" viewBox="0 0 16 16">
                                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                                </svg>
                                <input
                                    type="password"
                                    id="password"
                                    value={password}
                                    onChange={(e) => setPassword(e.target.value)}
                                    placeholder="Tu contraseña"
                                    required
                                    disabled={loading}
                                />
                            </div>
                            <div className="forgot-password-container">
                                <Link to="/recuperar-contrasena" className="forgot-password-link">
                                    ¿Olvidaste tu contraseña?
                                </Link>
                            </div>
                        </div>

                        {error && (
                            <div className="error-message">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                                {error}
                            </div>
                        )}

                        <button type="submit" className="login-button" disabled={loading}>
                            {loading ? 'Iniciando sesión...' : 'Acceder'}
                        </button>
                    </form>

                    <div className="login-footer">
                        <p className="login-info">
                            Esta plataforma es exclusiva para estudiantes, profesores y administradores del IES Monte Naranco.
                        </p>
                        <Link to="/" className="back-to-home">
                            Volver a la página principal
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Login;