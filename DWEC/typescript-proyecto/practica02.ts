// Práctica 02 - Ejercicio 7
// Combinación de ejemplos 1 y 6 con formulario interactivo

// Tipo de datos para el ranking
type Ranking = [number, string, boolean];

// Array para almacenar los rankings
let hallOfFame: Array<Ranking> = [];
let position: number = 1;

// Función para agregar un jugador al ranking
function agregarJugador(): void {
    const inputNombre = document.getElementById('playerName') as HTMLInputElement;
    const inputTerminado = document.getElementById('finishedGame') as HTMLInputElement;
    
    if (inputNombre.value.trim() === '') {
        alert('Por favor, ingresa un nombre');
        return;
    }
    
    const ranking: Ranking = [
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
function ordenarRanking(): void {
    // Ordenar por nombre alfabéticamente
    hallOfFame.sort((a, b) => {
        if (a[1] < b[1]) return -1;
        if (a[1] > b[1]) return 1;
        return 0;
    });
    
    // Reajustar posiciones después de ordenar
    hallOfFame = hallOfFame.map((ranking, index) => {
        return [index + 1, ranking[1], ranking[2]];
    });
    
    position = hallOfFame.length + 1;
    mostrarRankings();
}

// Función para mostrar los rankings en la página
function mostrarRankings(): void {
    const resultado = document.getElementById('resultado') as HTMLDivElement;
    
    if (hallOfFame.length === 0) {
        resultado.innerHTML = '<p>No hay jugadores en el ranking</p>';
        return;
    }
    
    let html = '<h3>Hall of Fame:</h3><table border="1" cellpadding="10">';
    html += '<tr><th>Posición</th><th>Nombre</th><th>Juego Terminado</th></tr>';
    
    for (let ranking of hallOfFame) {
        html += `<tr>
            <td>${ranking[0]}</td>
            <td>${ranking[1]}</td>
            <td>${ranking[2] ? '✓ Sí' : '✗ No'}</td>
        </tr>`;
    }
    
    html += '</table>';
    resultado.innerHTML = html;
}

// Función para calcular área (del ejemplo 6)
function calcularArea(): void {
    const inputForma = document.getElementById('forma') as HTMLInputElement;
    const inputAncho = document.getElementById('ancho') as HTMLInputElement;
    const inputAlto = document.getElementById('alto') as HTMLInputElement;
    const resultadoArea = document.getElementById('resultadoArea') as HTMLDivElement;
    
    const forma = inputForma.value.toLowerCase();
    const ancho = parseFloat(inputAncho.value);
    const alto = parseFloat(inputAlto.value);
    
    if (isNaN(ancho) || isNaN(alto)) {
        alert('Por favor, ingresa valores numéricos válidos');
        return;
    }
    
    const area = (forma === "triangulo") ? ancho * alto / 2 : ancho * alto;
    resultadoArea.innerHTML = `<p>Soy un <strong>${forma}</strong> con un área de <strong>${area} cm²</strong></p>`;
}

// Event Listeners
window.onload = function() {
    const btnAgregar = document.getElementById('btnAgregar');
    const btnOrdenar = document.getElementById('btnOrdenar');
    const btnCalcular = document.getElementById('btnCalcular');
    
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
    const inputNombre = document.getElementById('playerName') as HTMLInputElement;
    if (inputNombre) {
        inputNombre.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                agregarJugador();
            }
        });
    }
};
