import React, { useState } from 'react';
import { Helmet } from 'react-helmet';
import axios from 'axios';
import './AdminPanel.css';

const AdminPanel = () => {
    const [formData, setFormData] = useState({
        nombre: '',
        apellidos: '',
        email: '',
        password: '',
        password_confirmation: '',
        rol: ''
    });

    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);
    const [success, setSuccess] = useState(false);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData({ ...formData, [name]: value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        setError(null);
        setSuccess(false);

        try {
            const response = await axios.post('https://juditlg25.iesmontenaranco.com:8000/api/register', formData);

            if (response.data.status) {
                setSuccess(true);
                setFormData({
                    nombre: '',
                    apellidos: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    rol: ''
                });
            }
        } catch (err) {
            if (err.response && err.response.data) {
                setError(err.response.data.message || 'Ha ocurrido un error al registrar el usuario');
            } else {
                setError('Error de conexión. Por favor, inténtalo de nuevo más tarde.');
            }
        } finally {
            setLoading(false);
        }
    };

    return (
        <div className="admin-panel">
            <Helmet>
                <title>Panel de Administración - NarancoBioExplorer</title>
            </Helmet>

            <div className="admin-background-shapes">
                <div className="shape shape-1"></div>
                <div className="shape shape-2"></div>
                <div className="shape shape-3"></div>
                <div className="shape shape-4"></div>
            </div>

            <div className="container py-5">
                <div className="row">
                    <div className="col-lg-3 mb-4">
                        <div className="card admin-sidebar shadow-sm">
                            <div className="card-body p-0">
                                <div className="admin-user-info p-4 text-center">
                                    <div className="admin-avatar">
                                        <i className="bi bi-person-circle"></i>
                                    </div>
                                    <h5 className="mt-3 mb-1">Panel de Administración</h5>
                                    <p className="text-muted small">NarancoBioExplorer</p>
                                </div>
                                <hr className="my-0" />
                                <ul className="list-group list-group-flush admin-menu">
                                    <li className="list-group-item active">
                                        <i className="bi bi-person-plus-fill me-2"></i>
                                        Registrar Usuario
                                    </li>
                                    <li className="list-group-item disabled">
                                        <i className="bi bi-people-fill me-2"></i>
                                        Gestionar Usuarios
                                    </li>
                                    <li className="list-group-item disabled">
                                        <i className="bi bi-file-earmark-text me-2"></i>
                                        Gestionar Publicaciones
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div className="col-lg-9">
                        <div className="card admin-content-card shadow">
                            <div className="card-header admin-card-header">
                                <h2 className="mb-3">Registrar Nuevo Usuario</h2>
                                <p className="mb-4">Crea cuentas para profesores y alumnos del IES Monte Naranco</p>
                            </div>
                            <div className="card-body pt-4">
                                {success && (
                                    <div className="alert alert-success d-flex align-items-center" role="alert">
                                        <i className="bi bi-check-circle-fill me-2"></i>
                                        <div>Usuario registrado correctamente.</div>
                                    </div>
                                )}

                                {error && (
                                    <div className="alert alert-danger d-flex align-items-center" role="alert">
                                        <i className="bi bi-exclamation-triangle-fill me-2"></i>
                                        <div>{error}</div>
                                    </div>
                                )}

                                <form onSubmit={handleSubmit}>
                                    <div className="row mb-4">
                                        <div className="col-md-6">
                                            <div className="form-floating mb-3">
                                                <input
                                                    type="text"
                                                    className="form-control"
                                                    id="nombre"
                                                    name="nombre"
                                                    value={formData.nombre}
                                                    onChange={handleChange}
                                                    placeholder="Nombre"
                                                    required
                                                />
                                                <label htmlFor="nombre">Nombre</label>
                                            </div>
                                        </div>
                                        <div className="col-md-6">
                                            <div className="form-floating mb-3">
                                                <input
                                                    type="text"
                                                    className="form-control"
                                                    id="apellidos"
                                                    name="apellidos"
                                                    value={formData.apellidos}
                                                    onChange={handleChange}
                                                    placeholder="Apellidos"
                                                    required
                                                />
                                                <label htmlFor="apellidos">Apellidos</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div className="form-floating mb-4">
                                        <input
                                            type="email"
                                            className="form-control"
                                            id="email"
                                            name="email"
                                            value={formData.email}
                                            onChange={handleChange}
                                            placeholder="correo@ejemplo.com"
                                            required
                                        />
                                        <label htmlFor="email">Correo Electrónico</label>
                                        <div className="form-text mt-2">
                                            Preferentemente usar el correo institucional (@educastur.es)
                                        </div>
                                    </div>

                                    <div className="row mb-4">
                                        <div className="col-md-6">
                                            <div className="form-floating mb-3">
                                                <input
                                                    type="password"
                                                    className="form-control"
                                                    id="password"
                                                    name="password"
                                                    value={formData.password}
                                                    onChange={handleChange}
                                                    placeholder="Contraseña"
                                                    required
                                                />
                                                <label htmlFor="password">Contraseña</label>
                                            </div>
                                        </div>
                                        <div className="col-md-6">
                                            <div className="form-floating mb-3">
                                                <input
                                                    type="password"
                                                    className="form-control"
                                                    id="password_confirmation"
                                                    name="password_confirmation"
                                                    value={formData.password_confirmation}
                                                    onChange={handleChange}
                                                    placeholder="Confirmar Contraseña"
                                                    required
                                                />
                                                <label htmlFor="password_confirmation">Confirmar Contraseña</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div className="form-floating mb-4">
                                        <select
                                            className="form-select"
                                            id="rol"
                                            name="rol"
                                            value={formData.rol}
                                            onChange={handleChange}
                                            required
                                        >
                                            <option value="" disabled>Seleccione un rol</option>
                                            <option value="alumno">Alumno</option>
                                            <option value="profesor">Profesor</option>
                                            <option value="admin">Administrador</option>
                                        </select>
                                        <label htmlFor="rol">Rol</label>
                                    </div>

                                    <div className="d-grid gap-2 mt-5">
                                        <button
                                            type="submit"
                                            className="btn btn-primary btn-lg admin-submit-btn"
                                            disabled={loading}
                                        >
                                            {loading ? (
                                                <>
                                                    <span className="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                                    Registrando...
                                                </>
                                            ) : (
                                                'Registrar Usuario'
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

export default AdminPanel;