<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relacion 1 - Hola mundo</title>
</head>
<body>

    <?php
    //1- Haz un programa en PHP que muestre el mensaje “Hello world” de diferentes formas:
    $fechayhora = getdate();
    $Tiempoactual = $fechayhora["mday"]."/".$fechayhora["mon"]."/".$fechayhora["year"]." ".$fechayhora['hours'].":".$fechayhora['minutes'].":".$fechayhora['seconds'];
    //como texto plano html
        echo "Hello world";
    // como un encabezado de nivel 2 html
        echo "<h2>Hello world</h2>";
    //como un párrafo con estilo: color, tipografía, alineación, 
        echo '<div style="text-align: center; color: #094;font font-family: Arial, sans-serif;">Hello world</div>';
    //con un salto de línea entre hello y world
        echo "Hello <br> world";
    //añádele la información sobre la instalación php (phpversion() y phpinfo()
        echo "<br> Version php: ".phpversion()."<br><br>";
    //investiga en la siguiente dirección como mostrar la fecha y la hora del sistema en el momento de la ejecución:
        echo "Fecha y hora actual: ".$Tiempoactual."<br><br>";
    //añádele la información sobre la instalación php (phpversion() y phpinfo()
        echo phpinfo();
    


    /*2- Haz un programa PHP que muestre un valor de ejemplo de cada tipo de
    dato escalar en php con echo utilizando la función var_dump(), y también
    con printf formateado.*/
        $entero = 42;
        $flotante = 3.14;
        $cadena = "Hello world";
        $booleano = true;

        echo "<br><br>Usando var_dump():<br>";
        var_dump($entero);
        var_dump($flotante);
        var_dump($cadena);
        var_dump($booleano);

         echo "<br><br>";
         
        echo "<br>Usando printf():<br>";
        printf("Entero: %d<br>", $entero);
        printf("Flotante: %.2f<br>", $flotante);
        printf("Cadena: %s<br>", $cadena);
        printf("Booleano: %s<br>", $booleano ? 'true' : 'false');

    /*3- Investiga qué y cuales son las superglobals en php
        (https://www.php.net/manual/es/language.variables.superglobals.php), y haz
        un programa que muestre, en forma de lista no numerada, para $_SERVER:
        ‘DOCUMENT-ROOT’
        ‘PHP-SELF’
        ‘SERVER-NAME’
        'SERVER_SOFTWARE'
        'SERVER_PROTOCOL'
        'HTTP_HOST'
        'HTTP_USER_AGENT'
        'REMOTE_ADDR'
        'REMOTE_PORT'
        'SCRIPT_FILENAME'
        'REQUEST_URI'
        Prueba un volcado con var_dump($_SERVER) y también con
        print_r($_SERVER). ¿Cuál es la diferencia? usar foreach*/
        echo "<br><br>Valores específicos de \$_SERVER:<br>";
        $claves = [
            'DOCUMENT_ROOT',
            'PHP_SELF',
            'SERVER_NAME',
            'SERVER_SOFTWARE',
            'SERVER_PROTOCOL',
            'HTTP_HOST',
            'HTTP_USER_AGENT',
            'REMOTE_ADDR',
            'REMOTE_PORT',
            'SCRIPT_FILENAME',
            'REQUEST_URI'
        ];
        echo "<ul>";
        foreach ($claves as $clave) {
            if (isset($_SERVER[$clave])) {
                echo "<li>$clave: " . $_SERVER[$clave] . "</li>";
            } else {
                echo "<li>$clave: No disponible</li>";
            }
        }
        echo "</ul>";

        echo "<br><br>La diferencia entre var_dump() y print_r() es que var_dump() proporciona información detallada sobre el tipo y el valor de cada elemento, mientras que print_r() ofrece una representación más legible pero menos detallada.";    
            

        /*4- En un programa PHP, declara un array constante en el que se almacenarán
            los días de la semana. Muestra por pantalla:
                ● el primer dia de la semana    
                ● todos los días secuencialmente
                ● lo mismo que el anterior, pero en formato de lista numerada*/
        const DIAS_SEMANA = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
        echo "<br><br>Primer día de la semana: ".DIAS_SEMANA[0]."<br>";
        echo "Todos los días de la semana:<br>";
        foreach (DIAS_SEMANA as $dia) {
            echo $dia." ";
        }
        echo "<br><br> Días de la semana en formato de lista numerada:<br>";
        echo "<ol>";
        foreach (DIAS_SEMANA as $dia) {
            echo "<li>".$dia."</li> ";
        }
        echo "</ol>";

        /*5- Crea un array asociativo constante, en el que utilices como clave el día de la
             semana, y como valor, la temperatura máxima de ese día en formato real. A
             continuación, muestra:
                ● la temperatura del primer dia de la semana
                ● la temperatura de todos los días, secuencialmente
                ● lo mismo que el anterior, pero en formato de lista numerada*/
        const TEMP_MAX_SEMANA = [
            "Lunes" => 20.5,        
            "Martes" => 22.0,
            "Miércoles" => 19.5,
            "Jueves" => 21.0,
            "Viernes" => 23.5,
            "Sábado" => 24.0,
            "Domingo" => 18.5
        ];
        echo "<br>Temperatura del primer día de la semana (Lunes): ".TEMP_MAX_SEMANA["Lunes"]."°C<br><br>";
        echo "Temperaturas de todos los días de la semana:<br>";
        foreach (TEMP_MAX_SEMANA as $dia => $temp) {
            echo $dia.": ".$temp."°C<br>";
        }
        echo "<br>Temperaturas de todos los días en formato de lista numerada:<br>";
        echo "<ol>";
        foreach (TEMP_MAX_SEMANA as $dia => $temp) {
            echo "<li>".$dia.": ".$temp."°C</li>";
        }
        echo "</ol>";
    ?>
    <table border="1">
        <tr>
            <th>Día</th>
            <th>Temperatura Máxima (°C)</th>
        </tr>
        <?php
            foreach (TEMP_MAX_SEMANA as $dia => $temp) {
                echo "<tr><td>$dia</td><td>$temp</td></tr>";
            }
        ?>

    <?php  
        /*7- Calcula la nota final de una persona a partir de la media de dos notasnuméricas iniciales, y descontando 0.25 por cada falta sin justificar. 
        Muestra el resultado por pantalla, indicando si la persona aprueba o suspende.*/
        $iNotaMates = 8.7;
        $iNotaLeng = 7.5;     
        $iFaltas = 3; //Faltas sin justificar
        $fNotaFinal = ($iNotaMates + $iNotaLeng) / 2 - ($iFaltas * 0.25);
        echo "<br>Nota final: ".$fNotaFinal."<br>";
        if ($fNotaFinal >= 5) {
            echo "<br>FELICIDADES ESTAS APROBADO<br>";
        }else {
            echo "<br>LO SIENTO, ESTAS SUSPENDIDO<br>";
        }
        /*8- Crea en un script PHP dos arrays asociativos paralelos, uno con la rúbrica de 4 calificaciones (inicial, primera, segunda y tercera) y otro con las notas particulares de una persona. A continuación, computará la nota final de esa persona, y muéstrala por pantalla.*/
        $aRubrica = [
            "inicial" => 0.1,
            "primera" => 0.25,
            "segunda" => 0.25,
            "tercera" => 0.4
        ];
        $aNotas = [
            "inicial" => 6.0,
            "primera" => 7.5,
            "segunda" => 8.0,
            "tercera" => 9.0
        ];
        $fNotaFinal = 0.0;
        foreach ($aRubrica as $clave => $peso) {
            if (isset($aNotas[$clave])) {
                $fNotaFinal += $aNotas[$clave] * $peso;
            }
        }
        echo "<br>Nota final computada: ".$fNotaFinal."<br>";
        /*9- En un programa PHP, valora a partir de los 3 lados de un triángulo si es equilátero, isósceles y escaleno, y muestra esa valoración por pantalla*/
            $lado1 = 5;
            $lado2 = 5;
            $lado3 = 5;
            if ($lado1 == $lado2 and $lado2 == $lado3) {
                echo "<br>El triángulo es equilátero<br>";
            } elseif ($lado1 == $lado2 or $lado1 == $lado3 or $lado2 == $lado3) {
                echo "<br>El triángulo es isósceles<br>";
            } else {
                echo "<br>El triángulo es escaleno<br>";
            }

        /*10- Haz un programa PHP que resuelva una ecuación de segundo grado siempre que los resultados sean reales*/
        $a = 1;
        $b = -4;
        $c = 2;

        $radical = $b ** 2  - 4 * $a * $c;

        if ($radical < 0) {
            echo "Las raices no son reales";
        } else {
            $x1 = (- $b + sqrt($radical)) / (2 * $a);
            $x2 = (- $b - sqrt($radical)) / (2 * $a);
            echo "<br>Las raices son reales:<br>";
            echo "x1 = ".$x1."<br>";
            echo "x2 = ".$x2."<br>";
        }
        /*11- Haz un script PHP que calcule el factorial de un número natural*/
        
        /*12- Haz un programa PHP que calcule la suma de los n primeros números naturales*/
        
        /*13- Haz un script en PHP que calcule la división de dos números naturales utilizando el algoritmo de Euclides para la división*/
        
        /*14- Haz un programa en PHP que calcule el máximo común divisor de dos números naturales utilizando el algoritmo de Euclides*/
        
        /*15- Haz un script PHP en el que conviertas en binario un número natural*/
    ?>
</body>
</html>