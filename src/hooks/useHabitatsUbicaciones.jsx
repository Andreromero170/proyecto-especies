import { useState, useEffect } from 'react';
import axios from 'axios';

const useHabitatsUbicaciones = () => {
    const [habitats, setHabitats] = useState([]);
    const [ubicaciones, setUbicaciones] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const fetchData = async () => {
            try {
                setLoading(true);

                //const responseHabitats = await axios.get('https://juditlg25.iesmontenaranco.com:8000/api/habitats');
                const responseHabitats = await axios.get('http://127.0.0.1:8000/api/habitats');

                if (responseHabitats.data) {
                    setHabitats(responseHabitats.data);
                }

                //const responseUbicaciones = await axios.get('https://juditlg25.iesmontenaranco.com:8000/api/ubicaciones');
                const responseUbicaciones = await axios.get('http://127.0.0.1:8000/api/ubicaciones');

                if (responseUbicaciones.data) {
                    setUbicaciones(responseUbicaciones.data);
                }
            } catch (err) {
                setError('Error al cargar datos');
                console.error(err);
            } finally {
                setLoading(false);
            }
        };

        fetchData();
    }, []);

    return { habitats, ubicaciones, loading, error };
};

export default useHabitatsUbicaciones;