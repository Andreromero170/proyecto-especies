import React from 'react';
import { Link } from "react-router-dom";

const BannerSearch = ({setSearchSpecies}) => {
  return (
    <section className="hero">
      <div className="hero-overlay"></div>
      <div className="container hero-content">
        <h1>Descubre la biodiversidad de Asturias</h1>
        <p>
          Explora la flora y fauna del Principado a través de nuestro catálogo
          digital creado por estudiantes
        </p>
        <div className="hero-search">
          <input
            type="text"
            placeholder="Buscar especies por nombre..."
            className="search-input" onChange={(e) => setSearchSpecies(e.target.value)}
          />
          <button className="search-button">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="18"
              height="18"
              fill="currentColor"
              viewBox="0 0 16 16"
            >
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
          </button>
        </div>
      </div>
    </section>
  )
}
export default BannerSearch
