import React, { useState } from 'react';
import { Helmet } from 'react-helmet';
import './Flora.css';
import FilterFlora from '../components/flora/FilterFlora';
import FloraCards from '../components/flora/FloraCards';
import useFlora from '../hooks/useFlora';
import { useAuth } from '../context/AuthContext';
import useFilterOption from '../hooks/useFilterOption';

const Flora = () => {
    const auth = useAuth();
    const { user } = auth;
    const isAdmin = user?.rol === 'admin';
    const isProfesor = user?.rol === 'profesor';
    const [resultsView, setResultsView] = useState('grid');

    const [filters, setFilters] = useState({
        buscar: '',
        familia: 'todos',
        habitat: 'todos',
        ubicacion: 'todos',
    });
    //console.log("Llamo al useFilterOption");
    const { filterOptionsSpecies, loadingFilterOptions, errorFilterOptions } = useFilterOption();
    const { flora, loading, error, nextPageUrl, loadMore } = useFlora(filters);

    if (loadingFilterOptions) {
        return (
            <div className="flora-page">
                <Helmet>
                    <title>Flora de Asturias</title>
                    <meta name="description" content="Explora la rica diversidad botánica del Principado de Asturias" />
                </Helmet>
                <div className="container">
                    <div className="loading-container">
                        <div className="loading-spinner"></div>
                        <p>Cargando especies de flora...</p>
                    </div>
                </div>
            </div>
        );
    }

    if (errorFilterOptions) {
        return (
            <div className="flora-page">
                <Helmet>
                    <title>Flora de Asturias</title>
                </Helmet>
                <div className="container">
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
        <div className="flora-page">
            <Helmet>
                <title>Flora de Asturias</title>
                <meta name="description" content="Explora la rica diversidad botánica del Principado de Asturias" />
            </Helmet>

            <div className="container flora-content">
                <section className="flora-section">
                    <div className="flora-section-header">
                        <h1 className="page-title">
                            Flora de Asturias
                            {(isProfesor || isAdmin) && (
                                <span className="admin-badge">Vista de {isAdmin ? 'Administrador' : 'Profesor'}</span>
                            )}
                        </h1>
                        <div className="view-toggle">
                            <button
                                className={`view-toggle-btn ${resultsView === 'grid' ? 'active' : ''}`}
                                onClick={() => setResultsView('grid')}
                                aria-label="Ver en cuadrícula"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z" />
                                </svg>
                            </button>
                            <button
                                className={`view-toggle-btn ${resultsView === 'list' ? 'active' : ''}`}
                                onClick={() => setResultsView('list')}
                                aria-label="Ver en lista"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                    <path fillRule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div className="flora-intro">
                        <p>
                            Explora la rica diversidad botánica del Principado de Asturias, desde los bosques caducifolios hasta los prados alpinos.
                            Descubre las especies vegetales que habitan en este paraíso natural del norte de España.
                        </p>
                        {(isProfesor || isAdmin) && (
                            <div className="admin-info-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                </svg>
                                <div>
                                    <p>Como {isAdmin ? 'administrador' : 'profesor'}, puedes ver todas las especies de flora independientemente de su estado de aprobación. Las especies no aprobadas están marcadas con su estado correspondiente.</p>
                                </div>
                            </div>
                        )}
                    </div>

                    <FilterFlora
                        filters={filters}
                        setFilters={setFilters}
                        filterOptionsSpecies={filterOptionsSpecies}
                        isProfesor={isProfesor}
                        isAdmin={isAdmin}
                    />
                    <div className={`flora-results ${resultsView === 'list' ? 'list-view' : ''}`}>
                        <FloraCards
                            flora={flora}
                        />
                    </div>

                    {flora.length > 0 && (
                        <div className="flora-results-info">
                            Mostrando {flora.length} {flora.length === 1 ? 'especie' : 'especies'} de flora
                        </div>
                    )}

                    {nextPageUrl && (
                        <div className="load-more-button text-center mt-4">
                            <button onClick={loadMore} className="btn load-more-btn" disabled={loading}>
                                {loading ? "Cargando..." : "Ver más especies"}
                            </button>
                        </div>
                    )}
                </section>

                <section className="flora-info-section">
                    <div className="info-cards">
                        <div className="info-card">
                            <div className="info-card-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                                </svg>
                            </div>
                            <h3>Biodiversidad Vegetal</h3>
                            <p>
                                Asturias alberga una extraordinaria diversidad de flora gracias a su variedad de ecosistemas,
                                desde la costa hasta la alta montaña, pasando por valles y bosques.
                            </p>
                        </div>

                        <div className="info-card">
                            <div className="info-card-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 15.983a7.5 7.5 0 0 0 2.501-14.032l-1.499 4.508-1.499-4.508A7.5 7.5 0 0 0 8 15.983zM8.5 2.421L10.5 7h-4l2-4.579z" />
                                    <path d="M7.362 15.716a8 8 0 1 1 1.276 0 3.273 3.273 0 0 1-.63-.919 7 7 0 1 0-.646.919z" />
                                </svg>
                            </div>
                            <h3>Conservación</h3>
                            <p>
                                Muchas de las especies de flora asturiana están protegidas. Conocerlas es el primer paso
                                para conservar este patrimonio natural único y de gran valor ecológico.
                            </p>
                        </div>

                        <div className="info-card">
                            <div className="info-card-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path fillRule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                </svg>
                            </div>
                            <h3>Colabora</h3>
                            <p>
                                Como estudiante, puedes contribuir a ampliar esta base de conocimiento subiendo tus propias
                                observaciones de flora asturiana y compartiendo fotografías.
                            </p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    );
};

export default Flora;