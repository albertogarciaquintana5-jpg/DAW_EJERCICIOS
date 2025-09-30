<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- poner numero del ejercicio y mandarle al codigo de este -->
    <form action="Ejercicio1.php" method="post">
        <label for="ejercicio">Numero del Ejercicio:</label>
        <input type="number" name="ejercicio" min="1" max="20">
        <input type="submit" value="Enviar">
    </form>        
    

    <?php
    $iNumejercicio= $_POST['ejercicio'];


/*
1- Haz un programa en PHP que muestre el mensaje “Hello world” de
diferentes formas:
● como texto plano html
● como un encabezado de nivel 2 html
● como un párrafo con estilo: color, tipografía, alineación, etc.
● con un salto de línea entre hello y world
● añádele la información sobre la instalación php (phpversion() y phpinfo()
● investiga en la siguiente dirección como mostrar la fecha y la hora del
sistema en el momento de la ejecución:
https://www.php.net/manual/es/function.date.php
PUNTOS DE INTERÉS: sintaxis de bloque php dentro de html, salida básica con
echo, manipulación de las etiquetas html dentro del código php, comentarios en
una y varias líneas, información de la configuración
*/
 if ($iNumejercicio==1) { 
      
    echo "<h1>Ejercicio $iNumejercicio</h1>";


    echo "Hello world"; // como texto plano html
    echo "<h2>Hello world</h2>"; // como un encabezado de nivel 2 html
    echo "<p style='color:blue; font-family:Arial; text-align:center;'>Hello world</p>"; // como un párrafo con estilo: color, tipografía, alineación, etc.
    echo "Hello<br>world"; // con un salto de línea entre hello y world
    echo "<p>Versión de PHP: " . phpversion() . "</p>"; // añádele la información sobre la instalación php (phpversion() y phpinfo()
    echo "<h3>Información de PHP:</h3>";
    phpinfo(); // Información detallada sobre la configuración de PHP
    echo "<p>Fecha y hora actual: " . date('Y-m-d H:i:s') . "</p>"; // mostrar la fecha y la hora del sistema en el momento de la ejecución
 }
  

/*
2- Haz un programa PHP que muestre un valor de ejemplo de cada tipo de
dato escalar en php con echo utilizando la función var_dump(), y también
con printf formateado.
Prueba diversas posibilidades de formateo de salida tal y como vienen
descritas en: https://www.w3schools.com/php/func_string_printf.asp para:
● bool
● int
● float
● string
PUNTOS DE INTERÉS: tipos de datos escalares en PHP, declaración de variables,
variables variables ($$), regla de formación de nombres de variables, salida
formateada con printf
*/
    if ($iNumejercicio==2) { 

        echo "<h1>Ejercicio $iNumejercicio</h1>";
    
        // Declaración de variables de diferentes tipos de datos escalares
        $boolVar = true; // booleano
        $intVar = 42; // entero
        $floatVar = 3.14159; // flotante
        $stringVar = "Hello, PHP!"; // cadena
    
        // Mostrar los valores utilizando var_dump()
        echo "<h2>Usando var_dump():</h2>";
        echo "<p>Booleano: ";
        var_dump($boolVar);
        echo "</p>";
        echo "<p>Entero: ";
        var_dump($intVar);
        echo "</p>";
        echo "<p>Flotante: ";
        var_dump($floatVar);
        echo "</p>";
        echo "<p>Cadena: ";
        var_dump($stringVar);
        echo "</p>";
    
        // Mostrar los valores utilizando printf con formateo
        echo "<h2>Usando printf():</h2>";
        printf("<p>Booleano: %s</p>", $boolVar ? 'true' : 'false');
        printf("<p>Entero: %d</p>", $intVar);
        printf("<p>Flotante: %.2f</p>", $floatVar);
        printf("<p>Cadena: %s</p>", $stringVar);
    }

/*
3- Investiga qué y cuales son las superglobals en php
(https://www.php.net/manual/es/language.variables.superglobals.php), y haz
un programa que muestre, en forma de lista no numerada, para la superglobal
$_SERVER los valores de:
‘DOCUMENT-ROOT’
‘PHP-SELF’
‘SERVER-NAME’
'SERVER_SOFTWARE'
'SERVER_PROTOCOL'
'HTTP_HOST'
1
Desarrollo Web en Entorno Servidor - IES Playamar - Pilar González Augusto
'HTTP_USER_AGENT'
'REMOTE_ADDR'
'REMOTE_PORT'
'SCRIPT_FILENAME'
'REQUEST_URI'
Prueba un volcado de $_SERVER con var_dump($_SERVER) y también con
print_r($_SERVER). ¿Cuál es la diferencia?
PUNTOS DE INTERÉS: concepto de superglobals, arrays asociativos, información
de var_dump() y print_r() para la fase de debug (no usar en producción)
*/
    if ($iNumejercicio==3) { 
    
        echo "<h1>Ejercicio $iNumejercicio</h1>";
    
        // Mostrar los valores específicos de la superglobal $_SERVER
        echo "<h2>Valores específicos de \$_SERVER:</h2>";
        echo "<ul>";
        echo "<li>DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "</li>";
        echo "<li>PHP_SELF: " . $_SERVER['PHP_SELF'] . "</li>";
        echo "<li>SERVER_NAME: " . $_SERVER['SERVER_NAME'] . "</li>";
        echo "<li>SERVER_SOFTWARE: " . $_SERVER['SERVER_SOFTWARE'] . "</li>";
        echo "<li>SERVER_PROTOCOL: " . $_SERVER['SERVER_PROTOCOL'] . "</li>";
        echo "<li>HTTP_HOST: " . $_SERVER['HTTP_HOST'] . "</li>";
        echo "<li>HTTP_USER_AGENT: " . $_SERVER['HTTP_USER_AGENT'] . "</li>";
        echo "<li>REMOTE_ADDR: " . $_SERVER['REMOTE_ADDR'] . "</li>";
        echo "<li>REMOTE_PORT: " . $_SERVER['REMOTE_PORT'] . "</li>";
        echo "<li>SCRIPT_FILENAME: " . $_SERVER['SCRIPT_FILENAME'] . "</li>";
        echo "<li>REQUEST_URI: " . $_SERVER['REQUEST_URI'] . "</li>";
        echo "</ul>";
    
        // Volcado completo de $_SERVER usando var_dump()
        echo "<h2>Volcado completo de \$_SERVER usando var_dump():</h2>";
        echo "<pre>";
        var_dump($_SERVER);
        echo "</pre>";
    
        // Volcado completo de $_SERVER usando print_r()
        echo "<h2>Volcado completo de \$_SERVER usando print_r():</h2>";
        echo "<pre>";
        print_r($_SERVER);
        echo "</pre>";
    
        // Diferencia entre var_dump() y print_r()
        echo "<h2>Diferencia entre var_dump() y print_r():</h2>";
        echo "<p>var_dump() proporciona información detallada sobre el tipo y el valor de cada elemento, incluyendo la longitud de las cadenas y los tipos de datos. Es útil para depuración exhaustiva.</p>";
        echo "<p>print_r() es más conciso y está diseñado para mostrar estructuras de datos de manera legible. No proporciona detalles sobre los tipos de datos, pero es más fácil de leer para estructuras simples.</p>";
        }
/*
4- En un programa PHP, declara un array constante en el que se almacenarán
los días de la semana. Muestra por pantalla:
● el primer dia de la semana
● todos los días secuencialmente
● lo mismo que el anterior, pero en formato de lista numerada
PUNTOS DE INTERÉS: array clásico, recorrido secuencial usando for, función que
calcula la longitud de una array, creación de estructuras de listas en html desde
php
*/
    
    if ($iNumejercicio==4) { 
    
        echo "<h1>Ejercicio $iNumejercicio</h1>";
    
        // Declaración de un array constante con los días de la semana
        define('DIAS_SEMANA', ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo']);
    
        // Mostrar el primer día de la semana
        echo "<h2>Primer día de la semana:</h2>";
        echo "<p>" . DIAS_SEMANA[0] . "</p>";
    
        // Mostrar todos los días secuencialmente
        echo "<h2>Todos los días secuencialmente:</h2>";
        foreach (DIAS_SEMANA as $dia) {
            echo "<p>$dia</p>";
        }
    
        // Mostrar todos los días en formato de lista numerada
        echo "<h2>Días en formato de lista numerada:</h2>";
        echo "<ol>";
        foreach (DIAS_SEMANA as $dia) {
            echo "<li>$dia</li>";
        }
        echo "</ol>";
    }

/*
5- Crea un array asociativo constante, en el que utilices como clave el día de la
semana, y como valor, la temperatura máxima de ese día en formato real. A
continuación, muestra:
● la temperatura del primer dia de la semana
● la temperatura de todos los días, secuencialmente
● lo mismo que el anterior, pero en formato de lista numerada
● idem, en forma de tabla
PUNTOS DE INTERÉS: array asociativo, recorrido secuencial usando foreach,
acumulación de resultados con +=, creación de estructuras de listas y tablas html,
límites del estilo css
*/
    if ($iNumejercicio==5) { 
    
        echo "<h1>Ejercicio $iNumejercicio</h1>";
    
        // Declaración de un array asociativo constante con los días de la semana y sus temperaturas máximas
        define('TEMP_MAX_SEMANA', [
            'Lunes' => 22.5,
            'Martes' => 24.0,
            'Miércoles' => 23.5,
            'Jueves' => 25.0,
            'Viernes' => 26.5,
            'Sábado' => 27.0,
            'Domingo' => 24.5
        ]);
    
        // Mostrar la temperatura del primer día de la semana
        echo "<h2>Temperatura del primer día de la semana (Lunes):</h2>";
        echo "<p>" . TEMP_MAX_SEMANA['Lunes'] . " °C</p>";
    
        // Mostrar la temperatura de todos los días secuencialmente
        echo "<h2>Temperaturas de todos los días secuencialmente:</h2>";
        foreach (TEMP_MAX_SEMANA as $dia => $temp) {
            echo "<p>$dia: $temp °C</p>";
        }
    
        // Mostrar las temperaturas en formato de lista numerada
        echo "<h2>Temperaturas en formato de lista numerada:</h2>";
        echo "<ol>";
        foreach (TEMP_MAX_SEMANA as $dia => $temp) {
            echo "<li>$dia: $temp °C</li>";
        }
        echo "</ol>";
    
        // Mostrar las temperaturas en forma de tabla
        echo "<h2>Temperaturas en forma de tabla:</h2>";
        echo "<table border='1' style='border-collapse: collapse;'>";
        echo "<tr><th>Día</th><th>Temperatura Máxima (°C)</th></tr>";
        foreach (TEMP_MAX_SEMANA as $dia => $temp) {
            echo "<tr><td>$dia</td><td style='text-align: center;'>$temp</td></tr>";
        }
        echo "</table>";
    }

/*
6- Declara en un programa PHP una clase fruta, con dos atributos: nombre y
color, y dos funciones, set_name() y get_name(). Declara e inicializa dos
instancias: apple y banana, inicializa los nombres y muéstralos por pantalla
PUNTOS DE INTERÉS: declaración y manipulación básica de clases y objetos en
php, visibilidad, getters, setters y constructores
*/
    if ($iNumejercicio==6) { 
    
        echo "<h1>Ejercicio $iNumejercicio</h1>";
    
        // Declaración de la clase Fruta
        class Fruta {
            private $nombre;
            private $color;
    
            // Constructor para inicializar los atributos
            public function __construct($nombre, $color) {
                $this->nombre = $nombre;
                $this->color = $color;
            }
    
            // Setter para el nombre
            public function set_name($nombre) {
                $this->nombre = $nombre;
            }
    
            // Getter para el nombre
            public function get_name() {
                return $this->nombre;
            }
    
            // Getter para el color
            public function get_color() {
                return $this->color;
            }
        }
    
        // Crear e inicializar dos instancias de la clase Fruta
        $apple = new Fruta("Manzana", "Rojo");
        $banana = new Fruta("Plátano", "Amarillo");
    
        // Mostrar los nombres y colores por pantalla
        echo "<p>Fruta 1: " . $apple->get_name() . " - Color: " . $apple->get_color() . "</p>";
        echo "<p>Fruta 2: " . $banana->get_name() . " - Color: " . $banana->get_color() . "</p>";
    }

/*
7- Calcula la nota final de una persona a partir de la media de dos notas
numéricas iniciales, y descontando 0.25 por cada falta sin justificar. Muestra el
resultado por pantalla, indicando si la persona aprueba o suspende.
PUNTOS DE INTERÉS: estructura de control de bifurcación if (simple), operadores
matemáticos
2
Desarrollo Web en Entorno Servidor - IES Playamar - Pilar González Augusto
*/
    if ($iNumejercicio==7) { 
    
        echo "<h1>Ejercicio $iNumejercicio</h1>";
    
        // Variables de ejemplo
        $nota1 = 7.5; // Primera nota
        $nota2 = 8.0; // Segunda nota
        $faltasSinJustificar = 3; // Número de faltas sin justificar
    
        // Calcular la nota final
        $mediaNotas = ($nota1 + $nota2) / 2;
        $descuentoFaltas = 0.25 * $faltasSinJustificar;
        $notaFinal = $mediaNotas - $descuentoFaltas;
    
        // Asegurarse de que la nota final no sea negativa
        if ($notaFinal < 0) {
            $notaFinal = 0;
        }
    
        // Mostrar el resultado por pantalla
        echo "<p>Nota Final: " . number_format($notaFinal, 2) . "</p>";
    
        // Indicar si la persona aprueba o suspende
        if ($notaFinal >= 5) {
            echo "<p>Resultado: Aprobado</p>";
        } else {
            echo "<p>Resultado: Suspendido</p>";
        }
    }

/*
8- Crea en un script PHP dos arrays asociativos paralelos, uno con la rúbrica de
4 calificaciones (inicial, primera, segunda y tercera) y otro con las notas
particulares de una persona. A continuación, computará la nota final de esa
persona, y muéstrala por pantalla.
PUNTOS DE INTERÉS: recorrido secuencial de array asociativo con foreach y
acceso directo por clave a un segundo array, operadores matemáticos, bifurcación
simple
*/
    if ($iNumejercicio==8) { 
    
        echo "<h1>Ejercicio $iNumejercicio</h1>";
    
        // Declaración de los arrays asociativos paralelos
        $rubrica = [
            'inicial' => 0.1,
            'primera' => 0.3,
            'segunda' => 0.3,
            'tercera' => 0.3
        ];
    
        $notas = [
            'inicial' => 6.0,
            'primera' => 7.5,
            'segunda' => 8.0,
            'tercera' => 9.0
        ];
    
        // Calcular la nota final
        $notaFinal = 0;
        foreach ($rubrica as $etapa => $peso) {
            if (isset($notas[$etapa])) {
                $notaFinal += $notas[$etapa] * $peso;
            }
        }
    
        // Mostrar la nota final por pantalla
        echo "<p>Nota Final: " . number_format($notaFinal, 2) . "</p>";
    }

/*
9- En un programa PHP, valora a partir de los 3 lados de un triángulo si es
equilátero, isósceles y escaleno, y muestra esa valoración por pantalla
PUNTOS DE INTERÉS: bifurcaciones if anidadas, utilización de operadores
booleanos and, or y not, testing con diferentes juegos de datos de las diferentes
ramas de un algoritmo
*/
    if ($iNumejercicio==9) { 
    
        echo "<h1>Ejercicio $iNumejercicio</h1>";
    
        // Variables de ejemplo para los lados del triángulo
        $ladoA = 5;
        $ladoB = 5;
        $ladoC = 8;
    
        // Determinar el tipo de triángulo
        if ($ladoA <= 0 || $ladoB <= 0 || $ladoC <= 0) {
            echo "<p>Los lados deben ser mayores que cero.</p>";
        } elseif ($ladoA + $ladoB <= $ladoC || $ladoA + $ladoC <= $ladoB || $ladoB + $ladoC <= $ladoA) {
            echo "<p>Los lados no forman un triángulo válido.</p>";
        } elseif ($ladoA == $ladoB && $ladoB == $ladoC) {
            echo "<p>El triángulo es equilátero.</p>";
        } elseif ($ladoA == $ladoB || $ladoA == $ladoC || $ladoB == $ladoC) {
            echo "<p>El triángulo es isósceles.</p>";
        } else {
            echo "<p>El triángulo es escaleno.</p>";
        }
    }


/*
10- Haz un programa PHP que resuelva una ecuación de segundo grado
siempre que los resultados sean reales
PUNTOS DE INTERÉS: bifurcaciones if anidadas, operadores y funciones para
potencia y raíz cuadrada, testing intensivo con juegos de datos que buscan
deliberadamente “romper” la ejecución del programa
*/ 
    if ($iNumejercicio==10) { 
    
        echo "<h1>Ejercicio $iNumejercicio</h1>";
    
        // Coeficientes de la ecuación de segundo grado (ax^2 + bx + c = 0)
        $a = 1;
        $b = -3;
        $c = 2;
    
        // Calcular el discriminante
        $discriminante = $b**2 - 4 * $a * $c;
    
        // Verificar si las soluciones son reales
        if ($discriminante < 0) {
            echo "<p>No hay soluciones reales.</p>";
        } elseif ($discriminante == 0) {
            // Una solución real (raíz doble)
            $x = -$b / (2 * $a);
            echo "<p>Una solución real: x = " . number_format($x, 2) . "</p>";
        } else {
            // Dos soluciones reales
            $x1 = (-$b + sqrt($discriminante)) / (2 * $a);
            $x2 = (-$b - sqrt($discriminante)) / (2 * $a);
            echo "<p>Dos soluciones reales: x1 = " . number_format($x1, 2) . ", x2 = " . number_format($x2, 2) . "</p>";
        }
    }

/*
11- Mejora el intento anterior para que si alguno de los coeficientes a, b o c
fuera 0, el programa gestione el cálculo de resultados de manera más
adecuada:
● Si a=0, la ecuación no es de segundo grado, solo hay una raíz:
x =-c/b
● Si b=0, las raíces se calculan de manera más sencilla:
x1=-sqrt(-c/a) y x2=sqrt(-c/a)
● Si c=0, las raíces son, sacando factor común: x(ax+b)=0:
x1=0 y x2=-b/a
Aparte de esta casuística, hay que evitar dividir por cero…. Resuelve toda estas
posibilidades y refactoriza el código para que sea limpio y óptimo
PUNTOS DE INTERÉS: bifurcaciones if anidadas a varios niveles, validación de
datos y refactorización
*/
    if ($iNumejercicio==11) { 
    
        echo "<h1>Ejercicio $iNumejercicio</h1>";
    
        // Coeficientes de la ecuación de segundo grado (ax^2 + bx + c = 0)
        $a = 1;
        $b = -3;
        $c = 2;
    
        // Verificar si 'a' es cero
        if ($a == 0) {
            if ($b == 0) {
                echo "<p>No es una ecuación válida.</p>";
            } else {
                // Ecuación lineal: bx + c = 0
                $x = -$c / $b;
                echo "<p>Una solución (ecuación lineal): x = " . number_format($x, 2) . "</p>";
            }
        } else {
            // Calcular el discriminante
            $discriminante = $b**2 - 4 * $a * $c;
    
            // Verificar si las soluciones son reales
            if ($discriminante < 0) {
                echo "<p>No hay soluciones reales.</p>";
            } elseif ($discriminante == 0) {
                // Una solución real (raíz doble)
                $x = -$b / (2 * $a);
                echo "<p>Una solución real: x = " . number_format($x, 2) . "</p>";
            } else {
                // Dos soluciones reales
                $x1 = (-$b + sqrt($discriminante)) / (2 * $a);
                $x2 = (-$b - sqrt($discriminante)) / (2 * $a);
                echo "<p>Dos soluciones reales: x1 = " . number_format($x1, 2) . ", x2 = " . number_format($x2, 2) . "</p>";
            }
        }
    }

/*
12 - Realiza un programa php que, a partir de una nota numérica entera entre
1 y 10 devuelva:
● Sobresaliente si es 9 ó 10
● Notable si es 7 u 8
● Bien si es un 6
● Suficiente si es un 5
● Suspenso, si es 1,2,3 ó 4
3
Desarrollo Web en Entorno Servidor - IES Playamar - Pilar González Augusto
Utiliza la bifurcación múltiple o switch y comprueba que la nota esté en el
rango adecuado de valores permitidos (sea entera y entre 1 y 10)
PUNTOS DE INTERÉS: bifurcaciones múltiples, sentencia break y validación de
datos
*/
    if ($iNumejercicio==12) { 
    
        echo "<h1>Ejercicio $iNumejercicio</h1>";
    
        // Nota numérica de ejemplo
        $nota = 2; // Cambia este valor para probar diferentes casos
    
        // Validar que la nota esté en el rango adecuado
        if (!is_int($nota) || $nota < 1 || $nota > 10) {
            echo "<p>La nota debe ser un número entero entre 1 y 10.</p>";
        } else {
            // Utilizar switch para determinar la calificación
            switch ($nota) {
                case 9:
                case 10:
                    echo "<p>Calificación: Sobresaliente</p>";
                    break;
                case 7:
                case 8:
                    echo "<p>Calificación: Notable</p>";
                    break;
                case 6:
                    echo "<p>Calificación: Bien</p>";
                    break;
                case 5:
                    echo "<p>Calificación: Suficiente</p>";
                    break;
                case 1:
                case 2:
                case 3:
                case 4:
                    echo "<p>Calificación: Suspenso</p>";
                    break;
            }
        }
    }

/*
13- Haz un script PHP que calcule el factorial de un número natural (entero y
positivo). Haz que se muestren los cálculos que se van haciendo
PUNTOS DE INTERÉS: bucle for, contador, acumulador de productos, recorrido
hacia atrás, inicialización de acumulador para productos, validación de datos,
overflow
*/
    if ($iNumejercicio==13) { 
    
        echo "<h1>Ejercicio $iNumejercicio</h1>";
    
        // Número natural de ejemplo
        $numero = 5; // Cambia este valor para probar diferentes casos
    
        // Validar que el número sea un entero positivo
        if (!is_int($numero) || $numero < 0) {
            echo "<p>El número debe ser un entero positivo.</p>";
        } else {
            // Calcular el factorial
            $factorial = 1;
            echo "<p>Cálculo del factorial de $numero:</p>";
            for ($i = $numero; $i > 1; $i--) {
                $factorial *= $i;
                echo "<p>$i! = $i * " . ($i - 1) . "! = $factorial</p>";
            }
            echo "<p>El factorial de $numero es: $factorial</p>";
        }
    }

/*
14- Haz un programa PHP que calcule la suma de los n primeros números
naturales (siendo n entero y positivo)
PUNTOS DE INTERÉS: bucle for, contador, acumulador de sumas, recorrido hacia
adelante, inicialización de acumulador para sumas, validación de datos
*/
    if ($iNumejercicio==14) { 
    
        echo "<h1>Ejercicio $iNumejercicio</h1>";
    
        // Número natural de ejemplo
        $n = 10; // Cambia este valor para probar diferentes casos
    
        // Validar que el número sea un entero positivo
        if (!is_int($n) || $n < 0) {
            echo "<p>El número debe ser un entero positivo.</p>";
        } else {
            // Calcular la suma de los n primeros números naturales
            $suma = 0;
            echo "<p>Cálculo de la suma de los primeros $n números naturales:</p>";
            for ($i = 1; $i <= $n; $i++) {
                $suma += $i;
                echo "<p>Suma hasta $i: $suma</p>";
            }
            echo "<p>La suma de los primeros $n números naturales es: $suma</p>";
        }
    }

/*
15- Haz un programa php que te diga si un número entero y positivo es primo
o no
PUNTOS DE INTERÉS: bucle for vs bucle while, contador, salida abrupta de un
bucle (break, break n)
*/
    if ($iNumejercicio==15) { 
    
        echo "<h1>Ejercicio $iNumejercicio</h1>";
    
        // Número entero y positivo de ejemplo
        $numero = 29; // Cambia este valor para probar diferentes casos
    
        // Validar que el número sea un entero positivo
        if (!is_int($numero) || $numero < 1) {
            echo "<p>El número debe ser un entero positivo.</p>";
        } else {
            // Verificar si el número es primo
            $esPrimo = true;
            if ($numero == 1) {
                $esPrimo = false; // El 1 no es primo
            } else {
                for ($i = 2; $i <= sqrt($numero); $i++) {
                    if ($numero % $i == 0) {
                        $esPrimo = false;
                        break; // Salir del bucle si se encuentra un divisor
                    }
                }
            }
    
            // Mostrar el resultado
            if ($esPrimo) {
                echo "<p>El número $numero es primo.</p>";
            } else {
                echo "<p>El número $numero no es primo.</p>";
            }
        }
    }


/*
16- Haz un programa que muestre todos los divisores de un número entero y
positivo. Irá mostrando cada número que se prueba y si resulta ser divisor,
aparecerá marcado visiblemente, por ejemplo con otro color. Por ejemplo:
Divisores de 10:
1 2 3 4 5 6 7 8 9 10
PUNTOS DE INTERÉS: bucle while, contador, acumulador de resultados, formateo
de la salida con estilo, optimización, validación de datos
*/
    if ($iNumejercicio==16) { 
    
        echo "<h1>Ejercicio $iNumejercicio</h1>";
    
        // Número entero y positivo de ejemplo
        $numero = 28; // Cambia este valor para probar diferentes casos
    
        // Validar que el número sea un entero positivo
        if (!is_int($numero) || $numero < 1) {
            echo "<p>El número debe ser un entero positivo.</p>";
        } else {
            // Mostrar los divisores del número
            echo "<p>Divisores de $numero:</p>";
            for ($i = 1; $i <= $numero; $i++) {
                if ($numero % $i == 0) {
                    // Resaltar el divisor encontrado
                    echo "<span style='color: green; font-weight: bold;'>$i</span> ";
                } else {
                    echo "$i ";
                }
            }
            echo "</p>";
        }
    }

/*
17- Haz un script en PHP que calcule la división de dos números naturales
utilizando el algoritmo de Euclides para la división
PUNTOS DE INTERÉS: bucle while, contador, acumulador de restas, validación de
datos
*/
    if ($iNumejercicio==17) { 
    
        echo "<h1>Ejercicio $iNumejercicio</h1>";
    
        // Números naturales de ejemplo
        $dividendo = 20; // Cambia este valor para probar diferentes casos
        $divisor = 3; // Cambia este valor para probar diferentes casos
    
        // Validar que los números sean enteros positivos y que el divisor no sea cero
        if (!is_int($dividendo) || !is_int($divisor) || $dividendo < 0 || $divisor <= 0) {
            echo "<p>El dividendo debe ser un entero positivo y el divisor debe ser un entero positivo mayor que cero.</p>";
        } else {
            // Calcular la división utilizando restas sucesivas (algoritmo de Euclides)
            $cociente = 0;
            $resto = $dividendo;
    
            echo "<p>Cálculo de la división de $dividendo entre $divisor utilizando restas sucesivas:</p>";
            while ($resto >= $divisor) {
                $resto -= $divisor;
                $cociente++;
                echo "<p>Resta: Nuevo resto = $resto, Cociente = $cociente</p>";
            }
    
            // Mostrar el resultado final
            echo "<p>Resultado: Cociente = $cociente, Resto = $resto</p>";
        }
    }

/*
18- Haz un programa en PHP que calcule el máximo común divisor de dos
números naturales utilizando el algoritmo de Euclides
PUNTOS DE INTERÉS: bucle while, acumulador de restas, validación de datos
*/
    if ($iNumejercicio==18) { 
    
        echo "<h1>Ejercicio $iNumejercicio</h1>";
    
        // Números naturales de ejemplo
        $num1 = 48; // Cambia este valor para probar diferentes casos
        $num2 = 18; // Cambia este valor para probar diferentes casos
    
        // Validar que los números sean enteros positivos
        if (!is_int($num1) || !is_int($num2) || $num1 < 0 || $num2 < 0) {
            echo "<p>Ambos números deben ser enteros positivos.</p>";
        } else {
            // Calcular el máximo común divisor (MCD) utilizando el algoritmo de Euclides
            $a = $num1;
            $b = $num2;
    
            echo "<p>Cálculo del MCD de $num1 y $num2 utilizando el algoritmo de Euclides:</p>";
            while ($b != 0) {
                $resto = $a % $b;
                echo "<p>$a = $b * " . intdiv($a, $b) . " + $resto</p>";
                $a = $b;
                $b = $resto;
            }
    
            // Mostrar el resultado final
            echo "<p>El máximo común divisor (MCD) de $num1 y $num2 es: $a</p>";
        }
    }
/*
19- Haz un script PHP en el que conviertas en binario un número natural
decimal
4
Desarrollo Web en Entorno Servidor - IES Playamar - Pilar González Augusto
PUNTOS DE INTERÉS: bucle while, acumulador divisiones, acumulación de
cadenas, array_push(), validación de datos, testing
*/
    if ($iNumejercicio==19) { 
    
        echo "<h1>Ejercicio $iNumejercicio</h1>";
    
        // Número natural decimal de ejemplo
        $numeroDecimal = 13; // Cambia este valor para probar diferentes casos
    
        // Validar que el número sea un entero positivo
        if (!is_int($numeroDecimal) || $numeroDecimal < 0) {
            echo "<p>El número debe ser un entero positivo.</p>";
        } else {
            // Convertir el número decimal a binario
            $numero = $numeroDecimal;
            $binario = '';
    
            echo "<p>Conversión de $numeroDecimal a binario:</p>";
            if ($numero == 0) {
                $binario = '0';
            } else {
                while ($numero > 0) {
                    $resto = $numero % 2;
                    $binario = $resto . $binario; // Acumular el resto al inicio de la cadena
                    echo "<p>$numero / 2 = " . intdiv($numero, 2) . " con resto $resto</p>";
                    $numero = intdiv($numero, 2);
                }
            }
    
            // Mostrar el resultado final
            echo "<p>El número decimal $numeroDecimal en binario es: $binario</p>";
        }
    }

/*
20- Mejora el ejercicio anterior para que se pueda convertir a binario, octal o
hexadecimal
PUNTOS DE INTERÉS: bucle do-while, bucle while, acumulador divisiones,
acumulación de cadenas, array_push(), switch, validación de datos, testing
*/
    if ($iNumejercicio==20) { 
    
        echo "<h1>Ejercicio $iNumejercicio</h1>";
    
        // Número natural decimal de ejemplo
        $numeroDecimal = 255; // Cambia este valor para probar diferentes casos
        $base = 16; // Cambia este valor a 2 (binario), 8 (octal) o 16 (hexadecimal)
    
        // Validar que el número sea un entero positivo y que la base sea válida
        if (!is_int($numeroDecimal) || $numeroDecimal < 0 || !in_array($base, [2, 8, 16])) {
            echo "<p>El número debe ser un entero positivo y la base debe ser 2, 8 o 16.</p>";
        } else {
            // Convertir el número decimal a la base especificada
            $numero = $numeroDecimal;
            $resultado = '';
            $digitosHex = '0123456789ABCDEF';
    
            echo "<p>Conversión de $numeroDecimal a base $base:</p>";
            if ($numero == 0) {
                $resultado = '0';
            } else {
                while ($numero > 0) {
                    $resto = $numero % $base;
                    if ($base == 16) {
                        $resultado = $digitosHex[$resto] . $resultado; // Usar dígitos hexadecimales
                    } else {
                        $resultado = $resto . $resultado; // Acumular el resto al inicio de la cadena
                    }
                    echo "<p>$numero / $base = " . intdiv($numero, $base) . " con resto $resto</p>";
                    $numero = intdiv($numero, $base);
                }
            }
    
            // Mostrar el resultado final
            echo "<p>El número decimal $numeroDecimal en base $base es: $resultado</p>";
        }
    }
    ?>
</body>
</html>