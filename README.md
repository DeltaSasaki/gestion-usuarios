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
