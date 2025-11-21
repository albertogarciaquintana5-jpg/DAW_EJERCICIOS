<?php
/*
  ejercicio17.php
  Ejemplo de uso de traits para reutilizar funcionalidad en varias clases.
*/

trait LoggerTrait {
    public function log(string $msg): void {
        echo '<div style="font-family:monospace;color:gray;">[LOG] ' . htmlspecialchars($msg, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</div>';
    }
}

class ClaseA {
    use LoggerTrait;
    public function accion() { $this->log('ClaseA->accion ejecutada'); }
}

class ClaseB {
    use LoggerTrait;
    public function tarea() { $this->log('ClaseB->tarea ejecutada'); }
}

$a = new ClaseA();
$b = new ClaseB();
$a->accion();
$b->tarea();

?>
