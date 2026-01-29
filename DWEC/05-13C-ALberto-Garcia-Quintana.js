//EJ1

// Simulaciones (devuelven Promesa)
function cargarArticulosRecientes() {
  return new Promise(resolve => setTimeout(() => resolve("Artículos recientes cargados"), 1500));
}
function cargarVentasDelMes() {
  return new Promise(resolve => setTimeout(() => resolve("Ventas del mes cargadas"), 2000));
}
function cargarImagenPerfil() {
  return new Promise(resolve => setTimeout(() => resolve("Imagen de perfil cargada"), 500));
}

// Función principal usando await Promise.all()
async function cargarPanelDeControl() {
  const inicio = Date.now();
  const resultados = await Promise.all([
    cargarArticulosRecientes(),
    cargarVentasDelMes(),
    cargarImagenPerfil()
  ]);
  const tiempoSeg = ((Date.now() - inicio) / 1000).toFixed(3);
  console.log("Resultados:", resultados);
  console.log("Tiempo total:", tiempoSeg + " s"); // debería ser ~2.000 s (tarea más lenta)
}

// Ejecutar
cargarPanelDeControl();

//EJ2

// Versión que rechaza
function cargarVentasDelMesError() {
  return new Promise((_, reject) => setTimeout(() => reject("Error de conexión con la base de datos de ventas"), 2000));
}

async function cargarPanelDeControlConErrores() {
  try {
    const inicio = Date.now();
    const resultados = await Promise.all([
      cargarArticulosRecientes(),
      cargarVentasDelMesError(), // aquí fallará
      cargarImagenPerfil()
    ]);
    console.log("Resultados:", resultados);
    console.log("Tiempo total:", ((Date.now() - inicio) / 1000).toFixed(3) + " s");
  } catch (err) {
    console.error("Error al cargar panel:", err); // captura y muestra el mensaje de error
  }
}

// Ejecutar
cargarPanelDeControlConErrores();


//EJ3
async function obtenerToken() {
  return new Promise(resolve => setTimeout(() => resolve("TOKEN_ABC"), 1000));
}

async function obtenerRecursos(token) {
  return new Promise(resolve => setTimeout(() => resolve(`Recursos cargados con token: ${token}`), 2000));
}

async function ejecutarFlujo() {
  const inicio = Date.now();
  const token = await obtenerToken();                 // espera 1s
  const recursos = await obtenerRecursos(token);      // luego espera 2s adicionales
  const tiempoSeg = ((Date.now() - inicio) / 1000).toFixed(3);
  console.log(token);
  console.log(recursos);
  console.log("Tiempo total (secuencial):", tiempoSeg + " s"); // ≈ 3.0 s
}

// Ejecutar
ejecutarFlujo();