# EventHub Solutions API - Taller de Autenticación y Autorización UNAB

API RESTful desarrollada en Laravel para la gestión de eventos, implementando autenticación sin estado con Laravel Sanctum, autorización de recursos mediante Policies y control de acceso administrativo mediante Gates.

---

## Requisitos del Entorno
- Docker / Laravel Sail
- PHP 8.2+
- Composer

---

## Instrucciones de Instalación y Ejecución

1. **Clonar el repositorio:**
   ```bash
   git clone <TU_URL_DE_GITHUB>
   cd clase_backend

2. **Levantar los servicios con Laravel Sail:**
./vendor/bin/sail up -d

3. **Ejecutar migraciones y poblar la base de datos (Seeders):**
./vendor/bin/sail artisan migrate:fresh --seed

## Usuarios de Prueba (Seeders)

* Admin Global
  - Rol: Admin
  - Email: admin@eventhub.com
  - Contraseña: password
  - Permisos / Acceso: Acceso total + Métricas

* Organizador A
  - Rol: Organizador
  - Email: organizadorA@eventhub.com
  - Contraseña: password
  - Permisos / Acceso: Creador/Dueño del Evento 1 (Propietario)

* Organizador B
  - Rol: Organizador
  - Email: organizadorB@eventhub.com
  - Contraseña: password
  - Permisos / Acceso: Sin permisos para editar Evento 1

* Asistente Juan
  - Rol: Asistente
  - Email: asistente@eventhub.com
  - Contraseña: password
  - Permisos / Acceso: Acceso básico

## Endpoints de la API

### Módulo 1: Identidad y Autenticación
- POST /api/login: Iniciar sesión y obtener token Bearer de Sanctum.
- GET /api/perfil: Consultar datos del usuario autenticado (Protegido por Sanctum).

### Módulo 2: Catálogo y Gestión de Eventos (Policy)
- GET /api/eventos: Listar catálogo abierto de eventos con organizadores (Público).
- PUT /api/eventos/{id}: Modificar un evento (Protegido por Sanctum + EventoPolicy).
  - Retorna 200 OK si el usuario es el creador (user_id).
  - Retorna 403 Forbidden si el usuario no es el dueño.

### Módulo 3: Métricas Globales (Gate)
- GET /api/admin/metricas: Consultar métricas de la plataforma (Protegido por Sanctum + Gate ver-metricas).
  - Retorna 200 OK para usuarios con rol admin.
  - Retorna 403 Forbidden para organizadores o asistentes.