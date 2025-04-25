import React from 'react';
import { Link } from "react-router-dom";

const AboutProject = () => {
  return (
      <section className="about-section">
          <div className="container">
              <div className="about-grid">
                  <div className="about-image">
                      <img
                          src="/img/estudiantes-campo.jpg"
                          alt="Estudiantes explorando la naturaleza"
                      />
                  </div>
                  <div className="about-content">
                      <h2 className="section-title">Acerca del Proyecto</h2>
                      <p>
                          NarancoBioExplorer es una iniciativa del departamento de
                          Biología del IES Monte Naranco con los alumnos de 1º de la ESO,
                          diseñada para explorar y descubrir la flora y fauna del
                          Principado de Asturias.
                      </p>
                      <p>
                          En esta plataforma, estudiantes y profesores colaboran para
                          construir una base de conocimiento sobre la biodiversidad local,
                          fomentando el aprendizaje activo y la conciencia ambiental a
                          través de la tecnología.
                      </p>
                      <Link to="/about" className="btn">
                          Conoce más
                      </Link>
                  </div>
              </div>
          </div>
      </section>
  )
}

export default AboutProject