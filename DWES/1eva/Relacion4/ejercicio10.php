<?php
/*
  ejercicio10.php
  Interfaz Encendible y clases Bombilla y Motocicleta que la implementan.
  Incluye función enciende_algo(Encendible $algo) de ejemplo solicitado.
*/

interface Encendible {
    public function encender(): void;
    public function apagar(): void;
}

class Bombilla implements Encendible {
    private string $tipoBombilla;
    private int $lumens;
    private bool $encendida = false;

    public function __construct(string $tipoBombilla, int $lumens) {
        $this->tipoBombilla = $tipoBombilla;
        $this->lumens = $lumens;
        $this->encendida = false;
    }

    public function __destruct() {}

    public function encender(): void {
        $this->encendida = true;
        echo "Bombilla ({$this->tipoBombilla}) encendida.<br>";
    }

    public function apagar(): void {
        $this->encendida = false;
        echo "Bombilla apagada.<br>";
    }
}

class Motocicleta implements Encendible {
    private float $gasolina;
    private int $bateria;
    private string $matricula;
    private bool $estado = false; // apagada

    public function __construct(string $matricula) {
        $this->matricula = $matricula;
        $this->gasolina = 0.0;
        $this->bateria = 2; // por defecto
        $this->estado = false;
    }

    public function cargarGasolina(float $litros): void {
        if ($litros > 0) $this->gasolina += $litros;
    }

    public function encender(): void {
        if ($this->estado) {
            echo "La moto ya está encendida.<br>";
            return;
        }
        if ($this->bateria <= 0) {
            echo "No hay batería suficiente para encender.<br>";
            return;
        }
        if ($this->gasolina <= 0) {
            echo "No hay gasolina para arrancar la moto.<br>";
            return;
        }
        $this->estado = true;
        echo "Motocicleta ({$this->matricula}) arrancada.<br>";
    }

    public function apagar(): void {
        if (!$this->estado) {
            echo "La moto ya está apagada.<br>";
            return;
        }
        $this->estado = false;
        echo "Motocicleta apagada.<br>";
    }
}

function enciende_algo(Encendible $algo): void {
    $algo->encender();
}

// Prueba
$miBombilla = new Bombilla('led', 12);
$miMoto = new Motocicleta('3873 NXB');
$miMoto->cargarGasolina(5);
enciende_algo($miBombilla);
enciende_algo($miMoto);

?>
