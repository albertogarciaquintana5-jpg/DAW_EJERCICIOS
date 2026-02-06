// Práctica 02 - Ejercicio 7
// Combinación de ejemplos 1 y 6 con formulario interactivo
// Array para almacenar los rankings
var hallOfFame = [];
var position = 1;
// Función para agregar un jugador al ranking
function agregarJugador() {
    var inputNombre = document.getElementById('playerName');
    var inputTerminado = document.getElementById('finishedGame');
    if (inputNombre.value.trim() === '') {
        alert('Por favor, ingresa un nombre');
        return;
    }
    var ranking = [
        position,
        inputNombre.value,
        inputTerminado.checked
    ];
    hallOfFame.push(ranking);
    position++;
    // Limpiar inputs
    inputNombre.value = '';
    inputTerminado.checked = false;
    // Mostrar rankings
    mostrarRankings();
}
// Función para ordenar el ranking
function ordenarRanking() {
    // Ordenar por nombre alfabéticamente
    hallOfFame.sort(function (a, b) {
        if (a[1] < b[1])
            return -1;
        if (a[1] > b[1])
            return 1;
        return 0;
    });
    // Reajustar posiciones después de ordenar
    hallOfFame = hallOfFame.map(function (ranking, index) {
        return [index + 1, ranking[1], ranking[2]];
    });
    position = hallOfFame.length + 1;
    mostrarRankings();
}
// Función para mostrar los rankings en la página
function mostrarRankings() {
    var resultado = document.getElementById('resultado');
    if (hallOfFame.length === 0) {
        resultado.innerHTML = '<p>No hay jugadores en el ranking</p>';
        return;
    }
    var html = '<h3>Hall of Fame:</h3><table border="1" cellpadding="10">';
    html += '<tr><th>Posición</th><th>Nombre</th><th>Juego Terminado</th></tr>';
    for (var _i = 0, hallOfFame_1 = hallOfFame; _i < hallOfFame_1.length; _i++) {
        var ranking = hallOfFame_1[_i];
        html += "<tr>\n            <td>".concat(ranking[0], "</td>\n            <td>").concat(ranking[1], "</td>\n            <td>").concat(ranking[2] ? '✓ Sí' : '✗ No', "</td>\n        </tr>");
    }
    html += '</table>';
    resultado.innerHTML = html;
}
// Función para calcular área (del ejemplo 6)
function calcularArea() {
    var inputForma = document.getElementById('forma');
    var inputAncho = document.getElementById('ancho');
    var inputAlto = document.getElementById('alto');
    var resultadoArea = document.getElementById('resultadoArea');
    var forma = inputForma.value.toLowerCase();
    var ancho = parseFloat(inputAncho.value);
    var alto = parseFloat(inputAlto.value);
    if (isNaN(ancho) || isNaN(alto)) {
        alert('Por favor, ingresa valores numéricos válidos');
        return;
    }
    var area = (forma === "triangulo") ? ancho * alto / 2 : ancho * alto;
    resultadoArea.innerHTML = "<p>Soy un <strong>".concat(forma, "</strong> con un \u00E1rea de <strong>").concat(area, " cm\u00B2</strong></p>");
}
// Event Listeners
window.onload = function () {
    var btnAgregar = document.getElementById('btnAgregar');
    var btnOrdenar = document.getElementById('btnOrdenar');
    var btnCalcular = document.getElementById('btnCalcular');
    if (btnAgregar) {
        btnAgregar.addEventListener('click', agregarJugador);
    }
    if (btnOrdenar) {
        btnOrdenar.addEventListener('click', ordenarRanking);
    }
    if (btnCalcular) {
        btnCalcular.addEventListener('click', calcularArea);
    }
    // Permitir agregar con Enter en el input
    var inputNombre = document.getElementById('playerName');
    if (inputNombre) {
        inputNombre.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                agregarJugador();
            }
        });
    }
};
