<?php
/*
  ejercicio8.php
  Clase CuentaBancaria con atributos privados: numeroCuenta, titular, saldo, numOperaciones
  Métodos: constructor, destructor, __toString, depositar, extraer, transferir
*/

class CuentaBancaria {
    private string $numeroCuenta;
    private string $titular;
    private float $saldo;
    private int $numOperaciones;

    public function __construct(string $numeroCuenta, string $titular) {
        $this->numeroCuenta = $numeroCuenta;
        $this->titular = $titular;
        $this->saldo = 0.0;
        $this->numOperaciones = 0;
    }

    public function __destruct() {}

    public function __toString(): string {
        return "Cuenta: {$this->numeroCuenta} - Titular: {$this->titular} - Saldo: {$this->saldo} - Operaciones: {$this->numOperaciones}";
    }

    public function depositar(float $importe): void {
        if ($importe <= 0) return;
        $this->saldo += $importe;
        $this->numOperaciones++;
    }

    public function extraer(float $importe): bool {
        if ($importe <= 0) return false;
        // En esta clase base permitimos saldo negativo (este comportamiento se modificará en ejercicio 9)
        $this->saldo -= $importe;
        $this->numOperaciones++;
        return true;
    }

    public function transferir(float $importe, CuentaBancaria $otra): bool {
        if ($this->extraer($importe)) {
            $otra->depositar($importe);
            return true;
        }
        return false;
    }

    // Getters para pruebas
    public function getSaldo(): float { return $this->saldo; }
}

// Prueba
$c1 = new CuentaBancaria('ES001', 'Ana');
$c2 = new CuentaBancaria('ES002', 'Luis');
$c1->depositar(1000);
$c1->transferir(250, $c2);
echo '<p>' . htmlspecialchars($c1->__toString(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</p>';
echo '<p>' . htmlspecialchars($c2->__toString(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</p>';

?>
