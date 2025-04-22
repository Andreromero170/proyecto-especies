import React, { useState } from 'react';
import './FilterFauna.css';

const FilterFauna = ({ filters, setFilters, filterOptionsSpecies }) => {
    const [isAdvancedFilterOpen, setIsAdvancedFilterOpen] = useState(false);
    const handleSearchChange = (e) => {
        setFilters({
            ...filters,
            buscar: e.target.value
        });
    };
    const handleFilterChange = (e) => {
        setFilters({
            ...filters,
            [e.target.name]: e.target.value
        });
    };
    const resetFilters = () => {
        setFilters({
            buscar: '',
            familia: 'todos',
            habitat: 'todos',
            ubicacion: 'todos',
        });
    };
    const toggleAdvancedFilter = () => {
        setIsAdvancedFilterOpen(!isAdvancedFilterOpen);
    };

    return (
        <div className="filter-fauna-container">
            <div className="search-container">
                <div className="main-search">
                    <input
                        type="text"
                        className="search-input"
                        placeholder="Busca por nombre, nombre científico o descripción..."
                        value={filters.buscar}
                        onChange={handleSearchChange}
                    />
                    <button className="search-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                    </button>
                </div>

                <button
                    className={`advanced-filter-toggle ${isAdvancedFilterOpen ? 'active' : ''}`}
                    onClick={toggleAdvancedFilter}
                >
                    Filtros Avanzados
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="currentColor"
                        viewBox="0 0 16 16"
                        className={isAdvancedFilterOpen ? 'rotate' : ''}
                    >
                        <path fillRule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                    </svg>
                </button>
            </div>

            <div className={`advanced-filters ${isAdvancedFilterOpen ? 'open' : ''}`}>
                <div className="filter-row">
                    <div className="filter-group">
                        <label htmlFor="familia">Familia</label>
                        <select
                            id="familia"
                            name="familia"
                            value={filters.familia}
                            onChange={handleFilterChange}
                        >
                            {filterOptionsSpecies.familias.map((familia, index) => (
                                <option key={index} value={familia}>
                                    {familia === 'todas' ? 'Todas las familias' : familia}
                                </option>
                            ))}
                        </select>
                    </div>

                    <div className="filter-group">
                        <label htmlFor="habitat">Hábitat</label>
                        <select
                            id="habitat"
                            name="habitat"
                            value={filters.habitat}
                            onChange={handleFilterChange}
                        >
                            {filterOptionsSpecies.habitats.map((habitat, index) => (
                                <option key={index} value={habitat.id}>
                                    {habitat.nombre === 'todos' ? 'Todos los hábitats' : habitat.nombre}
                                </option>
                            ))}
                        </select>
                    </div>

                    <div className="filter-group">
                        <label htmlFor="ubicacion">Ubicación</label>
                        <select
                            id="ubicacion"
                            name="ubicacion"
                            value={filters.ubicacion}
                            onChange={handleFilterChange}
                        >
                            {filterOptionsSpecies.ubicaciones.map((ubicacion, index) => (
                                <option key={index} value={ubicacion.id}>
                                    {ubicacion.nombre === 'todas' ? 'Todas las ubicaciones' : ubicacion.nombre}
                                </option>
                            ))}
                        </select>
                    </div>

                    <button className="reset-filter-btn" onClick={resetFilters}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path fillRule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z" />
                            <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z" />
                        </svg>
                        Reiniciar filtros
                    </button>
                </div>
            </div>
        </div>
    );
};

export default FilterFauna;