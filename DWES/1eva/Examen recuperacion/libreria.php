<?php
function sumaDivisoresPropios(int $n): int {
    if ($n <= 1) {
        return 0;
    }

    $suma = 1;
    $lim = (int) floor(sqrt($n));

    for ($i = 2; $i <= $lim; $i++) {
        if ($n % $i === 0) {
            $otro = intdiv($n, $i);
            $suma += $i;
            if ($otro !== $i) {
                $suma += $otro;
            }
        }
    }

    return $suma;
}

function sonAmigos(int $num1, int $num2): bool {
    if ($num1 <= 0 || $num2 <= 0) {
        return false;
    }
    if ($num1 === $num2) {
        return false;
    }

    return (sumaDivisoresPropios($num1) === $num2) && (sumaDivisoresPropios($num2) === $num1);
}

?>