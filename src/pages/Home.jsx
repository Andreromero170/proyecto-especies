import React, { useState } from "react";
import { Helmet } from 'react-helmet';
import "./Home.css";
import BannerSearch from "../components/home/BannerSearch";
import CardsSpecies from "../components/home/CardsSpecies";
import FilterSpecies from "../components/home/FilterSpecies";
import AboutProject from "../components/home/AboutProject";
import useEspecies from "../hooks/useEspecies";

const Home = () => {
  const [filters, setFilters] = useState({
    buscar: '',
    tipo: 'all',
  });

  const { species, loading, error, nextPageUrl, loadMore } = useEspecies(filters);

  // Función para actualizar los filtros de búsqueda
  const handleSearch = (search) => {
    setFilters((prevFilters) => ({
      ...prevFilters,
      buscar: search,
    }));
  };

  // Función para actualizar el filtro de tipo
  const handleTypeChange = (type) => {
    setFilters((prevFilters) => ({
      ...prevFilters,
      tipo: type,
    }));
  };

  if (loading && species.length === 0) {
    return (
      <div className="home-page">
        <Helmet>
          <title>NarancoBioExplorer</title>
          <meta name="description" content="Explora la biodiversidad del Principado de Asturias" />
        </Helmet>
        <div className="container my-5">
          <div className="loading-container">
            <div className="loading-spinner"></div>
            <p>Cargando especies...</p>
          </div>
        </div>
      </div>
    );
  }

  if (error) {
    return (
      <div className="home-page">
        <Helmet>
          <title>NarancoBioExplorer</title>
        </Helmet>
        <div className="container my-5">
          <div className="error-container">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
              <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
            </svg>
            <h2>Ha ocurrido un error</h2>
            <p>{error}</p>
            <button className="retry-button" onClick={() => window.location.reload()}>
              Reintentar
            </button>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className="home-page">
      <Helmet>
        <title>NarancoBioExplorer</title>
      </Helmet>

      <BannerSearch setSearchSpecies={handleSearch} />
      
      <section className="featured-section">
        <div className="container">
          <FilterSpecies setActiveTab={handleTypeChange} activeTab={filters.tipo} />
          <CardsSpecies filteredSpecies={species} />
          {
            nextPageUrl && (
              <div className="load-more-button text-center mt-4">
                <button onClick={loadMore} className="btn load-more-btn" disabled={loading}>
                  {loading ? "Cargando..." : "Ver más especies"}
                </button>
              </div>
            )
          }
        </div>
      </section>

      <AboutProject />
    </div>
  );
};

export default Home;