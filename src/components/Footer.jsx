import React from "react";
import { Link } from "react-router-dom";
import "./Footer.css";

const Footer = () => {
  return (
    <footer className="footer">
      <div className="container">
        <div className="footer-content">
          <div className="footer-section about">
            <h3>NarancoBioExplorer</h3>
            <p>
              Una iniciativa del departamento de Biología del IES Monte Naranco
              que permite explorar y descubrir la rica biodiversidad del
              Principado de Asturias.
            </p>
            <div className="contact-info">
              <div className="contact-item">
                <i className="icon-location"></i>
                <span>Oviedo, Asturias</span>
              </div>
              <div className="contact-item">
                <i className="icon-email"></i>
                <span>info@narancobioexplorer.es</span>
              </div>
            </div>
          </div>

          <div className="footer-section links">
            <h3>Enlaces Rápidos</h3>
            <ul>
              <li>
                <Link to="/">Inicio</Link>
              </li>
              <li>
                <Link to="/flora">Flora</Link>
              </li>
              <li>
                <Link to="/fauna">Fauna</Link>
              </li>
              <li>
                <Link to="/about">Acerca de</Link>
              </li>
              <li>
                <Link to="/contact">Contacto</Link>
              </li>
            </ul>
          </div>

          <div className="footer-section resources">
            <h3>Recursos</h3>
            <ul>
              <li>
                <a href="#">Guía de Identificación</a>
              </li>
              <li>
                <a href="#">Mapa de Biodiversidad</a>
              </li>
              <li>
                <a href="#">Proyecto Educativo</a>
              </li>
              <li>
                <a href="#">Galería Fotográfica</a>
              </li>
            </ul>
          </div>

          <div className="footer-section subscribe">
            <h3>Newsletter</h3>
            <p>
              Suscríbete para recibir actualizaciones sobre nuevas especies y
              actividades.
            </p>
            <div className="subscribe-form">
              <input type="email" placeholder="Tu email" />
              <button type="submit">Suscribirse</button>
            </div>
          </div>
        </div>

        <div className="footer-bottom">
          <div className="social-links">
            <a href="#" className="social-icon">
              <i className="icon-facebook"></i>
            </a>
            <a href="#" className="social-icon">
              <i className="icon-twitter"></i>
            </a>
            <a href="#" className="social-icon">
              <i className="icon-instagram"></i>
            </a>
          </div>
          <p>
            &copy; {new Date().getFullYear()} NarancoBioExplorer - IES Monte
            Naranco. Todos los derechos reservados.
          </p>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
