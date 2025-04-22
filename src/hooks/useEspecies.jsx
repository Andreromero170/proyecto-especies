import { useState, useEffect } from 'react';
import axios from 'axios';

const useEspecies = (filters) => {
    const [species, setSpecies] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [nextPageUrl, setNextPageUrl] = useState(null);

    // Limpia filtros con valores "vacíos"
    const cleanFilters = (filters) => {
        return Object.entries(filters).reduce((acc, [key, value]) => {
            if (value && value !== '' && value !== 'all') {
                acc[key] = value;
            }
            return acc;
        }, {});
    };

    // Función para cargar más especies (paginación)
    const loadMore = () => {
        if (nextPageUrl) {
            fetchSpecies(nextPageUrl, false);
        }
    };

    // Función principal para obtener especies
    const fetchSpecies = async (url = null, reset = true) => {
        try {
            setLoading(true);

            // Obtener el token desde localStorage (si existe)
            const token = localStorage.getItem('token');
            const headers = {
                Accept: 'application/json',
            };

            // Si el token existe, se añade el Authorization header
            if (token) {
                headers.Authorization = `Bearer ${token}`;
            }

            let response;

            // Si no hay token, tratamos como invitado (por lo que solo se buscarán especies aprobadas)
            if (!token) {
                const cleanedFilters = cleanFilters(filters);
                response = await axios.get('http://127.0.0.1:8000/api/listado_especies_invitado', {
                    params: cleanedFilters,
                    headers,
                });
            } else {
                // Si el token existe, se usan los filtros como de costumbre
                if (url) {
                    response = await axios.get(url, { headers });
                } else {
                    const cleanedFilters = cleanFilters(filters);
                    response = await axios.get('http://127.0.0.1:8000/api/especies', {
                        params: cleanedFilters,
                        headers,
                    });
                }
            }

            const data = response.data;

            setSpecies(prev =>
                reset ? data.especies.data : [...prev, ...data.especies.data]
            );

            setNextPageUrl(data.especies.next_page_url);

        } catch (err) {
            console.error('Error al cargar especies:', err);
            setError(err.message);
        } finally {
            setLoading(false);
        }
    };

    // Llamada inicial y cada vez que cambien los filtros
    useEffect(() => {
        fetchSpecies();
    }, [filters]);

    return { species, loading, error, loadMore, nextPageUrl };
};

export default useEspecies;
