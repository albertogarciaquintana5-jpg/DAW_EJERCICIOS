<?php
/*
  ejercicio5.php
  Clase Restaurante con atributos: nombre, tipoCocina, ratings (array de enteros 1-5)
  Métodos: constructor, destructor, __toString, obtenerNumeroRatings, anadirRating,
           anadirRatings (varios), calcularRatingMedio
  Comentarios para examen incluidos.
*/

class Restaurante {
    // Atributos públicos para facilitar inspección en el ejercicio inicial
    public string $nombre;
    public string $tipoCocina;
    public array $ratings;

    // Constructor: recibe nombre y tipoCocina
    public function __construct(string $nombre, string $tipoCocina) {
        $this->nombre = $nombre;
        $this->tipoCocina = $tipoCocina;
        $this->ratings = [];
    }

    // Destructor: mensaje opcional
    public function __destruct() {
        // Comentario: no hacemos nada especial, pero incluimos el método
    }

    // Método mágico para mostrar de forma estructurada
    public function __toString(): string {
        $out  = "Restaurante: {$this->nombre}\n";
        $out .= "Tipo cocina: {$this->tipoCocina}\n";
        $out .= "Ratings: [" . implode(', ', $this->ratings) . "]\n";
        $out .= "Media: " . $this->calcularRatingMedio();
        return $out;
    }

    // Devuelve número de ratings
    public function obtenerNumeroRatings(): int {
        return count($this->ratings);
    }

    // Añade un rating entero entre 1 y 5
    public function anadirRating(int $valor): void {
        if ($valor < 1) $valor = 1;
        if ($valor > 5) $valor = 5;
        $this->ratings[] = $valor;
    }

    // Añade varios ratings a la vez (array de enteros)
    public function anadirRatings(array $valores): void {
        foreach ($valores as $v) {
            $this->anadirRating((int)$v);
        }
    }

    // Calcula la media (float) - devuelve 0 si no hay ratings
    public function calcularRatingMedio(): float {
        if (empty($this->ratings)) return 0.0;
        return array_sum($this->ratings) / count($this->ratings);
    }
}

// Código de prueba
$r = new Restaurante('La Buena Mesa', 'Mediterránea');
$r->anadirRating(5);
$r->anadirRatings([4,3,5]);
echo "<pre>" . htmlspecialchars($r->__toString(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . "</pre>";

?>
