<?php
/*
  ejercicio7.php
  Clase BanderaFranjas con orientación, lista de colores y nombre.
  Métodos: mostrar, comparar idénticas, comparar mismas franjas distinta orientación,
           invertir orden, invertir orientación.
*/

class BanderaFranjas {
    private bool $horizontal;
    private array $franjas; // array de cadenas con nombres de colores
    private string $nombre;

    public function __construct(bool $horizontal, array $franjas, string $nombre = 'sin adscripción') {
        $this->horizontal = $horizontal;
        $this->franjas = array_values($franjas);
        $this->nombre = $nombre;
    }

    public function __destruct() {}

    // Muestra la bandera como texto con orden de franjas y orientación
    public function mostrar(): string {
        $orient = $this->horizontal ? 'Horizontal' : 'Vertical';
        return "Bandera ({$this->nombre}) - Orientación: {$orient} - Franjas: [" . implode(', ', $this->franjas) . "]";
    }

    // Comprueba si dos banderas son idénticas (mismo orden y orientación)
    public function esIdentica(BanderaFranjas $otra): bool {
        return $this->horizontal === $otra->horizontal && $this->franjas === $otra->franjas;
    }

    // Comprueba si tienen mismas franjas pero diferente orientación u orden invertido
    public function mismasFranjasDistintaOrientacion(BanderaFranjas $otra): bool {
        // Misma lista de colores en igual orden, pero orientación distinta
        return $this->franjas === $otra->franjas && $this->horizontal !== $otra->horizontal;
    }

    // Invierte el orden de los colores
    public function invertirOrden(): void {
        $this->franjas = array_reverse($this->franjas);
    }

    // Invierte la orientación
    public function invertirOrientacion(): void {
        $this->horizontal = !$this->horizontal;
    }
}

// Pruebas
$b1 = new BanderaFranjas(true, ['rojo','blanco','azul'], 'Pais A');
$b2 = new BanderaFranjas(false, ['rojo','blanco','azul'], 'Pais B');
echo '<p>' . htmlspecialchars($b1->mostrar(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</p>';
echo '<p>' . htmlspecialchars($b2->mostrar(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</p>';
echo '<p>Identicas? ' . ($b1->esIdentica($b2) ? 'Sí' : 'No') . '</p>';
echo '<p>Mismas franjas diferente orientación? ' . ($b1->mismasFranjasDistintaOrientacion($b2) ? 'Sí' : 'No') . '</p>';
$b2->invertirOrientacion();
$b2->invertirOrden();
echo '<p>Tras invertir b2: ' . htmlspecialchars($b2->mostrar(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</p>';

?>
