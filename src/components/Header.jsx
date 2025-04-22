import React, { useState, useEffect } from "react";
import { Link, useLocation, useNavigate } from "react-router-dom";
import { useAuth } from "../context/AuthContext";
import "./Header.css";

const Header = () => {
  const [isScrolled, setIsScrolled] = useState(false);
  const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);
  const [isUserMenuOpen, setIsUserMenuOpen] = useState(false);
  const { user, logout } = useAuth();
  const navigate = useNavigate();
  const location = useLocation();

  useEffect(() => {
    const handleScroll = () => {
      if (window.scrollY > 50) {
        setIsScrolled(true);
      } else {
        setIsScrolled(false);
      }
    };

    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  const toggleMobileMenu = () => {
    setIsMobileMenuOpen(!isMobileMenuOpen);
  };
  const toggleUserMenu = () => {
    setIsUserMenuOpen(!isUserMenuOpen);
  };
  const handleLogout = () => {
    logout();
    setIsUserMenuOpen(false);
    navigate('/');
  };
  const isActive = (path) => {
    return location.pathname === path;
  };

  return (
    <header className={`header ${isScrolled ? "scrolled" : ""}`}>
      <div className="container header-container">
        <div className="logo">
          <Link to="/">
            <span className="logo-text">
              Naranco<span>Bio</span>Explorer
            </span>
          </Link>
        </div>

        <div className="mobile-menu-toggle" onClick={toggleMobileMenu}>
          <span></span>
          <span></span>
          <span></span>
        </div>

        <nav className={`main-nav ${isMobileMenuOpen ? "mobile-open" : ""}`}>
          <ul>
            <li>
              <Link to="/" className={isActive("/") ? "active" : ""}>
                Inicio
              </Link>
            </li>
            <li>
              <Link to="/flora" className={isActive("/flora") ? "active" : ""}>
                Flora
              </Link>
            </li>
            <li>
              <Link to="/fauna" className={isActive("/fauna") ? "active" : ""}>
                Fauna
              </Link>
            </li>
            <li>
              <Link to="/about" className={isActive("/about") ? "active" : ""}>
                Acerca de
              </Link>
            </li>
          </ul>

          <div className="nav-actions">
            {user ? (
              <div className="user-menu-container">
                <button className="user-menu-button" onClick={toggleUserMenu}>
                  <div className="user-avatar">
                    {user.nombre ? user.nombre.charAt(0).toUpperCase() : "U"}
                  </div>
                  <span className="user-name">{user.nombre}</span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" className={`user-menu-arrow ${isUserMenuOpen ? 'open' : ''}`}>
                    <path fillRule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                  </svg>
                </button>

                {isUserMenuOpen && (
                  <div className="user-dropdown">
                    <div className="user-info">
                      <p className="user-full-name">{`${user.nombre} ${user.apellidos || ''}`}</p>
                      <p className="user-role">
                        {user.rol === 'admin'
                          ? 'Administrador'
                          : user.rol === 'profesor'
                            ? 'Profesor'
                            : 'Estudiante'}
                      </p>
                    </div>

                    <div className="user-menu-links">
                      <Link to="/perfil" className="user-menu-link" onClick={() => setIsUserMenuOpen(false)}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                          <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                        </svg>
                        Mi Perfil
                      </Link>

                      {user.rol === 'admin' && (
                        <Link to="/admin" className="user-menu-link" onClick={() => setIsUserMenuOpen(false)}>
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                          </svg>
                          Panel de Admin
                        </Link>
                      )}

                      {user.rol === 'profesor' && (
                        <Link to="/revisiones" className="user-menu-link" onClick={() => setIsUserMenuOpen(false)}>
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                          </svg>
                          Revisiones
                        </Link>
                      )}

                      {user.rol === 'alumno' && (
                        <Link to="/mis-publicaciones" className="user-menu-link" onClick={() => setIsUserMenuOpen(false)}>
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
                          </svg>
                          Mis Publicaciones
                        </Link>
                      )}
                      {user.rol === 'alumno' && (
                        <Link to="/nueva-especie" className="user-menu-link" onClick={() => setIsUserMenuOpen(false)}>
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 15.983a7.5 7.5 0 0 0 2.501-14.032l-1.499 4.508-1.499-4.508A7.5 7.5 0 0 0 8 15.983zM8.5 2.421L10.5 7h-4l2-4.579z" />
                          </svg>
                          Añadir Nueva Especie
                        </Link>
                      )}
                    </div>

                    <div className="user-menu-actions">
                      <hr className="menu-divider" />
                      <button onClick={handleLogout} className="logout-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                          <path fillRule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                          <path fillRule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                        </svg>
                        Cerrar Sesión
                      </button>
                    </div>
                  </div>
                )}
              </div>
            ) : (
              <Link to="/login" className="login-btn">
                Login in
              </Link>
            )}
          </div>
        </nav>
      </div>
    </header>
  );
};

export default Header;