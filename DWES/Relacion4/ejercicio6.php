<?php
/*
  ejercicio6.php
  Versión de Restaurante con promoción de propiedades (PHP 8),
  atributos privados, getters/setters y static privado numeroRest.
*/

class Restaurante2 {
    // Promoción de propiedades en constructor (PHP 8+)
    private static int $numeroRest = 0;

    public function __construct(
        private string $nombre,
        private string $tipoCocina,
        private array $ratings = []
    ) {
        self::$numeroRest++;
    }

    public function __destruct() {
        // Comentario: destructor vacío
    }

    // Getters y setters
    public function getNombre(): string { return $this->nombre; }
    public function setNombre(string $n): void { $this->nombre = $n; }

    public function getTipoCocina(): string { return $this->tipoCocina; }
    public function setTipoCocina(string $t): void { $this->tipoCocina = $t; }

    public function getRatings(): array { return $this->ratings; }
    public function setRatings(array $r): void { $this->ratings = $r; }

    public function anadirRating(int $valor): void {
        if ($valor < 1) $valor = 1;
        if ($valor > 5) $valor = 5;
        $this->ratings[] = $valor;
    }

    public function anadirRatings(array $valores): void {
        foreach ($valores as $v) $this->anadirRating((int)$v);
    }

    public function obtenerNumeroRatings(): int { return count($this->ratings); }

    public function calcularRatingMedio(): float {
        if (empty($this->ratings)) return 0.0;
        return array_sum($this->ratings) / count($this->ratings);
    }

    public function __toString(): string {
        return "Restaurante: {$this->nombre} (" . $this->tipoCocina . ") - Media: " . $this->calcularRatingMedio();
    }

    // Método de clase para obtener número total de restaurantes creados
    public static function totalRests(): int {
        return self::$numeroRest;
    }
}

// Prueba
$a = new Restaurante2('El Fogón', 'Castellana');
$b = new Restaurante2('Sabor Vivo', 'Fusión');
$a->anadirRatings([5,4]);
echo "<p>" . htmlspecialchars($a->__toString(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . "</p>";
echo "<p>Total restaurantes: " . Restaurante2::totalRests() . "</p>";

?>
