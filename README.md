<<<<<<< HEAD
<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="350" alt="Laravel Logo">
</p>

<h1 align="center">Prueba Técnica Backend PHP: Gestión de Usuarios + Autenticación JWT</h1>

<p align="center">
  <b>API RESTful construida con Laravel 12 para la gestión de usuarios y autenticación segura con JWT (Sanctum).</b>
</p>

---

## 🚀 Funcionalidades Principales

| Endpoint         | Método | Descripción                                                                 | Autenticación | Rol requerido |
|------------------|--------|-----------------------------------------------------------------------------|---------------|--------------|
| `/register`      | POST   | Registro de usuario (name, email, password, password_confirmation)           | ❌            | -            |
| `/login`         | POST   | Login de usuario (email, password)                                          | ❌            | -            |
| `/profile`       | GET    | Perfil del usuario autenticado                                              | ✅ Bearer      | user/admin   |
| `/users`         | GET    | Listado paginado de usuarios (parámetros: page, limit)                      | ✅ Bearer      | admin        |
| `/logout`        | POST   | Cierre de sesión (invalida el token actual)                                 | ✅ Bearer      | user/admin   |

---

## ✨ Características Destacadas

- **Validación robusta** en registro (email único, contraseña segura y confirmada)
- **Hasheo seguro** de contraseñas (`Hash::make()`)
- **Autenticación JWT** con Laravel Sanctum
- **Roles**: usuario (`user`) y administrador (`admin`)
- **Middleware personalizado** para rutas protegidas y acceso de admin
- **Paginación** configurable en `/users`
- **Rate limiting**: 60 peticiones/minuto en endpoints públicos
- **Estructura MVC** limpia y mantenible

---

## 💾 Persistencia de Datos

- **Base de datos:** MySQL (compatible con SQLite)
- **Tabla `users`:**
  - `id`, `name`, `email` (único), `password`, `role` (`user`/`admin`), `created_at`, `updated_at`

---

## 🛠️ Tecnologías Utilizadas

- PHP 8+
- Laravel 12
- Laravel Sanctum (JWT)
- MySQL / SQLite
- Postman (pruebas de API)
- XAMPP (entorno local)

---

## ⚡ Instalación y Puesta en Marcha

1. **Clona el repositorio**
   ```bash
   git clone https://github.com/tu-usuario/gestion-usuarios.git
   cd gestion-usuarios
   ```

2. **Configura el entorno**
   ```bash
   cp .env.example .env
   # Edita .env con tus credenciales de base de datos
   ```

   Ejemplo de configuración en `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=gestion_usuarios_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

   > **Nota:** Crea la base de datos `gestion_usuarios_db` en tu gestor (ej. phpMyAdmin).

3. **Instala dependencias**
   ```bash
   composer install
   ```

4. **Genera la clave de aplicación**
   ```bash
   php artisan key:generate
   ```

5. **Instala Sanctum y ejecuta migraciones**
   ```bash
   php artisan install:api
   php artisan migrate
   # Si necesitas limpiar y poblar datos de prueba:
   php artisan migrate:fresh --seed
   ```

6. **Configura middlewares (Laravel 11+)**
   Asegúrate de registrar el middleware `admin` en `bootstrap/app.php`:
   ```php
   // bootstrap/app.php
   ->withMiddleware(function (Middleware $middleware) {
       $middleware->api(prepend: [
           \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
       ]);
       $middleware->alias([
           'admin' => \App\Http\Middleware\AdminMiddleware::class,
       ]);
   })
   ```

7. **Inicia el servidor**
   ```bash
   php artisan serve
   ```
   Accede a la API en [http://127.0.0.1:8000/api](http://127.0.0.1:8000/api)

---

## 🧪 Pruebas Rápidas con Postman

> **URL base:** `http://127.0.0.1:8000/api`

### 1. Registrar usuario

- **POST** `/register`
- **Body (JSON):**
  ```json
  {
    "name": "Lisandro Corro",
    "email": "lisandro.corro@example.com",
    "password": "PasswordSeguro123",
    "password_confirmation": "PasswordSeguro123"
  }
  ```
- **Respuesta:** 201 Created + `access_token`

### 2. Login

- **POST** `/login`
- **Body (JSON):**
  ```json
  {
    "email": "lisandro.corro@example.com",
    "password": "PasswordSeguro123"
  }
  ```
- **Respuesta:** 200 OK + `access_token`

### 3. Perfil de usuario

- **GET** `/profile`
- **Headers:** `Authorization: Bearer <access_token>`
- **Respuesta:** 200 OK + datos del usuario

### 4. Listar usuarios (solo admin)

- **GET** `/users?page=1&limit=5`
- **Headers:** `Authorization: Bearer <access_token_admin>`
- **Respuesta:** 200 OK + paginación de usuarios

> ⚠️ Para convertir un usuario en admin, edita el campo `role` en la tabla `users` a `admin` y vuelve a loguearte.

### 5. Logout

- **POST** `/logout`
- **Headers:** `Authorization: Bearer <access_token>`
- **Respuesta:** 200 OK + mensaje de éxito

---

## 🔒 Seguridad

- **Protección de rutas** con middleware `auth:sanctum` y `admin`
- **Rate limiting** en endpoints públicos
- **Contraseñas hasheadas** y tokens seguros

---

## 📄 Licencia

Este proyecto está bajo licencia [MIT](https://opensource.org/licenses/MIT).

---

<p align="center">
  <b>Desarrollado por Lisandro Corro</b>
</p>
=======
Prueba Técnica Backend PHP: Gestión de Usuarios + Autenticación JWT
Este proyecto es una API RESTful construida con Laravel 12 que permite la gestión de usuarios, incluyendo registro, autenticación mediante tokens (implementado con Laravel Sanctum), consulta de perfil de usuario y un listado paginado de usuarios accesible solo para administradores.

El objetivo de esta prueba es evaluar la lógica de backend, la seguridad básica, la persistencia de datos y la estructuración de endpoints, utilizando el framework Laravel.

🚀 Funcionalidades Implementadas
Endpoints Obligatorios
POST /register: Registra un nuevo usuario en el sistema.

Parámetros (JSON Body): name, email, password, password_confirmation.

Respuesta Exitosa: 201 Created con un token de acceso (access_token).

POST /login: Autentica a un usuario existente.

Parámetros (JSON Body): email, password.

Respuesta Exitosa: 200 OK con un nuevo token de acceso (access_token).

GET /profile: Devuelve la información del usuario actualmente autenticado.

Requiere Autenticación: Token "Bearer" en el encabezado Authorization.

Respuesta Exitosa: 200 OK con los datos del usuario.

GET /users?page=n: Lista todos los usuarios del sistema de forma paginada.

Requiere Autenticación: Token "Bearer" en el encabezado Authorization.

Requiere Rol: Solo accesible para usuarios con el rol admin.

Parámetros (Query): page (número de página, ej. ?page=1), limit (cantidad de usuarios por página, ej. ?limit=10).

Respuesta Exitosa: 200 OK con un objeto de paginación de Laravel.

Puntos Adicionales (Extras)
Se han implementado las siguientes características para un puntaje adicional:

Validación de datos en registro: El endpoint POST /register valida que el email sea único y válido, y que la contraseña cumpla con requisitos de seguridad (mínimo 8 caracteres y confirmación).

Hasheo de contraseña: Las contraseñas se almacenan de forma segura utilizando Hash::make() de Laravel (que internamente usa password_hash()).

Middleware para verificar JWT en rutas protegidas: Se utiliza el middleware auth:sanctum para proteger las rutas que requieren autenticación.

Roles: Se distingue entre usuarios normales (user) y administradores (admin) mediante un campo role en la tabla users. La ruta GET /users está protegida por un middleware admin personalizado.

Paginación: La ruta GET /users soporta paginación con parámetros de query page y limit.

Estructura MVC: El proyecto sigue la estructura Model-View-Controller de Laravel, con controladores dedicados (AuthController, UserController) y un modelo (User).

Rate Limiting (Límite de Peticiones): Se ha implementado un límite de 60 peticiones por minuto para los endpoints públicos (/register, /login) para prevenir ataques de fuerza bruta, utilizando el middleware throttle:60,1.

💾 Persistencia de Datos
Base de Datos: MySQL (compatible con SQLite).

Tabla users: Contiene los campos id, name, email (único), password_hash (almacenado por Laravel), role (con valor por defecto user), created_at, updated_at.

🛠️ Tecnologías Utilizadas
PHP

Laravel 12

Laravel Sanctum (para autenticación de API)

MySQL (o SQLite)

Postman (para pruebas de API)

XAMPP (para entorno de desarrollo local con Apache y MySQL)

🚀 Cómo Correr el Proyecto
Sigue estos pasos para configurar y ejecutar el proyecto en tu máquina local:

1. Clonar el Repositorio
Abre tu terminal y clona el repositorio de GitHub:

git clone https://github.com/tu-usuario/gestion-usuarios.git # Reemplaza con la URL de tu repo
cd gestion-usuarios

2. Configuración del Entorno
Archivo .env: Copia el archivo .env.example y renómbralo a .env:

cp .env.example .env

Configurar Base de Datos: Abre el archivo .env y configura tus credenciales de MySQL (o SQLite si prefieres):

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_usuarios_db  # ¡Crea esta BD en phpMyAdmin!
DB_USERNAME=root
DB_PASSWORD=

Asegúrate de crear la base de datos (gestion_usuarios_db) en tu servidor MySQL (ej. usando phpMyAdmin en XAMPP).

3. Instalar Dependencias
Instala las dependencias de Composer:

composer install

4. Generar Clave de Aplicación
Genera la clave de aplicación de Laravel (necesaria para la encriptación):

php artisan key:generate

5. Instalar Scaffolding de API y Migraciones
Instala Laravel Sanctum y ejecuta las migraciones para crear las tablas de la base de datos, incluyendo la tabla users con el campo role:

php artisan install:api
php artisan migrate

Si ya tienes usuarios de pruebas y quieres refrescar la base de datos para incluir el campo role y limpiar datos, puedes usar:

php artisan migrate:fresh --seed # --seed si tienes seeders para crear datos de prueba

6. Configurar Middleware (Laravel 11+)
En Laravel 11, el registro de middlewares se hace en bootstrap/app.php. Asegúrate de que tu AdminMiddleware esté registrado.

Abre bootstrap/app.php y verifica que la sección withMiddleware se vea así:

// bootstrap/app.php
->withMiddleware(function (Middleware $middleware) {
    $middleware->api(prepend: [
        \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    ]);

    $middleware->alias([
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ]);
})

7. Iniciar el Servidor de Desarrollo
Inicia el servidor de desarrollo de Laravel:

php artisan serve

El servidor estará disponible en http://127.0.0.1:8000. Todas las rutas de la API tendrán el prefijo /api/.

🧪 Cómo Probar la API con Postman
Abre Postman e importa las siguientes peticiones (o créalas manualmente). La URL base para todas las peticiones es http://127.0.0.1:8000/api.

1. Registrar un Usuario (POST /register)
Método: POST

URL: http://127.0.0.1:8000/api/register

Headers: Content-Type: application/json

Body (raw - JSON):

{
  "name": "Lisandro Corro",
  "email": "lisandro.corro@example.com",
  "password": "PasswordSeguro123",
  "password_confirmation": "PasswordSeguro123"
}

Resultado esperado: 201 Created con un access_token. Guarda este token.

2. Iniciar Sesión (POST /login)
Método: POST

URL: http://127.0.0.1:8000/api/login

Headers: Content-Type: application/json

Body (raw - JSON):

{
  "email": "lisandro.corro@example.com",
  "password": "PasswordSeguro123"
}

Resultado esperado: 200 OK con un nuevo access_token. Guarda este nuevo token.

3. Obtener Perfil de Usuario (GET /profile)
Método: GET

URL: http://127.0.0.1:8000/api/profile

Headers:

Authorization: Bearer <el_token_obtenido_en_login_o_register>

Resultado esperado: 200 OK con los datos del usuario autenticado.

4. Listar Usuarios (GET /users?page=1)
Esta ruta requiere un usuario con rol admin.

Paso 4.1: Convertir un usuario a admin

Accede a tu base de datos (ej. phpMyAdmin).

En la tabla users, busca el usuario que deseas convertir en administrador (ej. lisandro.corro@example.com).

Cambia el valor de la columna role de user a admin.

Vuelve a Postman y realiza un POST /login con las credenciales de este usuario para obtener un nuevo token que refleje su rol de administrador.

Paso 4.2: Realizar la petición GET /users

Método: GET

URL: http://127.0.0.1:8000/api/users?page=1 (puedes añadir &limit=5 para probar el límite de paginación)

Headers:

Authorization: Bearer <el_token_del_usuario_admin>

Resultado esperado: 200 OK con una lista paginada de todos los usuarios.

Prueba de seguridad: Si intentas esta petición con un token de un usuario con rol user, recibirás un 403 Forbidden ({"error": "Unauthorized. Admin access required."}).

5. Cerrar Sesión (POST /logout)
Método: POST

URL: http://127.0.0.1:8000/api/logout

Headers:

Authorization: Bearer <el_token_activo_del_usuario>

Resultado esperado: 200 OK con un mensaje de éxito ({"message": "Sesión cerrada exitosamente"}). El token usado quedará invalidado.

¡Listo! Con este README.md, tu proyecto estará perfectamente docume
>>>>>>> 9f6ee0e56fc6cc824ae93a5d624cfb5de71899c6
