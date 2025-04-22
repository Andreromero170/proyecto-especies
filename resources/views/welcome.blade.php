<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NarancoBioExplorer - API Documentación</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-white text-white">
  <div class="container mx-auto p-5">
    <div class="flex justify-end space-x-4 mt-4 mb-10">
      @auth
        <div class="flex items-center space-x-2">
          <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-lg hover:bg-green-700 flex items-center">
              <i class="fas fa-sign-out-alt w-5 h-5 mr-2"></i> Log Out
            </button>
          </form>
          <a href="{{ url('/dashboard') }}" class="bg-green-800 text-white py-2 px-4 rounded-lg hover:bg-green-700 flex items-center">
            <i class="fas fa-key w-5 h-5 mr-2"></i> Tokens
          </a>
        </div>
      @else
        <a href="/login" class="bg-green-800 text-white py-2 px-4 rounded-lg hover:bg-green-700 flex items-center">
          <i class="fas fa-sign-in-alt w-5 h-5 mr-2"></i> Login
        </a>
      @endauth
      <a href="{{ url('/swagger') }}" target="_blank" class="bg-green-800 text-white py-2 px-4 rounded-lg hover:bg-green-700 flex items-center">
        <button>
          <i class="fas fa-book w-5 h-5 mr-2"></i>Swagger
        </button>
      </a>
    </div>

    <h1 class="text-8xl font-bold text-center text-green-800">NarancoBioExplorer</h1>
    <h3 class="text-2xl font-bold text-center text-green-700 p-6">API DOCUMENTACIÓN</h3>
    <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-6">
        <!-- Taxonomía -->
        <div class="p-6 bg-green-500 rounded-lg shadow-lg text-center">
            <div class="text-6xl">
            <i class="fas fa-file-alt mx-auto"></i>
            </div>
            <h2 class="mt-4 text-2xl font-semibold text-white">Taxonomía</h2>
            <p class="text-white">Consulta de taxonomías</p>
        </div>
        <!-- Especies -->
        <div class="p-6 bg-green-500 rounded-lg shadow-lg text-center">
            <div class="text-6xl">
            <i class="fas fa-virus mx-auto"></i>
            </div>
            <h2 class="mt-4 text-2xl font-semibold text-white">Especies</h2>
            <p class="text-white">Consulta de especies</p>
        </div>
        <!-- Usuarios -->
        <div class="p-6 bg-green-500 rounded-lg shadow-lg text-center">
            <div class="text-6xl">
            <i class="fas fa-users mx-auto"></i>
            </div>
            <h2 class="mt-4 text-2xl font-semibold text-white">Usuarios</h2>
            <p class="text-white">Consulta de usuarios</p>
        </div>
        <!-- Revisiones -->
        <div class="p-6 bg-green-500 rounded-lg shadow-lg text-center">
            <div class="text-6xl">
            <i class="fas fa-comments mx-auto"></i>
            </div>
            <h2 class="mt-4 text-2xl font-semibold text-white">Revisiones</h2>
            <p class="text-white">Consulta de revisiones</p>
        </div>
        </div>
  </div>

  <div class="container mx-auto p-5 mb-10">
    <h2 class="mt-12 text-3xl font-bold text-green-700 text-center">Endpoints</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6 mb-8">
      <!-- Taxonomía -->
      <div class="p-6 bg-green-900 rounded-lg shadow-lg">
        <h3 class="text-xl font-bold text-white text-center">Taxonomía</h3>
        <ul class="mt-4 space-y-2">
        <li class="bg-green-400 p-2 rounded transition duration-300 ease-in-out hover:bg-green-600">
        <span class="text-white block">
            <span class="text-white">GET</span> /api/taxonomias - Listar todas las taxonomías
        </span>
        </li>
        <li class="bg-green-400 p-2 rounded transition duration-300 ease-in-out hover:bg-green-600">
        <span class="text-white block">
            <span class="text-white">GET</span> /api/taxonomias/{taxonomia} - Mostrar una taxonomía
        </span>
        </li>
        <li class="bg-green-400 p-2 rounded transition duration-300 ease-in-out hover:bg-green-600">
        <span class="text-white block">
            <span class="text-white">GET</span> /api/taxonomias/familia/{familia} - Filtrar por familia
        </span>
        </li>
        <li class="bg-green-400 p-2 rounded transition duration-300 ease-in-out hover:bg-green-600">
        <span class="text-white block">
            <span class="text-white">GET</span> /api/taxonomias/orden/{orden} - Filtrar por orden
        </span>
        </li>
        <li class="bg-green-400 p-2 rounded transition duration-300 ease-in-out hover:bg-green-600">
        <span class="text-white block">
            <span class="text-white">GET</span> /api/taxonomias/{slug}/especies - Especies por taxonomía
        </span>
        </li>
        <li class="bg-blue-400 p-2 rounded transition duration-300 ease-in-out hover:bg-blue-600">
        <span class="text-white block">
            <span class="text-white">POST</span> /api/taxonomias - Crear nueva taxonomía
        </span>
        </li>
        <li class="bg-yellow-400 p-2 rounded transition duration-300 ease-in-out hover:bg-yellow-600">
        <span class="text-white block">
            <span class="text-white">PUT</span> /api/taxonomias/{taxonomia} - Actualizar taxonomía
        </span>
        </li>
        <li class="bg-red-400 p-2 rounded transition duration-300 ease-in-out hover:bg-red-600">
        <span class="text-white block">
            <span class="text-white">DELETE</span> /api/taxonomias/{taxonomia} - Eliminar taxonomía
        </span>
        </li>
        </ul>
      </div>

      <!-- Especies -->
      <div class="p-6 bg-green-900 rounded-lg shadow-lg">
        <h3 class="text-xl font-bold text-white text-center">Especies</h3>
        <ul class="mt-4 space-y-2">
        <li class="bg-green-400 p-2 rounded transition duration-300 ease-in-out hover:bg-green-600">
        <span class="text-white block">
            <span class="text-white">GET</span> /api/especies - Listar todas las especies
        </span>
        </li>
        <li class="bg-green-400 p-2 rounded transition duration-300 ease-in-out hover:bg-green-600">
        <span class="text-white block">
            <span class="text-white">GET</span> /api/especies/todas-especies-aprobadas - Listar especies aprobadas
        </span>
        </li>
        <li class="bg-green-400 p-2 rounded transition duration-300 ease-in-out hover:bg-green-600">
        <span class="text-white block">
            <span class="text-white">GET</span> /api/especies/usuario/{codigo_usuario} - Especies por alumno
        </span>
        </li>
        <li class="bg-green-400 p-2 rounded transition duration-300 ease-in-out hover:bg-green-600">
        <span class="text-white block">
            <span class="text-white">GET</span> /api/especies/{especie} - Mostrar una especie
        </span>
        </li>
        <li class="bg-green-400 p-2 rounded transition duration-300 ease-in-out hover:bg-green-600">
        <span class="text-white block">
            <span class="text-white">GET</span> /api/especies/estado/{estado} - Filtrar especies por estado
        </span>
        </li>
        <li class="bg-blue-400 p-2 rounded transition duration-300 ease-in-out hover:bg-blue-600">
        <span class="text-white block">
            <span class="text-white">POST</span> /api/especies - Crear nueva especie
        </span>
        </li>
        <li class="bg-yellow-400 p-2 rounded transition duration-300 ease-in-out hover:bg-yellow-600">
        <span class="text-white block">
            <span class="text-white">PUT</span> /api/especies/{especie} - Actualizar especie
        </span>
        </li>
        <li class="bg-red-400 p-2 rounded transition duration-300 ease-in-out hover:bg-red-600">
        <span class="text-white block">
            <span class="text-white">DELETE</span> /api/especies/{especie} - Eliminar especie
        </span>
        </li>
        </ul>
      </div>

      <!-- Usuarios -->
      <div class="p-6 bg-green-900 rounded-lg shadow-lg">
        <h3 class="text-xl font-bold text-white text-center">Usuarios</h3>
        <ul class="mt-4 space-y-2">
        <li class="bg-green-400 p-2 rounded transition duration-300 ease-in-out hover:bg-green-600">
        <span class="text-white block">
            <span class="text-white">GET</span> /api/usuarios - Listar todos los usuarios
        </span>
        </li>
        <li class="bg-green-400 p-2 rounded transition duration-300 ease-in-out hover:bg-green-600">
        <span class="text-white block">
            <span class="text-white">GET</span> /api/usuarios/{usuario} - Obtener usuario
        </span>
        </li>
        <li class="bg-green-400 p-2 rounded transition duration-300 ease-in-out hover:bg-green-600">
        <span class="text-white block">
            <span class="text-white">GET</span> /api/usuarios/alumnos_mas_publicaciones - Alumnos con más publicaciones
        </span>
        </li>
        <li class="bg-green-400 p-2 rounded transition duration-300 ease-in-out hover:bg-green-600">
        <span class="text-white block">
            <span class="text-white">GET</span> /api/usuarios/{codigo_usuario}/especies - Especies por usuario
        </span>
        </li>
        <li class="bg-blue-400 p-2 rounded transition duration-300 ease-in-out hover:bg-blue-600">
        <span class="text-white block">
            <span class="text-white">POST</span> /api/usuarios - Registrar nuevo usuario
        </span>
        </li>
        <li class="bg-yellow-400 p-2 rounded transition duration-300 ease-in-out hover:bg-yellow-600">
        <span class="text-white block">
            <span class="text-white">PUT</span> /api/usuarios/{usuario} - Actualizar usuario
        </span>
        </li>
        <li class="bg-red-400 p-2 rounded transition duration-300 ease-in-out hover:bg-red-600">
        <span class="text-white block">
            <span class="text-white">DELETE</span> /api/usuarios/{codigo_usuario} - Eliminar usuario
        </span>
        </li>
        </ul>
      </div>

      <!-- Revisiones -->
      <div class="p-6 bg-green-900 rounded-lg shadow-lg">
        <h3 class="text-xl font-bold text-white text-center">Revisiones</h3>
        <ul class="mt-4 space-y-2">
        <li class="bg-green-400 p-2 rounded transition duration-300 ease-in-out hover:bg-green-600">
            <span class="text-white">GET</span> /api/revisiones - Listar todas las revisiones
        </li>
        <li class="bg-green-400 p-2 rounded transition duration-300 ease-in-out hover:bg-green-600">
            <span class="text-white">GET</span> /api/revisiones/{id} - Obtener revisión
        </li>
        <li class="bg-green-400 p-2 rounded transition duration-300 ease-in-out hover:bg-green-600">
            <span class="text-white">GET</span> /api/revisiones/estado/{estado} - Filtrar por estado
        </li>
        <li class="bg-green-400 p-2 rounded transition duration-300 ease-in-out hover:bg-green-600">
            <span class="text-white">GET</span> /api/revisiones/alumno/{codigo_usuario} - Revisiones por alumno
        </li>
        <li class="bg-green-400 p-2 rounded transition duration-300 ease-in-out hover:bg-green-600">
            <span class="text-white">GET</span> /api/revisiones/profesor/{codigo_usuario} - Revisiones por profesor
        </li>
        <li class="bg-blue-400 p-2 rounded transition duration-300 ease-in-out hover:bg-blue-600">
            <span class="text-white">POST</span> /api/revisiones - Crear nueva revisión
        </li>
        <li class="bg-yellow-400 p-2 rounded transition duration-300 ease-in-out hover:bg-yellow-600">
            <span class="text-white">PUT</span> /api/revisiones/{id} - Actualizar revisión
        </li>
        <li class="bg-red-400 p-2 rounded transition duration-300 ease-in-out hover:bg-red-600">
            <span class="text-white">DELETE</span> /api/revisiones/{id} - Eliminar revisión
        </li>
        </ul>
      </div>
    </div>
  </div>
</body>
</html>
