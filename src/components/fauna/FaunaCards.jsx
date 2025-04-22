import React from 'react';
import { Link } from 'react-router-dom';
import './FaunaCards.css';

const FaunaCards = ({ fauna }) => {
    const handleImageError = (e) => {
        e.target.src = '/img/especies/fauna/default.jpg';
    };

    if (fauna.length === 0) {
        return (
            <div className="no-fauna-results">
                <div className="no-results-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M4.285 12.433a.5.5 0 0 0 .683-.183A3.498 3.498 0 0 1 8 10.5c1.295 0 2.426.703 3.032 1.75a.5.5 0 0 0 .866-.5A4.498 4.498 0 0 0 8 9.5a4.5 4.5 0 0 0-3.898 2.25.5.5 0 0 0 .183.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z" />
                    </svg>
                </div>
                <h3>No se encontraron resultados</h3>
                <p>Intenta modificar los filtros para encontrar lo que buscas.</p>
            </div>
        );
    }

    return (
        <div className="fauna-cards-grid">
            {fauna.map((animal) => (
                <div className={`fauna-card ${animal.estado !== 'aprobada' ? `estado-${animal.estado}` : ''}`} key={animal.id}>
                    {animal.estado !== 'aprobada' && (
                        <div className={`estado-badge estado-${animal.estado}`}>
                            {animal.estado}
                        </div>
                    )}

                    <div className="fauna-card-image-container">
                        <img
                            src={animal.imagen_url}
                            alt={animal.nombre_vernaculo}
                            className="fauna-card-image"
                            onError={handleImageError}
                        />
                        <div className="fauna-card-tags">
                            <span className="fauna-family-tag">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                                </svg>
                                {animal.taxonomia && animal.taxonomia.familia ? animal.taxonomia.familia : 'Familia no disponible'}
                            </span>
                        </div>
                    </div>
                    <div className="fauna-card-content">
                        <div className="fauna-card-header">
                            <h3 className="fauna-card-title">{animal.nombre_vernaculo}</h3>
                            <p className="fauna-card-scientific-name">{animal.nombre_cientifico}</p>
                        </div>
                        <p className="fauna-card-description">{animal.descripcion}</p>
                        <div className="fauna-card-footer">
                            <div className="fauna-card-location">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                                </svg>
                                <span>
                                    {animal.ubicaciones && animal.ubicaciones.length > 0
                                        ? animal.ubicaciones[0].nombre
                                        : 'Ubicación no disponible'}
                                </span>
                            </div>
                            <Link to={`/fauna/${animal.slug}`} className="fauna-card-link">
                                Ver detalles
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path fillRule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </Link>
                        </div>
                    </div>
                </div>
            ))}
        </div>
    );
};

export default FaunaCards;