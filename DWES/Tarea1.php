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
        print_r($_SERVER). ¿Cuál es la diferencia?*/
        
        echo "<br><br>Información de \$_SERVER:<br>";
        echo "<ul>";
        echo "<li>DOCUMENT_ROOT: ".$_SERVER['DOCUMENT_ROOT']."</li>";
        echo "<li>PHP_SELF: ".$_SERVER['PHP_SELF']."</li>";
        echo "<li>SERVER_NAME: ".$_SERVER['SERVER_NAME']."</li>";
        echo "<li>SERVER_SOFTWARE: ".$_SERVER['SERVER_SOFTWARE']."</li>";
        echo "<li>SERVER_PROTOCOL: ".$_SERVER['SERVER_PROTOCOL']."</li>";
        echo "<li>HTTP_HOST: ".$_SERVER['HTTP_HOST']."</li>";
        echo "<li>HTTP_USER_AGENT: ".$_SERVER['HTTP_USER_AGENT']."</li>";
        echo "<li>REMOTE_ADDR: ".$_SERVER['REMOTE_ADDR']."</li>";
        echo "<li>REMOTE_PORT: ".$_SERVER['REMOTE_PORT']."</li>";
        echo "<li>SCRIPT_FILENAME: ".$_SERVER['SCRIPT_FILENAME']."</li>";
        echo "<li>REQUEST_URI: ".$_SERVER['REQUEST_URI']."</li>";
        echo "</ul>";

        echo "<br>Volcado con var_dump(\$_SERVER):<br>";
        var_dump($_SERVER);

        echo "<br><br>Volcado con print_r(\$_SERVER):<br>";
        print_r($_SERVER);

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
</body>
</html>