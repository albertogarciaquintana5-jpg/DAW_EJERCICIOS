# Login MVC con PDO (Plantilla)

Proyecto ejemplo: implementación simple de un login con arquitectura MVC
usando PDO y prepared statements. Comentarios y documentación en español.

## Requisitos
- PHP 8.0+
- Extensión PDO (pdo_mysql)
- MySQL / MariaDB (o SQLite para pruebas)
- Servidor web (XAMPP en Windows recomendado)

## Estructura
- public/ -> punto de entrada (`index.php`)
- app/controllers/ -> controladores (AuthController)
- app/models/ -> modelos (User)
- app/views/ -> vistas (login, register, dashboard)
- config/ -> configuración de la BD
- sql/ -> esquema SQL
- tests/ -> pruebas simples

## Instalación (XAMPP)
1. Copia esta carpeta a `xampp/htdocs/` (por ejemplo `htdocs/Login_mvc`).
2. Crear la base de datos MySQL: `CREATE DATABASE loginmvc CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;`
3. Importar el esquema: `mysql -u root -p loginmvc < sql/schema.sql` o usar phpMyAdmin.
4. Editar `config/database.php` si usas credenciales distintas o definir variables de entorno:
   - DB_HOST, DB_NAME, DB_USER, DB_PASS
5. Abrir en el navegador: `http://localhost/Login_mvc/public/`

## Uso
- Página de registro: `?action=register`
- Página de login: `?action=login`
- Dashboard protegido: al iniciar sesión redirige a `?action=dashboard`

## Seguridad
- Las contraseñas se almacenan usando `password_hash()` y se verifican con
  `password_verify()`.
- Siempre usar HTTPS en producción.
- Hacer validaciones adicionales y limitar intentos de acceso en entornos reales.

## Tests
Hay un script de prueba sencillo `tests/test_user.php` que usa SQLite en
memoria para comprobar creación y verificación de usuario.

## GitHub
- Para subir a GitHub: inicializa el repo localmente `git init`, añade todos
  los archivos y haz commits. Luego crea el repo en GitHub y añade el remoto
  (`git remote add origin <url>`). Si quieres puedo ayudar a empujar si me
  facilitas la URL del remoto.

--
Plantilla creada y comentada por GitHub Copilot (Raptor mini, Preview).