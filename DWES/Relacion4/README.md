# Relación 4 - DWES

Esta carpeta contiene la solución completa a la relación 4 de Desarrollo Web en Entorno Servidor. Aquí trabajamos con sesiones, cookies, clases orientadas a objetos, interfaces, traits y otras características avanzadas de PHP.

## Estructura de archivos

### Básicos de sesiones y cookies

#### `login.php`
Formulario de acceso simple con validación en JavaScript. Pide usuario y contraseña (credenciales por defecto: **admin** / **1234**). Los datos se envían a `proceso.php` mediante POST.

**Qué aprendes aquí:**
- Formularios HTML básicos
- Validación en cliente con JS
- Método POST

#### `proceso.php`
Recibe los datos del login, valida las credenciales mediante una función PHP, crea una sesión e inicia una cookie con duración de 30 segundos. La página se recarga automáticamente cada 5 segundos para observar el ciclo de vida de la cookie y la persistencia de la sesión.

**Qué aprendes aquí:**
- Validación en servidor (siempre necesaria)
- `session_start()` e inicialización de sesiones
- `setcookie()` y su duración
- Diferencia entre cookies y variables de sesión
- Header `Refresh` para recargas automáticas

#### `sesiones_demo.php`
Demuestra el uso práctico de `$_SESSION` con dos contadores (a y b). Incluye un formulario `select` que te permite:
- Aumentar/disminuir a
- Aumentar/disminuir b
- Resetear a
- Resetear b
- Destruir la sesión

Cierra la pestaña y vuelve a abrirla: verás que los valores persisten. Esto es porque la sesión se mantiene en el servidor.

**Qué aprendes aquí:**
- Persistencia de variables de sesión
- Diferencia entre cerrar una pestaña y destruir la sesión
- `session_destroy()` y `session_unset()`
- Redirección con `header()` después de destruir sesión

### Juegos de adivinanza

#### `juego_hidden.php`
El servidor genera un número aleatorio entre 1 y 100. Usamos un campo **hidden** en el formulario para mantener el número secreto entre peticiones (sin sesiones). El método es GET para facilitar depuración.

**Qué aprendes aquí:**
- Campos hidden para mantener estado sin sesiones
- Método GET y sus límites de privacidad
- `rand()` para generar números aleatorios

#### `juego_sesion.php`
Misma lógica que `juego_hidden.php` pero el número secreto se almacena en `$_SESSION`. Muestra en debug el número actual (para pruebas). Incluye opción de reiniciar la partida.

**Qué aprendes aquí:**
- Comparación entre usar campos hidden vs sesiones
- Ventajas y desventajas de cada enfoque
- Seguridad: sesiones son más seguras que hidden (no visible en HTML)

### Clases y orientación a objetos

#### `ejercicio5.php`
Clase `Restaurante` con atributos (nombre, tipoCocina, ratings) y métodos:
- `__construct()` e `__destruct()`
- `__toString()` (método mágico para visualizar)
- `anadirRating()` y `anadirRatings()`
- `calcularRatingMedio()`
- `obtenerNumeroRatings()`

**Qué aprendes aquí:**
- Definición básica de clases
- Métodos mágicos `__construct`, `__destruct` y `__toString`
- Atributos públicos (primera aproximación)

#### `ejercicio6.php`
Versión mejorada de `Restaurante` que usa:
- **Promoción de propiedades** (PHP 8+): declara parámetros como `private` directamente en el constructor
- **Atributos privados** con getters y setters
- **Atributo static privado** `numeroRest` que cuenta cuántos restaurantes se han creado
- Método de clase `totalRests()` para acceder al contador

**Qué aprendes aquí:**
- Encapsulación: privacidad de atributos
- Getters y setters
- Atributos static y métodos de clase
- Promoción de propiedades (feature PHP 8)

#### `ejercicio7.php`
Clase `BanderaFranjas` que modela una bandera con franjas (colores) en orientación horizontal o vertical.

Métodos:
- `__construct()` y `__destruct()`
- `mostrar()`: visualiza la bandera y sus colores
- `esIdentica()`: compara dos banderas
- `mismasFranjasDistintaOrientacion()`: compara las franjas
- `invertirOrden()`: invierte el orden de colores
- `invertirOrientacion()`: cambia entre horizontal y vertical

**Qué aprendes aquí:**
- Comparación de objetos
- Manipulación de arrays internos
- Métodos que modifican estado

#### `ejercicio8.php`
Clase `CuentaBancaria` con atributos privados (numeroCuenta, titular, saldo, numOperaciones) y métodos:
- `__construct()` y `__destruct()`
- `__toString()`
- `depositar()` e `extraer()`
- `transferir()`: transfiere entre cuentas

**Nota:** Esta versión permite saldo negativo. Se corrige en el ejercicio 9.

**Qué aprendes aquí:**
- Atributos privados con encapsulación
- Métodos que modifican múltiples atributos
- Lógica de transferencias entre objetos

#### `ejercicio9.php`
Reestructuración del ejercicio 8 usando herencia:

- Clase **abstracta** `CuentaBancariaAbstract` define la estructura
- `CuentaDebito`: no permite saldo negativo (rechaza extracciones si no hay fondos)
- `CuentaCredito`: permite hasta un límite de descubierto (límite negativo permitido)

**Qué aprendes aquí:**
- Clases abstractas y métodos abstractos
- Herencia y `extends`
- Polimorfismo: cada subclase implementa `extraer()` diferente
- Lógica de negocio diferenciada

#### `ejercicio10.php`
Interfaz `Encendible` con métodos abstractos `encender()` y `apagar()`.

Clases que implementan la interfaz:
- `Bombilla`: tiene tipo (led, incandescente, etc.) y lúmenes
- `Motocicleta`: tiene gasolina, batería, matrícula y estado

Función `enciende_algo(Encendible $algo)` que acepta cualquier objeto que implemente la interfaz.

**Qué aprendes aquí:**
- Interfaces y `implements`
- Polimorfismo sin herencia
- Type hinting con interfaces
- Métodos con lógica diferenciada según la clase

### Serialización y conversión de datos

#### `ejercicio11_12.php`
Uso de `stdClass` (la clase genérica vacía de PHP) para crear objetos dinámicos. Demostramos:
- Crear un objeto con propiedades dinámicas
- Convertir a array con `(array)`
- Volver a objeto con `(object)`
- `serialize()` / `unserialize()` para ambos

**Qué aprendes aquí:**
- `stdClass`: la clase base de PHP
- Casting entre tipos
- `serialize()` para guardar en cookies o sesiones
- Diferencia entre serialize y JSON

#### `ejercicio13.php`
Array asociativo de socios (nombre, apellidos, edad). Demostramos:
- Convertir a JSON con `json_encode()`
- Volver a array asociativo con `json_decode(..., true)`
- Volver a `stdClass` con `json_decode(..., false)`

**Qué aprendes aquí:**
- `json_encode()` y `json_decode()`
- Por qué JSON es mejor que serialize para interoperabilidad
- Segundo parámetro de `json_decode()`: true = array, false = stdClass

### Cookies complejas

#### `ejercicio14.php` y `ver_carrito.php`
Simula un carrito de compras:

1. `ejercicio14.php`: crea un array con artículos, lo convierte a JSON y lo guarda en una cookie sin expiración (sesión del navegador)
2. `ver_carrito.php`: lee la cookie, la convierte de nuevo en array y en stdClass

**Qué aprendes aquí:**
- Guardar datos complejos en cookies (como JSON)
- Leer y decodificar cookies
- Ciclo de vida de cookies sin expiración explícita
- Diferencia entre JSON en cookies vs sesiones

#### `ejercicio15.php`
Nota sobre **tipado de parámetros y valores devueltos** en PHP 7+:

```php
function buscarRestaurante(?string $nombre): ?array { ... }
```

Aquí usamos `?string` (nullable string) y `?array` (nullable array). Las clases anteriores (5-10) ya incluyen tipado completo.

**Qué aprendes aquí:**
- Tipado fuerte en PHP 7+
- Parámetros y retornos nullable (con `?`)
- Ventajas: el IDE te avisa de errores de tipo
- Desventajas: menos flexible que tipado débil

### Avanzados

#### `ejercicio16.php`
Uso de **namespaces** y **require**:

```php
namespace MiLibreria;
function saludar() { ... }
```

El archivo principal incluye librerías con `require_once` y las llama con `\MiLibreria\funcionNombre()`.

**Qué aprendes aquí:**
- Namespaces para evitar conflictos de nombres
- `require` vs `require_once` (este segundo no incluye dos veces el mismo archivo)
- Diferencia con `include` (no fatal si falta el archivo)
- Cómo organizar código en múltiples archivos

#### `ejercicio17.php`
**Traits** para reutilizar código sin herencia múltiple:

```php
trait LoggerTrait {
    public function log($msg) { ... }
}

class ClaseA {
    use LoggerTrait;
}
```

Tanto `ClaseA` como `ClaseB` usan el mismo trait sin heredar la una de la otra.

**Qué aprendes aquí:**
- Traits: simular herencia múltiple
- Reutilizar métodos en varias clases independientes
- Ventaja sobre herencia: flexibilidad
- Cuando usarlos: funcionalidad transversal (logging, timestamps, etc.)

## Cómo probar

### Opción 1: Abrir en navegador (XAMPP)

Asumo que XAMPP está en marcha y la carpeta está en `htdocs/DAW_EJERCICIOS/`.

Abre en navegador:
```
http://localhost/DAW_EJERCICIOS/DWES/relacion4/login.php
http://localhost/DAW_EJERCICIOS/DWES/relacion4/sesiones_demo.php
http://localhost/DAW_EJERCICIOS/DWES/relacion4/juego_hidden.php
http://localhost/DAW_EJERCICIOS/DWES/relacion4/juego_sesion.php
http://localhost/DAW_EJERCICIOS/DWES/relacion4/ejercicio5.php
... (etc)
```

### Opción 2: Desde PowerShell

```powershell
Start-Process "http://localhost/DAW_EJERCICIOS/DWES/relacion4/login.php"
Start-Process "http://localhost/DAW_EJERCICIOS/DWES/relacion4/sesiones_demo.php"
```

## Comentarios en el código

Todos los archivos incluyen **comentarios invisibles** en HTML/PHP/JS para que en el examen puedas:
- Entender rápidamente qué hace cada sección
- Buscar palabras clave (Ctrl+F)
- Recordar dónde están los conceptos que estudiaste

Por ejemplo:
```php
// Comentario JS: comprobamos que no estén vacíos
if (user === '' || pass === '') { ... }

<!-- Comentario HTML invisible: formulario de acceso -->
<form>...</form>
```

## Notas importantes

### Credenciales de prueba
- Usuario: `admin`
- Contraseña: `1234`

### Diferencias clave

| Concepto | Hidden | Sesión | Cookie |
|----------|--------|--------|--------|
| Ubicación | Cliente (HTML) | Servidor | Cliente |
| Visible en HTML | Sí | No | No (headers) |
| Seguridad | Baja | Alta | Media |
| Duración | Por petición | Configurable | Configurable |
| Uso | Datos no sensibles | Estado usuario | Datos persistentes |

### PHP 8 vs PHP 7

Si tu XAMPP tiene PHP 7, el archivo `ejercicio6.php` (promoción de propiedades) puede fallar. En ese caso, adapta el constructor así:

```php
public function __construct(string $nombre, string $tipoCocina) {
    $this->nombre = $nombre;
    $this->tipoCocina = $tipoCocina;
    $this->ratings = [];
}
```

## Para el examen

1. **Lee los comentarios** del código antes de responder preguntas
2. **Prueba los programas** interactivamente (abre, cierra pestañas, recarga, etc.)
3. **Observa las diferencias**: hidden vs sesión, serialize vs JSON, abstracta vs interfaz
4. **Modifica y experimenta**: cambia valores, añade console.log, etc.

---

**Última actualización:** 21 de noviembre de 2025
