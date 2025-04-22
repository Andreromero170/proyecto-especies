import React from 'react'

const FilterSpecies = ({ setActiveTab, activeTab }) => {
    return (
        <>
            <h2 className="section-title mb-5">Explora Nuestra Biodiversidad</h2>
            <div className="tabs-container">
                <div className="tabs">
                    <button
                        className={`tab-btn ${activeTab === "all" ? "active" : ""}`}
                        onClick={() => setActiveTab("all")}
                        data-tipo="all"
                    >
                        Todas
                    </button>
                    <button
                        className={`tab-btn ${activeTab === "flora" ? "active" : ""}`}
                        onClick={() => setActiveTab("flora")}
                        data-tipo="flora"
                    >
                        Flora
                    </button>
                    <button
                        className={`tab-btn ${activeTab === "fauna" ? "active" : ""}`}
                        onClick={() => setActiveTab("fauna")}
                        data-tipo="fauna"
                    >
                        Fauna
                    </button>
                </div>
            </div>
        </>
    )
}

export default FilterSpecies