# Proyecto CRUD API en PHP (Trabajo de 2º DAW)

**Descripción**

Este proyecto es una API REST.
---

## Contenido

- `public/` - punto de entrada (front controller)
- `app/` - controladores, modelos, middleware y validadores
- `config/` - configuración y lectura de `.env`
- `migrations/ejecutarsql.sql` - SQL para crear la tabla `users`
- `vendor/` - dependencias instaladas por Composer

---

## Cómo ejecutar el proyecto (pasos simples)


1. Copiar el archivo de configuración de entrega (ya preparado):

```powershell
Copy-Item .env.submit .env
notepad .env  # si quiere cambiar algo (opcional)
```

2. Instalar dependencias con Composer (desde la carpeta `Crud-api`):

```powershell
composer install
```

3. Crear la base de datos y usuario de prueba (el script ejecuta la migración y crea un usuario):

```powershell
php scripts/seed.php
# Usuario de prueba creado en ejecutar.sql:
# Usuario: pilar@example.com
# Contraseña: 123456
```

4. Arrancar el servidor de desarrollo:

```powershell
php -S 127.0.0.1:8000 -t public
```

5. Probar la API (registro/login/usuarios):

- Hacer login con el usuario de prueba (Pilar):

```powershell
# Opción manual (PowerShell):
$body = @{ email = 'pilar@example.com'; password = '123456' } | ConvertTo-Json
Invoke-RestMethod -Uri 'http://127.0.0.1:8000/auth/login' -Method POST -Body $body -ContentType 'application/json'
```

- Llamada a `/users` usando el token devuelto:

```powershell
Invoke-RestMethod -Uri 'http://127.0.0.1:8000/users' -Method GET -Headers @{ Authorization = "Bearer <TOKEN>" }
```

- Opción rápida: ejecutar el script que hace todo (aplica seed, arranca servidor temporal, hace login y lista usuarios):

```powershell
.\scripts\run_all.ps1
```


6. Si prefieres hacerlo manualmente en SQL, puedes ejecutar:

```powershell
mysql -u TU_USUARIO -p crud_api < migrations\ejecutarsql.sql
```

---

---

## Endpoints principales (ejemplos)

- Registrar un usuario (POST): `/auth/register`
  - Body JSON: `{ "nombre":"Ana", "apellido":"Pérez", "email":"ana@mail.com", "password":"P4ss!", "telefono":"600123456" }`

- Login (POST): `/auth/login`
  - Body JSON: `{ "email":"ana@mail.com", "password":"P4ss!" }`
  - Respuesta: `{ "token": "..." }` (guardar token)

- Listar usuarios (GET): `/users` (necesita header `Authorization: Bearer <TOKEN>`)

Ejemplo con `curl` en PowerShell:

```powershell
curl -X POST http://127.0.0.1:8000/auth/login -H "Content-Type: application/json" -d '{"email":"ana@mail.com","password":"P4ss!"}'
# Usar el token devuelto para la llamada protegida
curl http://127.0.0.1:8000/users -H "Authorization: Bearer <TOKEN>"
```

---

## Notas importantes

- Cambia `JWT_SECRET` por un valor largo y seguro antes de entregar el trabajo.
- No subas el fichero `.env` al repositorio (está en `.gitignore`).
- Este proyecto es una práctica de aprendizaje, NO está listo para producción.

---

## Buenas prácticas aplicadas

- Uso de PDO con sentencias preparadas para evitar inyecciones SQL.
- Contraseñas almacenadas con `password_hash()` y comprobadas con `password_verify()`.
- Autenticación por tokens JWT para las rutas de la API.

---

## Autor

ALberto Garcia Quintana (2º DAW)

