document.addEventListener("DOMContentLoaded", cargarPersonajes);

async function cargarPersonajes() {
  const lista = document.getElementById("personajes");

  try {
    const respuesta = await fetch("https://rickandmortyapi.com/api/character");
    const data = await respuesta.json();

    data.results.forEach(p => {
      const li = document.createElement("li");
      li.innerHTML = `
        <h3>${p.name}</h3>
        <img src="${p.image}" alt="${p.name}">
      `;
      lista.appendChild(li);
    });

  } catch (error) {
    console.error("Error al cargar:", error);
  }
}
