<?php
class Cola {
    private array $cola;
    private int $longitud;
    private int $elementos;

    public function __construct(int $longitudMaxima) {
        if ($longitudMaxima < 1){
            throw new InvalidArgumentException('La longitud debe ser >= 1');
        } 
        $this->cola = [];
        $this->longitud = $longitudMaxima;
        $this->elementos = 0;
    }

    public function ponerEnCola(mixed $item) {
        if ($this->elementos >= $this->longitud) {
            return null;
        }
        $this->cola[] = $item;
        $this->elementos++;
    }

    public function extraerDeCola(): mixed {
        if ($this->elementos === 0) return null;
        $item = array_shift($this->cola);
        $this->elementos--;
        return $item;
    }

    public function getElementos(): int {
        return $this->elementos;
    }

    public function __toString(): string {
        if ($this->elementos === 0) return "(0/{$this->longitud}) []";
        $repr = '[' . implode(', ', array_map(function($x){ return var_export($x, true); }, $this->cola)) . ']';
        return "({$this->elementos}/{$this->longitud}) " . $repr;
    }
}

?>