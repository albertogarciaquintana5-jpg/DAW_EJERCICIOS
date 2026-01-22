# CRUD en PHP

Una aplicación sencilla para gestionar usuarios. Puedes crear, ver, editar y eliminar registros de forma rápida.

## ¿Qué puede hacer?

- **Registrarse**: Crear una nueva cuenta con email y contraseña
- **Iniciar sesión**: Acceder con tus credenciales
- **Ver lista**: Mostrar todos los usuarios registrados
- **Crear usuario**: Añadir nuevos registros a la base de datos
- **Editar usuario**: Cambiar los datos de un usuario
- **Eliminar usuario**: Borrar registros de usuarios

## Requisitos

- PHP 5.6 o superior
- MySQL o MariaDB
- Apache (o cualquier servidor compatible con PHP)
- XAMPP (recomendado)

## Instalación

1. Copia la carpeta `Crud` en `htdocs`
2. Importa la base de datos desde `ejecutarsql.sql`
3. Asegúrate de que el usuario `root` de MySQL no tiene contraseña (configuración por defecto en XAMPP)
4. Accede a `http://localhost/Crud/`

## Estructura de archivos

- `index.php` - Página de login y registro
- `home.php` - Panel de control con opciones disponibles
- `lista.php` - Muestra todos los usuarios
- `create.php` - Formulario para crear un nuevo usuario
- `createlist.php` - Procesa la creación del usuario
- `update.php` - Formulario para editar un usuario
- `updatelist.php` - Procesa la edición
- `delete.php` - Elimina un usuario específico
- `deletelist.php` - Elimina múltiples usuarios
- `db.php` - Conexión a la base de datos
- `register.php` - Página de registro de nuevas cuentas

## Base de datos

La base de datos se llama `crud_php` y contiene la tabla `usuarios` con los campos básicos para almacenar información de usuarios.

## Notas

- La aplicación usa sesiones para mantener a los usuarios autenticados
- Asegúrate de tener MySQL corriendo antes de ejecutar la aplicación
- Los datos se validan antes de guardarlos en la base de datos
