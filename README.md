# 📚 WebHook de Documentos y Automatizacion de Archivar Documentos

Api REST desarrollada en Laravel 12 para las notificaicones asincrónicas (webhooks) de documentos, tareas de automatización de archivar documentos pendientes, implementando **Arquitectura Hexagonal**, **Principios SOLID**, **TDD** y **Patrón Repository** con Eloquent ORM.

![Laravel](https://img.shields.io/badge/laravel-purple?logo=laravel)
![PHP](https://img.shields.io/badge/php-blue?logo=php)
![License](https://img.shields.io/badge/license-MIT-blue.svg)

---

## 📋 Tabla de Contenidos

- [Características](#-características)
- [Arquitectura](#-arquitectura)
- [Prerequisitos](#-prerequisitos)
- [Instalación](#-instalación)
- [Configuración](#-configuración)
- [Ejecución](#-ejecución)
- [Pruebas](#-pruebas)
- [Endpoints](#-endpoints-api)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Tecnologías](#-tecnologías)
- [Principios Aplicados](#-principios-aplicados)

## ✨ Características

### Funcionalidades
- ✅ Webhook para validacion de documentos y cambio de estado.
- ✅ Schedule para autormzación de archivar documentos pendintes a las 90 días.

### Arquitectura y Patrones
- 🏗️ **Arquitectura Hexagonal** (Puertos y Adaptadores)
- 🎯 **Principios SOLID**
- 🧪 **Test-Driven Development (TDD)**
- 📦 **Patrón Repository**
- 🔄 **Dependency Injection**
- 📝 **Domain-Driven Design (DDD)**

---
## 🏛️ Arquitectura

### WebHook

```
┌─────────────────────────────────────────────────────────────┐
│                    CAPA DE PRESENTACIÓN                     │
│                  (MicroservicioNotificaciones)              │
│                        Api/WebHook                          │
└───────────────────────────┬─────────────────────────────────┘
                            │
┌───────────────────────────▼─────────────────────────────────┐
│                   CAPA DE APLICACIÓN                        │
│                    (Src.Application)                        │
│            Services + DTOs + Casos de Uso                   │
└───────────────────────────┬─────────────────────────────────┘
                            │
┌───────────────────────────▼─────────────────────────────────┐
│                    CAPA DE DOMINIO                          │
│                     (Src.Dominio)                           │
│        Entidades + Interfaces + Reglas de Negocio           │
└───────────────────────────┬─────────────────────────────────┘
                            │
┌───────────────────────────▼─────────────────────────────────┐
│                 CAPA DE INFRAESTRUCTURA                     │
│                  (Src.Infrastructura)                       │
│                 Repositorios + Eloquent                     │
└───────────────────────────┬─────────────────────────────────┘
                            │
                    ┌───────▼───────┐
                    │  SQL Server   │
                    └───────────────┘
```
### Schedule

```
┌─────────────────────────────────────────────────────────────┐
│                    Command/Schedule                         │
│                  (MicroservicioNotificaciones)              │
│                        Schedule/Schedule                    │
└───────────────────────────┬─────────────────────────────────┘
                            │
┌───────────────────────────▼─────────────────────────────────┐
│                          Job                                │
│                       (App.Jobs)                            │
│                      BackgroundJob                          │
└───────────────────────────┬─────────────────────────────────┘                            
                            │
┌───────────────────────────▼─────────────────────────────────┐
│                   CAPA DE APLICACIÓN                        │
│                    (Src.Application)                        │
│            Services + DTOs + Casos de Uso                   │
└───────────────────────────┬─────────────────────────────────┘
                            │
┌───────────────────────────▼─────────────────────────────────┐
│                    CAPA DE DOMINIO                          │
│                     (Src.Dominio)                           │
│        Entidades + Interfaces + Reglas de Negocio           │
└───────────────────────────┬─────────────────────────────────┘
                            │
┌───────────────────────────▼─────────────────────────────────┐
│                 CAPA DE INFRAESTRUCTURA                     │
│                  (Src.Infrastructura)                       │
│                 Repositorios + Eloquent                     │
└───────────────────────────┬─────────────────────────────────┘
                            │
                    ┌───────▼───────┐
                    │  SQL Server   │
                    └───────────────┘
```
---
## 📦 Prerequisitos

### Software Obligatorio

- **PHP >= 8.2** con las siguientes extensiones:
  - OpenSSL
  - PDO
  - Mbstring
  - Tokenizer
  - XML
  - Ctype
  - JSON
  - BCMath
  - **pdo_sqlsrv** (extensión para SQL Server)
  - **sqlsrv** (driver de SQL Server)

### Extensiones PHP para SQL Server

#### En Linux (Ubuntu/Debian)
```bash
# Instalar dependencias
sudo apt-get update
sudo apt-get install -y php8.2-dev php8.2-xml

# Agregar repositorio de Microsoft
curl https://packages.microsoft.com/keys/microsoft.asc | sudo apt-key add -
curl https://packages.microsoft.com/config/ubuntu/$(lsb_release -rs)/prod.list | sudo tee /etc/apt/sources.list.d/mssql-release.list

# Instalar ODBC Driver
sudo apt-get update
sudo ACCEPT_EULA=Y apt-get install -y msodbcsql18
sudo ACCEPT_EULA=Y apt-get install -y mssql-tools18

# Instalar extensiones PHP
sudo pecl install sqlsrv
sudo pecl install pdo_sqlsrv

# Habilitar extensiones
echo "extension=sqlsrv.so" | sudo tee -a /etc/php/8.2/cli/php.ini
echo "extension=pdo_sqlsrv.so" | sudo tee -a /etc/php/8.2/cli/php.ini
```

#### En Windows
```bash
# Descargar e instalar ODBC Driver 18 for SQL Server
# https://docs.microsoft.com/en-us/sql/connect/odbc/download-odbc-driver-for-sql-server

# Descargar las DLLs de las extensiones PHP desde:
# https://pecl.php.net/package/sqlsrv
# https://pecl.php.net/package/pdo_sqlsrv

# Copiar php_sqlsrv.dll y php_pdo_sqlsrv.dll a la carpeta ext/ de PHP
# Agregar en php.ini:
extension=php_sqlsrv.dll
extension=php_pdo_sqlsrv.dll
```

### Herramientas Adicionales
- **Composer** >= 2.7
- **SQL Server** >= 2017 o **Azure SQL Database**
- **Git**

### Verificar Instalación
```bash
# Verificar versión de PHP
php -v

# Verificar extensiones de SQL Server
php -m | grep sqlsrv

# Verificar Composer
composer --version
```
### Software Opcional (Recomendado)

#### Postman o Insomnia
Para probar los endpoints el WebHook
- [Postman](https://www.postman.com/downloads/)
- [Insomnia](https://insomnia.rest/download)
---

## 🚀 Instalación

### 1. Clonar el Repositorio

```bash
# HTTPS
git clone https://github.com/benru203/microservicio_notificaciones.git

# SSH
git clone git@github.com:benru203/microservicio_notificaciones.git

# Entrar al directorio
cd microservicio_notificaciones
```
### 2. Instalar Dependencias
```bash
composer install
```

### 3. Configurar Variables de Entorno
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurar SQL Server en .env
```env
DB_CONNECTION=sqlsrv
DB_HOST=tu-servidor.database.windows.net
DB_PORT=1433
DB_DATABASE=nombre_base_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña

# Opciones adicionales para SQL Server
DB_ENCRYPT=yes
DB_TRUST_SERVER_CERTIFICATE=false

# Opciones para el Scheduler
QUEUE_CONNECTION=sync
CACHE_STORE=file
```

### 5. Ejecutar Migraciones
```bash
php artisan migrate

### 6. Sembrar Base de Datos (opcional)
```bash
php artisan db:seed

### Configuración de Base de Datos

Edita el archivo `config/database.php` para configuraciones avanzadas:
```php
'sqlsrv' => [
    'driver' => 'sqlsrv',
    'url' => env('DB_URL'),
    'host' => env('DB_HOST', 'localhost'),
    'port' => env('DB_PORT', '1433'),
    'database' => env('DB_DATABASE', 'forge'),
    'username' => env('DB_USERNAME', 'forge'),
    'password' => env('DB_PASSWORD', ''),
    'charset' => 'utf8',
    'prefix' => '',
    'prefix_indexes' => true,
    'encrypt' => env('DB_ENCRYPT', 'yes'),
    'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', false),
],

### Configuración del Logger

Edita el archivo `config/logging.php` para configuraciones avanzadas:
```php
'documentos' => [
    'driver' => 'daily',
    'path' => storage_path('logs/documentos_pendientes_archivados_auto.log'),
    'level' => env('LOG_LEVEL', 'debug'),
    'days' => 30,
    'replace_placeholders' => true,
]
```

### Caché y Optimización
```bash
# Cachear configuración
php artisan config:cache

# Cachear rutas
php artisan route:cache

# Cachear vistas
php artisan view:cache
```

## 🚀 Ejecución

### Iniciar Servidor de Desarrollo
```bash
php artisan serve
```

### Prueba de Command
```bash
 php artisan app:archivar-documentos-pendientes
```
### Prueba de Schedule
```bash
 php artisan schedule:run
```

El microservicio estará disponible en `http://localhost:8000`

### Modo de Desarrollo con Watch
```bash
php artisan serve --host=0.0.0.0 --port=8000
```
## 🧪 Pruebas

### Ejecutar Tests Unitarios

```bash
# Ejecutar todos los tests
php artisan test

./vendor/bin/pest

# Ejecutar todos los tests unitarios
php artisan test --testsuite=Unit

# Ejecutar todos los tests Feature
php artisan test --testsuite=Feature

```
---
## 📡 Endpoints API

### Base URL
- **Desarrollo:** `http://localhost:8000/api`
- **Producción:** `https://tu-dominio.com/api`

### Documentación Swagger
- **Desarrollo:** http://localhost:8000

### Endpoints Disponibles

#### 1. Crear Documento
```http
POST /api/webhook/validar-documento
Content-Type: application/json

{
  "documentoId": "D5EA10D0-10D8-4DE2-8ED9-4629A7CA2327",
  "nuevoEstado": "VALIDADO"
}
```

**Response 200 Created:**
```json
{
  "mensaje": "Documento validado",
}

**Response 404 Bad Request:**
```json
{
  "mensaje": "No se pudo encontrar el documento con id {documentoId}"
}
```
### Valores Válidos

#### Estado de Documento
- `REGISTRADO`
- `PENDIENTE`
- `VALIDADO`
- `ARCHIVADO`

### Códigos de Estado HTTP

| Código | Significado |
|--------|-------------|
| 200 | OK - Solicitud exitosa |
| 404 | Not Found - Recurso no encontrado |
| 500 | Internal Server Error - Error del servidor |

---

## 📁 Estructura del Proyecto
```
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Controladores de la API
│   │   ├── Middleware/      # Middleware personalizado
│   │   └── Requests/        # Form requests para validación
|   ├── Jobs/ 
│   ├── Models/              # Modelos Eloquent
│   ├── Services/            # Lógica de negocio
│   └── Repositories/        # Capa de acceso a datos
├── bootstrap/
├── config/
│   └── database.php         # Configuración de BD
├── database/
│   ├── migrations/          # Migraciones de BD
│   ├── seeders/             # Seeders
│   └── factories/           # Factories para testing
├── routes/
│   ├── api.php              # Rutas de la API
│   └── web.php
├── storage/
├── src/
│   ├── Aplicacion/          # Capa de aplicación
│   │   ├── ArchivarDocumento/
│   │   |   ├── DTOs/        # DTOs
│   │   |   ├── Interfaces/  # Interfaces
│   │   |   └── Services/    # Servicios
│   │   └── WebHook/
│   │       ├── DTOs/        # DTOs
│   │       ├── Interfaces/  # Interfaces
│   │       └── Services/    # Servicios
│   ├── Dominio/              # Capa de dominio
│   │   ├── ArchivarDocumento/
│   │   │   ├── Enums/       # Enums
│   │   │   ├── Entidades/   # Entidades
│   │   │   └── Interfaces/  # Interfaces
│   │   ├── WebHook/
│   │   │   ├── Enums/       # Enums
│   │   │   ├── Entidades/   # Entidades
│   │   │   └── Interfaces/  # Interfaces
│   ├── Infrastructura/      # Capa de infraestructura
│   │   ├── ArchivarDocumento/
│   │   │   └── Repositorios/  # Repositorios
│   │   └── Repositorios/    # Repositorios
├── tests/
│   ├── Feature/             # Tests de integración
│   │   ├── Api/
│   │   |    └── WebHook/     # Tests de la API
│   ├── Unit/                # Tests unitarios
|   |   ├── Aplication/      # Tests de aplicación
│   │   │   └── WebHook/
│   │   │       └── Services/
│   │   ├── Dominio/         # Tests de dominio
│   │   |    └── WebHook/
│   │   |        ├── Enums/
│   │   |        └── Entidades/
|   |   ├── Infrastructura/  # Tests de infraestructura
│   │   │   └── WebHook/
│   │   │       └── Repositorios/
├── .env                     # Variables de entorno
├── composer.json
└── README.md
```
---
## 🛠️ Tecnologías

### Framework y Lenguaje
- **Laravel 12** - Framework principal
- **PHP 8.2** - Lenguaje de programación

### ORM y Base de Datos
- **Eloquent** - ORM
- **SQL Server 2019+** - Base de datos

### Testing
- **pestphp/pest 3.8** - **pestphp/pest-plugin-laravel 3.2** - Framework de testing
- **mockery/mockery 1.6** - Mocking framework

---

## 🎯 Principios Aplicados

### Arquitectura Hexagonal (Puertos y Adaptadores)

```
┌─────────────┐
│   Puertos   │ ──► Interfaces (IDocumentoRepository)
└─────────────┘
       │
       ▼
┌─────────────┐
│ Adaptadores │ ──► Implementaciones (DocumentoRepository)
└─────────────┘
```

- **Puertos de entrada:** IDocumentoService
- **Puertos de salida:** IDocumentoRepository
- **Adaptadores:** Controllers, Repositories

### Principios SOLID

#### 1. **S**ingle Responsibility Principle
- `DocumentoService`: Solo gestiona lógica de aplicación
- `DocumentoRepository`: Solo gestiona persistencia
- `Documento`: Solo contiene lógica de dominio

#### 2. **O**pen/Closed Principle
- Extensible a través de interfaces
- Cerrado para modificación directa

#### 3. **L**iskov Substitution Principle
- Las implementaciones son intercambiables
- `DocumentoRepository` puede ser reemplazado por otra implementación

#### 4. **I**nterface Segregation Principle
- Interfaces específicas y cohesivas
- No hay métodos innecesarios

#### 5. **D**ependency Inversion Principle
- Dependencias hacia abstracciones (interfaces)
- Inyección de dependencias con DI Container

### Domain-Driven Design (DDD)

- **Entidades:** Documento con identidad (GUID)
- **Enum:** Enums (EstadoEnum)
- **Agregados:** Documento como raíz de agregado
- **Repositorios:** Acceso a colecciones de entidades

### Test-Driven Development (TDD)

1. ✅ Escribir test (Red)
2. ✅ Implementar código mínimo (Green)
3. ✅ Refactorizar (Refactor)