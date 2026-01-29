// Importar y calcular
import { numAleatorio1 } from './num1.js';
import { numAleatorio2 } from './num2.js';
import { operacion } from './oper.js';

let a = numAleatorio1();
let b = numAleatorio2();
let c = operacion(a, b);
document.getElementById("show").innerHTML = 'a=' + a + ' b=' + b + ' c=' + c;