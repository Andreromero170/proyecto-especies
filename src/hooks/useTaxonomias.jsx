import { useState, useEffect } from 'react';
import axios from 'axios';

const useTaxonomias = () => {
    const [taxonomias, setTaxonomias] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const fetchTaxonomias = async () => {
            try {
                setLoading(true);
               // const response = await axios.get('https://juditlg25.iesmontenaranco.com:8000/api/taxonomias');
               const response = await axios.get('http://127.0.0.1:8000/api/taxonomias');
 
               if (response.data) {
                    setTaxonomias(response.data);
                }
            } catch (err) {
                setError('Error al cargar taxonomías');
                console.error(err);
            } finally {
                setLoading(false);
            }
        };

        fetchTaxonomias();
    }, []);

    return { taxonomias, loading, error };
};

export default useTaxonomias;