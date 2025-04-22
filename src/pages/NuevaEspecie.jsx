import React, { useState, useRef, useEffect } from 'react';
import { Helmet } from 'react-helmet';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import { useAuth } from '../context/AuthContext';
import useTaxonomias from '../hooks/useTaxonomias';
import useHabitatsUbicaciones from '../hooks/useHabitatsUbicaciones';
import './NuevaEspecie.css';

const NuevaEspecie = () => {
    const { user, token } = useAuth();
    const navigate = useNavigate();
    const fileInputRef = useRef(null);
    const { taxonomias, loading: loadingTaxonomias } = useTaxonomias();
    const { habitats, ubicaciones, loading: loadingHabitatsUbicaciones } = useHabitatsUbicaciones();

    const [formData, setFormData] = useState({
        tipo: 'flora',
        nombre_cientifico: '',
        nombre_vernaculo: '',
        descripcion: '',
        taxonomia_id: '',
        habitats: [],
        ubicaciones: [],
    });

    const [imageFiles, setImageFiles] = useState([]);
    const [imagePreviewUrls, setImagePreviewUrls] = useState([]);
    const [principalImageIndex, setPrincipalImageIndex] = useState(0);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);
    const [success, setSuccess] = useState(false);
    const [validationErrors, setValidationErrors] = useState({});

    useEffect(() => {
        if (!loading && user && user.rol !== 'alumno') {
            navigate('/');
        }
    }, [user, navigate, loading]);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData({
            ...formData,
            [name]: value
        });

        if (validationErrors[name]) {
            setValidationErrors({
                ...validationErrors,
                [name]: null
            });
        }
    };

    const handleHabitatChange = (habitatId) => {
        const updatedHabitats = [...formData.habitats];
        if (updatedHabitats.includes(habitatId)) {
            const index = updatedHabitats.indexOf(habitatId);
            updatedHabitats.splice(index, 1);
        } else {
            updatedHabitats.push(habitatId);
        }

        setFormData({
            ...formData,
            habitats: updatedHabitats
        });

        if (validationErrors.habitats) {
            setValidationErrors({
                ...validationErrors,
                habitats: null
            });
        }
    };

    const handleUbicacionChange = (ubicacionId) => {
        const updatedUbicaciones = [...formData.ubicaciones];
        if (updatedUbicaciones.includes(ubicacionId)) {
            const index = updatedUbicaciones.indexOf(ubicacionId);
            updatedUbicaciones.splice(index, 1);
        } else {
            updatedUbicaciones.push(ubicacionId);
        }

        setFormData({
            ...formData,
            ubicaciones: updatedUbicaciones
        });

        if (validationErrors.ubicaciones) {
            setValidationErrors({
                ...validationErrors,
                ubicaciones: null
            });
        }
    };

    const handleImageUpload = (e) => {
        e.preventDefault();
        const files = Array.from(e.target.files);

        if (files.length === 0) return;

        const invalidFiles = files.filter(file => !file.type.match('image.*'));
        if (invalidFiles.length > 0) {
            setError('Por favor, selecciona solo archivos de imagen');
            return;
        }

        const newImageFiles = [...imageFiles, ...files];
        setImageFiles(newImageFiles);

        const newPreviewUrls = files.map(file => URL.createObjectURL(file));
        setImagePreviewUrls([...imagePreviewUrls, ...newPreviewUrls]);

        if (imageFiles.length === 0 && files.length > 0) {
            setPrincipalImageIndex(0);
        }

        if (validationErrors.images) {
            setValidationErrors({
                ...validationErrors,
                images: null
            });
        }
    };

    const handleRemoveImage = (index) => {
        const newImageFiles = [...imageFiles];
        const newPreviewUrls = [...imagePreviewUrls];

        URL.revokeObjectURL(newPreviewUrls[index]);

        newImageFiles.splice(index, 1);
        newPreviewUrls.splice(index, 1);

        setImageFiles(newImageFiles);
        setImagePreviewUrls(newPreviewUrls);

        if (principalImageIndex === index) {
            setPrincipalImageIndex(0);
        } else if (principalImageIndex > index) {
            setPrincipalImageIndex(principalImageIndex - 1);
        }
    };

    const setPrincipalImage = (index) => {
        setPrincipalImageIndex(index);
    };

    const validateForm = () => {
        const errors = {};

        if (!formData.nombre_cientifico.trim()) {
            errors.nombre_cientifico = 'El nombre científico es obligatorio';
        }

        if (!formData.nombre_vernaculo.trim()) {
            errors.nombre_vernaculo = 'El nombre común es obligatorio';
        }

        if (!formData.descripcion.trim()) {
            errors.descripcion = 'La descripción es obligatoria';
        } else if (formData.descripcion.trim().length < 50) {
            errors.descripcion = 'La descripción debe tener al menos 50 caracteres';
        }

        if (!formData.taxonomia_id) {
            errors.taxonomia_id = 'Debes seleccionar una taxonomía';
        }

        if (formData.habitats.length === 0) {
            errors.habitats = 'Debes seleccionar al menos un hábitat';
        }

        if (formData.ubicaciones.length === 0) {
            errors.ubicaciones = 'Debes seleccionar al menos una ubicación';
        }

        if (imageFiles.length === 0) {
            errors.images = 'Debes subir al menos una imagen';
        }

        setValidationErrors(errors);
        return Object.keys(errors).length === 0;
    };
    const handleSubmit = async (e) => {
        e.preventDefault();
    
        if (!validateForm()) {
            window.scrollTo(0, 0);
            return;
        }
    
        setLoading(true);
        setError(null);
        setSuccess(false);
    
        try {
            const formDataToSend = new FormData();
    
            // Agregar los campos normales
            formDataToSend.append('tipo', formData.tipo);
            formDataToSend.append('nombre_cientifico', formData.nombre_cientifico);
            formDataToSend.append('nombre_vernaculo', formData.nombre_vernaculo);
            formDataToSend.append('descripcion', formData.descripcion);
            formDataToSend.append('taxonomia_id', formData.taxonomia_id);
    
            // Agregar habitats (array de IDs)
            formData.habitats.forEach((habitatId, index) => {
                formDataToSend.append(`habitats[${index}]`, habitatId);
            });
    
            // Agregar ubicaciones (array de IDs)
            formData.ubicaciones.forEach((ubicacionId, index) => {
                formDataToSend.append(`ubicaciones[${index}]`, ubicacionId);
            });
    
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data', // Mantener multipart para otros datos si fuera necesario
                    'Authorization': `Bearer ${token}` // Si necesitas autorización
                }
            };
    
            // Realizar la solicitud POST al backend (sin las imágenes)
            const response = await axios.post('http://127.0.0.1:8000/api/especies', formDataToSend, config);
    
            if (response.data && response.data.status) {
                setSuccess(true);
    
                // Limpiar el formulario tras un envío exitoso
                setFormData({
                    tipo: 'flora',
                    nombre_cientifico: '',
                    nombre_vernaculo: '',
                    descripcion: '',
                    taxonomia_id: '',
                    habitats: [],
                    ubicaciones: [],
                });
    
                // Limpiar imágenes y otros estados
                setImageFiles([]);
                setImagePreviewUrls([]);
                setPrincipalImageIndex(0);
    
                window.scrollTo(0, 0);
    
                // Redirigir después de 3 segundos
                setTimeout(() => {
                    navigate('/');
                }, 3000);
            }
        } catch (err) {
            console.error('Error al enviar los datos:', err);
    
            if (err.response && err.response.data && err.response.data.errors) {
                setValidationErrors(err.response.data.errors);
            } else {
                setError('Ha ocurrido un error al guardar la especie. Por favor, inténtalo de nuevo.');
            }
    
            window.scrollTo(0, 0);
        } finally {
            setLoading(false);
        }
    };
    

    if (loadingTaxonomias || loadingHabitatsUbicaciones) {
        return (
            <div className="nueva-especie-page">
                <div className="form-loading">
                    <div className="loading-spinner"></div>
                    <p className="loading-text">Cargando formulario...</p>
                </div>
            </div>
        );
    }

    return (
        <div className="nueva-especie-page">
            <Helmet>
                <title>Añadir Nueva Especie</title>
            </Helmet>

            {loading && (
                <div className="form-loading">
                    <div className="loading-spinner"></div>
                    <p className="loading-text">Guardando especie...</p>
                </div>
            )}

            <div className="container form-container py-5">
                <div className="row justify-content-center">
                    <div className="col-lg-10">
                        <div className="card">
                            <div className="card-header">
                                <h1 className="section-title">Añadir Nueva Especie</h1>
                            </div>

                            <div className="card-body">
                                {success && (
                                    <div className="alert-custom alert-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg>
                                        <div>
                                            <strong>¡Enhorabuena!</strong> Tu especie ha sido guardada correctamente.
                                            Serás redirigido en unos segundos...
                                        </div>
                                    </div>
                                )}

                                {error && (
                                    <div className="alert-custom alert-error">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                                        </svg>
                                        <div>
                                            <strong>¡Error!</strong> {error}
                                        </div>
                                    </div>
                                )}

                                <form onSubmit={handleSubmit}>
                                    <div className="form-section">
                                        <div className="section-header">
                                            <div className="section-icon">
                                                <i className="fas fa-info-circle"></i>
                                            </div>
                                            <h2 className="form-section-title">Información Básica</h2>
                                        </div>

                                        <div className="form-group mb-4">
                                            <label className="form-label">Tipo de Especie</label>
                                            <div className="radio-group">
                                                <label className={`radio-option ${formData.tipo === 'flora' ? 'active flora' : ''}`}>
                                                    <input
                                                        type="radio"
                                                        name="tipo"
                                                        value="flora"
                                                        checked={formData.tipo === 'flora'}
                                                        onChange={handleChange}
                                                        className="form-check-input"
                                                    />
                                                    <i className="fas fa-leaf me-2"></i>
                                                    Flora
                                                </label>
                                                <label className={`radio-option ${formData.tipo === 'fauna' ? 'active fauna' : ''}`}>
                                                    <input
                                                        type="radio"
                                                        name="tipo"
                                                        value="fauna"
                                                        checked={formData.tipo === 'fauna'}
                                                        onChange={handleChange}
                                                        className="form-check-input"
                                                    />
                                                    <i className="fas fa-paw me-2"></i>
                                                    Fauna
                                                </label>
                                            </div>
                                        </div>

                                        <div className="row mb-4">
                                            <div className="col-md-6 mb-3 mb-md-0">
                                                <div className="form-floating">
                                                    <input
                                                        type="text"
                                                        className={`form-control ${validationErrors.nombre_cientifico ? 'is-invalid' : ''}`}
                                                        id="nombre_cientifico"
                                                        name="nombre_cientifico"
                                                        value={formData.nombre_cientifico}
                                                        onChange={handleChange}
                                                        placeholder="Ej: Quercus robur"
                                                    />
                                                    <label htmlFor="nombre_cientifico">Nombre Científico*</label>
                                                    {validationErrors.nombre_cientifico && (
                                                        <div className="invalid-feedback">{validationErrors.nombre_cientifico}</div>
                                                    )}
                                                </div>
                                            </div>

                                            <div className="col-md-6">
                                                <div className="form-floating">
                                                    <input
                                                        type="text"
                                                        className={`form-control ${validationErrors.nombre_vernaculo ? 'is-invalid' : ''}`}
                                                        id="nombre_vernaculo"
                                                        name="nombre_vernaculo"
                                                        value={formData.nombre_vernaculo}
                                                        onChange={handleChange}
                                                        placeholder="Ej: Roble carbayo"
                                                    />
                                                    <label htmlFor="nombre_vernaculo">Nombre Común*</label>
                                                    {validationErrors.nombre_vernaculo && (
                                                        <div className="invalid-feedback">{validationErrors.nombre_vernaculo}</div>
                                                    )}
                                                </div>
                                            </div>
                                        </div>

                                        <div className="mb-4">
                                            <label htmlFor="taxonomia_id" className="form-label">Taxonomía*</label>
                                            <select
                                                id="taxonomia_id"
                                                name="taxonomia_id"
                                                value={formData.taxonomia_id}
                                                onChange={handleChange}
                                                className={`form-select ${validationErrors.taxonomia_id ? 'is-invalid' : ''}`}
                                            >
                                                <option value="">Selecciona una taxonomía</option>
                                                {taxonomias && taxonomias.length > 0 ? (
                                                    taxonomias
                                                        .filter(tax => (formData.tipo === 'flora' ? tax.reino === 'Plantae' : tax.reino === 'Animalia'))
                                                        .map(tax => (
                                                            <option key={tax.id} value={tax.id}>
                                                                {tax.genero} ({tax.familia})
                                                            </option>
                                                        ))
                                                ) : (
                                                    <option value="" disabled>No hay taxonomías disponibles</option>
                                                )}
                                            </select>
                                            {validationErrors.taxonomia_id && (
                                                <div className="invalid-feedback">{validationErrors.taxonomia_id}</div>
                                            )}
                                        </div>

                                        <div className="mb-3">
                                            <label htmlFor="descripcion" className="form-label">Descripción*</label>
                                            <textarea
                                                id="descripcion"
                                                name="descripcion"
                                                value={formData.descripcion}
                                                onChange={handleChange}
                                                className={`form-control ${validationErrors.descripcion ? 'is-invalid' : ''}`}
                                                rows="6"
                                                placeholder="Describe detalladamente la especie, incluyendo características físicas, hábitos, distribución en Asturias, etc."
                                            ></textarea>
                                            {validationErrors.descripcion && (
                                                <div className="invalid-feedback">{validationErrors.descripcion}</div>
                                            )}
                                        </div>
                                    </div>

                                    <div className="form-section">
                                        <div className="section-header">
                                            <div className="section-icon">
                                                <i className="fas fa-camera"></i>
                                            </div>
                                            <h2 className="form-section-title">Imágenes</h2>
                                        </div>

                                        <div
                                            className="upload-container mb-3"
                                            onClick={() => fileInputRef.current.click()}
                                        >
                                            <div className="upload-icon">
                                                <i className="fas fa-cloud-upload-alt"></i>
                                            </div>
                                            <h3 className="upload-text">Haz clic para subir imágenes</h3>
                                            <p className="upload-subtext">Formatos: JPG, PNG, GIF (Máx. 5MB por imagen)</p>

                                            <input
                                                type="file"
                                                ref={fileInputRef}
                                                onChange={handleImageUpload}
                                                style={{ display: 'none' }}
                                                accept="image/*"
                                                multiple
                                            />
                                        </div>

                                        {validationErrors.images && (
                                            <div className="invalid-feedback d-block mb-3">{validationErrors.images}</div>
                                        )}

                                        {imagePreviewUrls.length > 0 && (
                                            <div className="preview-container">
                                                {imagePreviewUrls.map((url, index) => (
                                                    <div key={index} className={`preview-item ${index === principalImageIndex ? 'principal' : ''}`}>
                                                        <img src={url} alt={`Vista previa ${index + 1}`} className="preview-image" />
                                                        <div className="preview-remove" onClick={() => handleRemoveImage(index)}>×</div>
                                                        {index !== principalImageIndex && (
                                                            <button
                                                                type="button"
                                                                onClick={() => setPrincipalImage(index)}
                                                                className="btn-principal"
                                                            >
                                                                <i className="fas fa-star me-1"></i>
                                                                Principal
                                                            </button>
                                                        )}
                                                    </div>
                                                ))}
                                            </div>
                                        )}
                                    </div>

                                    <div className="form-section">
                                        <div className="section-header">
                                            <div className="section-icon">
                                                <i className="fas fa-tree"></i>
                                            </div>
                                            <h2 className="form-section-title">Hábitats</h2>
                                        </div>

                                        <div className="mb-4">
                                            <label htmlFor="habitats" className="form-label">Selecciona los hábitats (mínimo 1)*</label>
                                            <div className="selector-container">
                                                {validationErrors.habitats && (
                                                    <div className="invalid-feedback d-block mb-3">{validationErrors.habitats}</div>
                                                )}

                                                {habitats && habitats.length > 0 ? (
                                                    <div className="checkbox-list">
                                                        {habitats.map(habitat => (
                                                            <label
                                                                key={habitat.id}
                                                                className={`checkbox-item ${formData.habitats.includes(habitat.id.toString()) ? 'selected' : ''}`}
                                                            >
                                                                <input
                                                                    type="checkbox"
                                                                    className="form-check-input"
                                                                    checked={formData.habitats.includes(habitat.id.toString())}
                                                                    onChange={() => handleHabitatChange(habitat.id.toString())}
                                                                />
                                                                {habitat.nombre}
                                                            </label>
                                                        ))}
                                                    </div>
                                                ) : (
                                                    <div className="alert alert-warning">
                                                        <i className="fas fa-exclamation-triangle me-2"></i>
                                                        No se pudieron cargar los hábitats
                                                    </div>
                                                )}
                                            </div>
                                        </div>
                                    </div>

                                    <div className="form-section">
                                        <div className="section-header">
                                            <div className="section-icon">
                                                <i className="fas fa-map-marker-alt"></i>
                                            </div>
                                            <h2 className="form-section-title">Ubicaciones</h2>
                                        </div>

                                        <div className="mb-4">
                                            <label htmlFor="ubicaciones" className="form-label">Selecciona las ubicaciones (mínimo 1)*</label>
                                            <div className="selector-container">
                                                {validationErrors.ubicaciones && (
                                                    <div className="invalid-feedback d-block mb-3">{validationErrors.ubicaciones}</div>
                                                )}

                                                {ubicaciones && ubicaciones.length > 0 ? (
                                                    <div className="checkbox-list">
                                                        {ubicaciones.map(ubicacion => (
                                                            <label
                                                                key={ubicacion.id}
                                                                className={`checkbox-item ${formData.ubicaciones.includes(ubicacion.id.toString()) ? 'selected' : ''}`}
                                                            >
                                                                <input
                                                                    type="checkbox"
                                                                    className="form-check-input"
                                                                    checked={formData.ubicaciones.includes(ubicacion.id.toString())}
                                                                    onChange={() => handleUbicacionChange(ubicacion.id.toString())}
                                                                />
                                                                {ubicacion.nombre}
                                                            </label>
                                                        ))}
                                                    </div>
                                                ) : (
                                                    <div className="alert alert-warning">
                                                        <i className="fas fa-exclamation-triangle me-2"></i>
                                                        No se pudieron cargar las ubicaciones
                                                    </div>
                                                )}
                                            </div>
                                        </div>
                                    </div>

                                    <div className="form-footer">
                                        <button type="submit" className="btn-submit" disabled={loading}>
                                            {loading ? (
                                                <>
                                                    <span className="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                                    Guardando...
                                                </>
                                            ) : (
                                                <>
                                                    <i className="fas fa-save me-2"></i>
                                                    Guardar Especie
                                                </>
                                            )}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default NuevaEspecie;