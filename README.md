
# LogTest

Pagina de inicio de sesión y registro con Laravel Sanctum y VueJs
Necesitas tener instalado:
- Php
- Node.js
- Tener un servicio de MySQL corriendo (XAMPP, Laragon)
## Instalación

Para poder hacer uso de este proyecto:
- Clonar/Descargar el proyecto en tu maquina local
```bash
  git clone https://github.com/jose1500s/LogTest
```
- navegar hacia la raiz del proyecto y instalar las dependencias del backend
```bash
  cd LogTest
  composer install
```
- asi mismo instalar las del frontend
```bash
  npm install
```
- Configurar Entorno (.env), verificar el archivo .env y verificar que los parametros esten correctos

```bash
  cp .env.example .env
```
- Generar la clave de la aplicación

```bash
  php artisan key:generate
```
- Generar la base de datos y sus migraciones

```bash
  php artisan migrate
```
    
## 🚀 Deployment

Levantar servidor backend (Laravel)

```bash
  php artisan serve
```
Levantar servidor Frontend (VueJS y Vite)

```bash
  npm run dev
```
La aplicación podra ser vista en http://localhost:8000/login

## API Reference

#### Registrarse

```http
  POST http://localhost:8000/api/register
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Required**.  |
| `email` | `string` | **Required**. |
| `password` | `string` | **Required**. |

#### Login

```http
  POST http://localhost:8000/api/login
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email`      | `string` | **Required**. |
| `password`      | `string` | **Required**. |

## Archivos importantes a tener en cuenta:

- Api.php > contiene las rutas y el controlador que usan.
- AuthController.php > contiene las funciones del backend para iniciar sesion o registrarse.
- .env >  contiene la configuración para la conexión a base de datos, entre otras.
- Login.vue y Register.vue > componentes principales de la App.
- Axios.js > Centraliza la configuración de Axios para todas las peticiones a la API.

