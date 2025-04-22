import './App.css'
import AppRoutes from './routes/AppRoutes'
import { Helmet } from 'react-helmet'

function App() {
  return (
    <>
      <Helmet defaultTitle="NarancoBioExplorer" titleTemplate="NarancoBioExplorer - %s" />
      <AppRoutes />
    </>
  )
}

export default App