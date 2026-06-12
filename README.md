# backend-restaurante-1.1
# Sistema de Gestión de Restaurante basado en Microservicios

## Descripción

Sistema web para la administración de un restaurante desarrollado bajo una arquitectura basada en microservicios.

El sistema permite:

* Autenticación de usuarios.
* Gestión de productos.
* Gestión de reservas.
* Gestión de pedidos.
* Administración desde una interfaz web.

Cada microservicio posee su propia base de datos, conexión independiente y expone APIs REST que retornan respuestas en formato JSON.

---

# Arquitectura del Sistema

La comunicación se realiza únicamente entre el frontend y los microservicios.

```text
Frontend
    │
    ├── ms-auth      (Puerto 8000)
    ├── ms-reservas  (Puerto 8001)
    ├── ms-productos (Puerto 8002)
    └── ms-pedidos   (Puerto 8003)
```

Cada microservicio posee:

* Base de datos independiente.
* Configuración independiente.
* API REST independiente.
* Middleware de autenticación.

---

# Tecnologías Utilizadas

## Backend

* PHP 8
* Slim Framework 4
* Composer
* Eloquent ORM
* MySQL

## Frontend

* HTML5
* CSS3
* JavaScript

## Control de Versiones

* Git
* GitHub

---

# Requisitos

Instalar previamente:

* XAMPP
* PHP 8 o superior
* Composer
* Git
* Navegador Web

Verificar instalación:

```powershell
php -v

composer -V

git --version
```

---

# Estructura del Proyecto

```text
backend-restaurante-1.1
│
├── ms-auth
├── ms-reservas
├── ms-productos
└── ms-pedidos

frontend-restaurante-1.1
│
├── css
├── js
├── login.html
├── dashboard.html
├── productos.html
├── reservas.html
└── pedidos.html
```

---

# Instalación y Ejecución

## 1. Clonar los repositorios

### Backend

```powershell
cd C:\xampp\htdocs

git clone URL_BACKEND

cd backend-restaurante-1.1
```

### Frontend

```powershell
cd C:\xampp\htdocs

git clone URL_FRONTEND

cd frontend-restaurante-1.1
```

---

## 2. Crear las bases de datos

Abrir phpMyAdmin y crear:

```text
db_auth
db_reservas
db_productos
db_pedidos
```

Importar los scripts SQL correspondientes.

---

## 3. Instalar dependencias

### ms-auth

```powershell
cd C:\xampp\htdocs\backend-restaurante-1.1\ms-auth

composer install
```

### ms-reservas

```powershell
cd C:\xampp\htdocs\backend-restaurante-1.1\ms-reservas

composer install
```

### ms-productos

```powershell
cd C:\xampp\htdocs\backend-restaurante-1.1\ms-productos

composer install
```

### ms-pedidos

```powershell
cd C:\xampp\htdocs\backend-restaurante-1.1\ms-pedidos

composer install
```

---

## 4. Configurar archivo .env

Crear un archivo `.env` en cada microservicio.

Ejemplo:

```env
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=db_auth
DB_USERNAME=root
DB_PASSWORD=
```

Modificar únicamente el nombre de la base de datos según el microservicio.

---

## 5. Ejecutar los microservicios

Abrir cuatro terminales PowerShell.

### Terminal 1 - ms-auth

```powershell
cd C:\xampp\htdocs\backend-restaurante-1.1\ms-auth

php -S localhost:8000 -t public
```

### Terminal 2 - ms-reservas

```powershell
cd C:\xampp\htdocs\backend-restaurante-1.1\ms-reservas

php -S localhost:8001 -t public
```

### Terminal 3 - ms-productos

```powershell
cd C:\xampp\htdocs\backend-restaurante-1.1\ms-productos

php -S localhost:8002 -t public
```

### Terminal 4 - ms-pedidos

```powershell
cd C:\xampp\htdocs\backend-restaurante-1.1\ms-pedidos

php -S localhost:8003 -t public
```

---

## 6. Ejecutar el Frontend

Abrir una quinta terminal.

```powershell
cd C:\xampp\htdocs\frontend-restaurante-1.1

php -S localhost:3000
```

Abrir en el navegador:

```text
http://localhost:3000/login.html
```

---

# APIs REST

## Autenticación

```http
POST /api/login

POST /api/logout
```

## Mesas

```http
GET /api/mesas

POST /api/mesas

PUT /api/mesas/{id}

DELETE /api/mesas/{id}
```

## Reservas

```http
GET /api/reservas

POST /api/reservas

PUT /api/reservas/{id}

DELETE /api/reservas/{id}
```

## Productos

```http
GET /api/productos

POST /api/productos

PUT /api/productos/{id}

DELETE /api/productos/{id}
```

## Pedidos

```http
GET /api/pedidos

POST /api/pedidos

PUT /api/pedidos/{id}

DELETE /api/pedidos/{id}
```

## Detalles de Pedido

```http
GET /api/detalles

POST /api/detalles
```

---

# Funcionalidades Implementadas

* Inicio de sesión.
* Gestión de productos.
* Gestión de reservas.
* Gestión de pedidos.
* Middleware de autenticación.
* Manejo de tokens.
* APIs REST.
* Respuestas JSON.
* Arquitectura basada en microservicios.
* Frontend independiente.
* Configuración CORS.

---

# Notas Importantes

La carpeta:

```text
vendor/
```

no se encuentra incluida en el repositorio.

Después de clonar el proyecto es obligatorio ejecutar:

```powershell
composer install
```

en cada microservicio para descargar las dependencias necesarias.

---

# Autor

Karen Lucía Nieto Hernández

Ingeniería de Sistemas

Universidad de Boyacá
