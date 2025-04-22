import React from 'react';
import { Link } from "react-router-dom";

const CardsSpecies = ({ filteredSpecies = [] }) => {

  if (!Array.isArray(filteredSpecies)) {
    console.error("El prop 'filteredSpecies' debe ser un arreglo.");
    return <p>Error al cargar las especies.</p>;
  }
  const getSpeciesImage = (species) => {
   // const basePath = "https://juditlg25.iesmontenaranco.com:8000/img/especies";
   const basePath = "https://juditlg25.iesmontenaranco.com:8000/img/especies";
 
   const folder = species.tipo === "flora" ? "flora" : "fauna";
    const fileName = species.nombre_vernaculo
      ? species.nombre_cientifico.replace(/\s/g, "-").toLowerCase() + ".jpg"
      : "default.jpg";

    return `${basePath}/${folder}/${fileName}`;
  };


  if (filteredSpecies.length === 0) {
    return <p>No se encontraron especies.</p>;
  }

  return (
    <div className="species-grid">
      {filteredSpecies.map((species) => (
        <div key={species.id} className="species-card">
          <div className="species-img-container">
            <img
              src={getSpeciesImage(species)}
              alt={species.nombre_vernaculo}
              className="species-img"
            />
            <span className={`species-badge ${species.tipo}`}>
              {species.tipo === "flora" ? "Flora" : "Fauna"}
            </span>
          </div>
          <div className="species-content">
            <h3 className="species-name">{species.nombre_vernaculo}</h3>
            <p className="species-scientific-name">{species.nombre_cientifico}</p>
            <p className="species-description">{species.descripcion}</p>
            <Link to={`/especies/${species.id}`} className="species-link">
              Ver más detalles
            </Link>
          </div>
        </div>
      ))}
    </div>
  );
}

export default CardsSpecies;
