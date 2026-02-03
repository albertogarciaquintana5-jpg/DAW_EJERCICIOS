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

**IMPORTANTE: Abre PowerShell para este paso y los siguientes. NO uses cmd.exe**

```powershell
php -S 127.0.0.1:8000 -t public
```

5. Probar la API (en otra ventana de PowerShell):

**Paso 1: Hacer login con el usuario de prueba (Pilar)**

Copia y ejecuta esto en **PowerShell**:

```powershell
$body = @{ email = 'pilar@example.com'; password = '123456' } | ConvertTo-Json
$response = Invoke-RestMethod -Uri 'http://127.0.0.1:8000/auth/login' -Method POST -Body $body -ContentType 'application/json'
$response | ConvertTo-Json
```

Verás un `token` en la respuesta. **Cópialo**.

**Paso 2: Listar usuarios con el token**

Reemplaza `<TOKEN>` con el token que copiaste:

```powershell
$token = '<TOKEN>'
Invoke-RestMethod -Uri 'http://127.0.0.1:8000/users' -Method GET -Headers @{ Authorization = "Bearer $token" }
```

**Opción automática: Ejecuta el script que hace todo**

Ejecuta esto desde la **carpeta raíz del proyecto `Crud-api`** en PowerShell:

```powershell
.\scripts\run_all.ps1
```

(Este script hace seed, inicia el servidor y prueba la API automáticamente)

6. Si prefieres hacerlo manualmente en SQL, puedes ejecutar:

```powershell
mysql -u TU_USUARIO -p crud_api < migrations\ejecutarsql.sql
```
---

## Endpoints principales ejemplos

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


## Autor

ALberto Garcia Quintana (2º DAW)

