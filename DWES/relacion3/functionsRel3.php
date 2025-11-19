<?php
function swap(&$a, &$b) {
    $temp = $a;
    $a = $b;
    $b = $temp;
}

function invertirArray(&$arr) {
    $n = count($arr);
    for ($i = 0; $i < floor($n/2); $i++) {
        swap($arr[$i], $arr[$n - 1 - $i]);
    }
}
?>