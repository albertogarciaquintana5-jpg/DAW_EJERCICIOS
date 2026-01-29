# CRUD MVC (PDO) - Proyecto

Pequeña implementación MVC sin frameworks para la asignatura.

Características:
- Conexión a MySQL con PDO
- Modelo `User` con métodos `all, find, create, update, delete`
- Controlador `UserController` con acciones `index, create, store, edit, update, delete`
- Vistas separadas en `app/views/users`
- Validación básica y uso de `password_hash`
- Código comentado y sin dependencias externas

Instalación y uso:
1. Copia la carpeta `mvc` en tu servidor web (ya está en `/DWES/2eva/Crud/mvc`).
2. Importa la base de datos con `ejecutarsql.sql` (o usa `phpMyAdmin` / `mysql`):
   - `mysql -u root -p < mvc/ejecutarsql.sql`
3. Ajusta las credenciales en `config/database.php` si es necesario.
4. Accede a `http://localhost/DAW_EJERCICIOS/DWES/2eva/Crud/mvc/public/index.php`.

Cómo subir a GitHub (pasos rápidos):
1. Inicializa el repo local dentro de la carpeta `mvc` si quieres que sea independiente:
   - `cd DWES/2eva/Crud/mvc`
   - `git init`
   - `git add .`
   - `git commit -m "CRUD MVC con PDO - entrega"`
2. Crea un repositorio en GitHub desde tu cuenta (por ejemplo `crud-mvc`).
3. Conecta el remoto y sube:
   - `git remote add origin https://github.com/tu_usuario/crud-mvc.git`
   - `git branch -M main`
   - `git push -u origin main`

Notas de seguridad y entrega:
- No subas credenciales en claro. Si necesitas, usa un `.env` y añade a `.gitignore`.
- He incluido un `.gitignore` que ignora dumps `.sql` y directorios locales.

Soporte:
- Si quieres, puedo inicializar el repo local aquí y guiarte con los comandos para subirlo a GitHub o crear el commit por ti; dime si quieres que lo haga.  
