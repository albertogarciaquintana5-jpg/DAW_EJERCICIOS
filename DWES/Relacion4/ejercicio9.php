<?php
/*
  ejercicio9.php
  Redefinimos CuentaBancaria como abstracta y creamos CuentaDebito y CuentaCredito
  CuentaDebito: no permite saldo negativo (rechaza extracciones > saldo)
  CuentaCredito: permite saldo negativo hasta un límite (maxDescubierto)
*/

abstract class CuentaBancariaAbstract {
    protected string $numeroCuenta;
    protected string $titular;
    protected float $saldo;
    protected int $numOperaciones;

    public function __construct(string $numeroCuenta, string $titular) {
        $this->numeroCuenta = $numeroCuenta;
        $this->titular = $titular;
        $this->saldo = 0.0;
        $this->numOperaciones = 0;
    }

    abstract public function extraer(float $importe): bool;

    public function depositar(float $importe): void {
        if ($importe <= 0) return;
        $this->saldo += $importe;
        $this->numOperaciones++;
    }

    public function transferir(float $importe, CuentaBancariaAbstract $otra): bool {
        if ($this->extraer($importe)) {
            $otra->depositar($importe);
            return true;
        }
        return false;
    }

    public function __toString(): string {
        return "Cuenta: {$this->numeroCuenta} - Titular: {$this->titular} - Saldo: {$this->saldo} - Operaciones: {$this->numOperaciones}";
    }
}

class CuentaDebito extends CuentaBancariaAbstract {
    // No permite saldo negativo
    public function extraer(float $importe): bool {
        if ($importe <= 0) return false;
        if ($importe > $this->saldo) {
            // No hay suficiente saldo
            return false;
        }
        $this->saldo -= $importe;
        $this->numOperaciones++;
        return true;
    }
}

class CuentaCredito extends CuentaBancariaAbstract {
    private float $maxDescubierto;

    public function __construct(string $numeroCuenta, string $titular, float $maxDescubierto) {
        parent::__construct($numeroCuenta, $titular);
        $this->maxDescubierto = $maxDescubierto;
    }

    public function extraer(float $importe): bool {
        if ($importe <= 0) return false;
        if (($this->saldo - $importe) < -$this->maxDescubierto) {
            // Supera el descubierto permitido
            return false;
        }
        $this->saldo -= $importe;
        $this->numOperaciones++;
        return true;
    }
}

// Pruebas
$d = new CuentaDebito('ESD01', 'Pedro');
$c = new CuentaCredito('ESC01', 'María', 500.0);
$d->depositar(200);
$c->depositar(100);
// Intento extracción mayor que saldo en débito
var_export($d->extraer(300)); // false
echo '<br>';
// Crédito permite hasta descubierto
var_export($c->extraer(400)); // true (saldo 100 -> -300 dentro de 500 límite)
echo '<br>';
echo '<p>' . htmlspecialchars($d->__toString(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</p>';
echo '<p>' . htmlspecialchars($c->__toString(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</p>';

?>
