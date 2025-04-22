import {useState, useEffect} from 'react';
import axios from 'axios';

const useFlora = (filters) => {
    const [flora, setFlora] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [nextPageUrl, setNextPageUrl] = useState(null);

    const cleanFilters = (filters) => {
        const cleanedFilters = Object.entries(filters).reduce((filter, [key, value]) => {
            if (value && value !== '' && value !== 'todos') {
                filter[key] = value;
            }
            return filter;
        }, {});

        cleanedFilters.tipo = 'flora';

        return cleanedFilters;
    };

    const loadMore = () => {
        if (nextPageUrl) {
            fetchFloraData(nextPageUrl, false);
        }
    };

    const fetchFloraData = async (url = null, reset = true) => {
        try {
            setLoading(true);

            if (url) {
                const response = await axios.get(url);
                const data = response.data;

                setFlora(prev =>
                    reset ? data.data : [...prev, ...data.data]
                );

                const correctedNextPageUrl = data.next_page_url
                    ? data.next_page_url.replace('http://juditlg25.iesmontenaranco.com:8000', 'https://juditlg25.iesmontenaranco.com:8000')
                    : null;

                setNextPageUrl(correctedNextPageUrl);
            } else {
                const cleanedFilters = cleanFilters(filters);
                const response = await axios.get('https://juditlg25.iesmontenaranco.com:8000/api/especies', {
                    params: cleanedFilters,
                });
                const data = response.data;

                setFlora(data.data);

                const correctedNextPageUrl = data.next_page_url
                    ? data.next_page_url.replace('http://juditlg25.iesmontenaranco.com:8000', 'https://juditlg25.iesmontenaranco.com:8000')
                    : null;

                setNextPageUrl(correctedNextPageUrl);
            }
        } catch (err) {
            setError(err.message);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchFloraData();
    }, [filters]);

    return { flora, loading, error, nextPageUrl, loadMore };
};

export default useFlora;