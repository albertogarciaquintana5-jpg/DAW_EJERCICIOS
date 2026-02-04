# 🐾 Gestor de Mascotas con Laravel

Un CRUD completo para registrar y gestionar tus mascotas con **login seguro** y una **interfaz bonita** con Bootstrap.

---

##  ¿Qué es esto?

Es un proyecto que te permite:
-  **Registrarte** con tu correo y contraseña
-  **Crear, editar y eliminar** mascotas
-  **Subir fotos** de tus animales
-  **Ver todas tus mascotas** en una lista organizada
-  Todo protegido: solo ves TUS mascotas

---

## Requisitos

Necesitas tener instalado en tu PC:
- **PHP** 8.1 o superior
- **MySQL** (con XAMPP va genial)
- **Composer** (el gestor de paquetes de PHP)
- **Git** (opcional)

---

## Instalación (¡Es fácil!)

### 1️⃣ Clona o descarga el proyecto

```bash
git clone https://github.com/albertogarciaquintana5-jpg/DAW_EJERCICIOS/tree/main/DWES/2eva/Crud-laravel
cd Crud-laravel
```

### 2️⃣ Instala las dependencias

```bash
composer install
```

### 3️⃣ Crea el archivo `.env`

```bash
cp .env.example .env
```

### 4️⃣ Genera la clave de la aplicación

```bash
php artisan key:generate
```

### 5️⃣ Configura la base de datos

Abre `.env` y modifica estas líneas:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crud_laravel
DB_USERNAME=root
DB_PASSWORD=
```

### 6️⃣ Crea la base de datos

En **phpMyAdmin**:
- Crea una base de datos nueva llamada `crud_laravel`
- o copia lo que hay en `database/schema.sql` y importelo en su sql le saldra una advertencia abajo pero si recarga vera que se le crea todo correctamente.

### 7️⃣ Ejecuta las migraciones

```bash
php artisan migrate
```

### 8️⃣ Carga datos de prueba (opcional)

```bash
php artisan db:seed
```

**Usuarios de prueba:**
- Email: `juan@example.com` | Contraseña: `password123`
- Email: `maria@example.com` | Contraseña: `password123`

### 9️⃣ Crea el link de almacenamiento

```bash
php artisan storage:link
```

### 🔟 ¡A funcionar!

```bash
php artisan serve
```

Abre tu navegador en **http://127.0.0.1:8000** 🎉

## 🎨 Características principales

| Función | Descripción |
|---------|------------|
| **Registrarse** | Crear cuenta nueva con email |
| **Login** | Acceder con tu cuenta |
| **Crear mascota** | Formulario con nombre, especie, edad, foto... |
| **Ver mascotas** | Lista de todas tus mascotas |
| **Editar mascota** | Cambiar datos o foto |
| **Eliminar mascota** | Borrar una mascota (¡cuidado!) |
| **Ver detalles** | Pantalla con toda la info de la mascota |

---

## 🔒 Seguridad

- 🔐 Las contraseñas están **encriptadas**
- 🔑 Solo ves **TUS mascotas** (no las de otros usuarios)
- ✅ Validación de **todos los datos** antes de guardar
- 📸 Las fotos se guardan de forma **segura**

## 💡 Consejos para usar el proyecto

1. Siempre **registra un usuario nuevo** antes de crear mascotas
2. Las fotos deben ser **JPG, PNG o WEBP** (menos de 2MB)


## Autor

ALberto Garcia Quintana 


