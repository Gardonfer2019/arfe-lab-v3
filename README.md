
# ARFE Lab - Sistema de Gestión de Pacientes y Resultados de Exámenes Clínicos

Este proyecto tiene como objetivo desarrollar e implementar un sistema para el control y gestión de pacientes y resultados de exámenes clínicos en un laboratorio. La aplicación permite la creación de solicitudes de exámenes, la administración de pacientes, la gestión de resultados y componentes de los exámenes, así como el control de roles y permisos de los usuarios que interactúan con el sistema.

## Tecnologías Utilizadas

- **Framework**: [Laravel](https://laravel.com/)
- **Panel Administrativo**: [FilamentPHP](https://filamentphp.com/)
- **Base de Datos**: PostgreSQL
- **Frontend**: AdminLTE (para la interfaz de usuario)
- **Lenguaje**: PHP 8.x

## Características Principales

- **Gestión de Pacientes**: Administración de pacientes con campos detallados.
- **Solicitudes de Exámenes**: Creación y gestión de solicitudes de exámenes con componentes de exámenes relacionados.
- **Resultados de Exámenes**: Almacenamiento y consulta de resultados, con generación automática al crear solicitudes.
- **Control de Acceso**: Gestión de roles y permisos (Administrador y Técnico).
- **Informes Personalizados**: Visualización e impresión de resultados por examen.
- **Sistema de Usuarios**: Configuración avanzada para la gestión de usuarios del sistema.
  
## Tipos de Usuarios

### 1. Administrador
- **Permisos**: Tiene control total sobre la gestión de pacientes, exámenes, solicitudes, resultados, y componentes de exámenes.
  
### 2. Técnico
- **Permisos**:
  - **Pacientes**: Crear y actualizar pacientes, pero no eliminarlos.
  - **Solicitudes**: Crear y actualizar solicitudes de exámenes, pero no eliminarlas.
  - **Resultados y Exámenes**: No tiene acceso a la gestión de exámenes ni a los resultados.

## Instalación

### Requisitos previos

Asegúrate de tener instalados los siguientes requisitos:

- PHP >= 8.x
- Composer
- PostgreSQL
- Node.js & NPM

### Pasos de Instalación

1. **Clonar el repositorio:**

   ```bash
   git clone https://github.com/tuusuario/arfe-lab.git
   cd arfe-lab
   ```

2. **Instalar dependencias de PHP:**

   ```bash
   composer install
   ```

3. **Instalar dependencias de Node.js:**

   ```bash
   npm install
   ```

4. **Copiar el archivo `.env` y configurar las variables de entorno:**

   ```bash
   cp .env.example .env
   ```

   Actualiza las variables de entorno necesarias, como la conexión a la base de datos:

   ```
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=arfe_lab
   DB_USERNAME=tuusuario
   DB_PASSWORD=tupassword
   ```

5. **Generar la clave de la aplicación:**

   ```bash
   php artisan key:generate
   ```

6. **Ejecutar las migraciones y sembradores (seeders):**

   ```bash
   php artisan migrate --seed
   ```

7. **Compilar los activos de frontend:**

   ```bash
   npm run dev
   ```

8. **Iniciar el servidor de desarrollo:**

   ```bash
   php artisan serve
   ```

   Ahora puedes acceder al sistema en `http://localhost:8000`.

## Configuración de Usuarios

### Usuario por defecto

- **Email**: `admin@example.com`
- **Contraseña**: `password`

Recuerda cambiar la contraseña del administrador una vez inicies sesión.

### Configuración de Roles y Permisos

Este proyecto usa [Spatie Laravel-Permission](https://spatie.be/docs/laravel-permission/v5/introduction) para la gestión de roles y permisos. A continuación, un ejemplo de roles:

- **Admin**: Acceso completo a todas las funcionalidades.
- **Técnico**: Acceso limitado a la gestión de pacientes y solicitudes.

Para asignar roles:

```bash
php artisan permission:assign-role admin@example.com admin
php artisan permission:assign-role tecnico@example.com tecnico
```

## Panel Administrativo

El panel administrativo está construido con [FilamentPHP](https://filamentphp.com/), proporcionando una interfaz de usuario intuitiva y funcional para la gestión de los módulos del sistema.

### Navegación del Panel

El sistema está dividido en las siguientes secciones:

- **Gestión de Pacientes**
- **Gestión de Exámenes**
- **Solicitudes de Exámenes**
- **Resultados de Exámenes**
- **Configuración del Sistema** (Gestión de usuarios y permisos)

## Documentación Adicional

Para más detalles sobre cómo contribuir, estructura del proyecto, o cualquier otra información relevante, revisa los siguientes enlaces:

- [Contribuir al Proyecto](./CONTRIBUTING.md)
- [Guía de Estilo de Código](./STYLEGUIDE.md)
- [Preguntas Frecuentes](./FAQ.md)

## Licencia

Este proyecto está licenciado bajo la licencia MIT. Consulta el archivo [LICENSE](./LICENSE) para más información.

---

Desarrollado con 💙 por el equipo de ARFE Lab.
