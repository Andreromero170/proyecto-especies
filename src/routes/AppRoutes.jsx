import React from 'react';
import { Routes, Route } from 'react-router-dom';
import Home from '../pages/Home';
import Flora from '../pages/Flora';
import Fauna from '../pages/Fauna';
import Layout from '../components/Layout';
import Login from '../pages/Login';
import AdminPanel from '../pages/AdminPanel';
import NuevaEspecie from '../pages/NuevaEspecie';

const AppRoutes = () => {
  return (
    <>
      <Routes>
        <Route path="/login" element={<Login />} />

        <Route element={<Layout />}>
          <Route path="/" element={<Home />} />
          <Route path="/flora" element={<Flora />} />
          <Route path="/fauna" element={<Fauna />} />
          <Route path="/about" element={<div>Página en desarollo</div>} />
          <Route path="/admin" element={<AdminPanel />} />
          <Route path="/nueva-especie" element={<NuevaEspecie />} />
        </Route>
      </Routes>
    </>
  );
};

export default AppRoutes;