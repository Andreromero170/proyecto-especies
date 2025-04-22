import React, { useEffect, useState } from 'react';
import axios from 'axios';

const useFilterOption = () => {
    const [filterOptionsSpecies, setFilterOptionsSpecies] = useState([]);
    const [loadingFilterOptions, setLoadingFilterOptions] = useState(true);
    const [errorFilterOptions, setErrorFilterOptions] = useState(null);

    useEffect(() => {
        const fetchFilterOptions = async () => {
            try {
                const response = await axios.get("https://juditlg25.iesmontenaranco.com:8000/api/especies/filtros");
                setFilterOptionsSpecies(response.data);
            } catch (err) {
                setErrorFilterOptions("Error al cargar filtros", err);
            } finally {
                setLoadingFilterOptions(false);
            }
        };

        fetchFilterOptions();
    }, []);

    return {filterOptionsSpecies, loadingFilterOptions, errorFilterOptions};
}

export default useFilterOption;