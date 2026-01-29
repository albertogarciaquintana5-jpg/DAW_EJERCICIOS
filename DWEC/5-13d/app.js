document.addEventListener("DOMContentLoaded", () => {
  const lista = document.getElementById("personajes");

  fetch("https://rickandmortyapi.com/api/character")
    .then(response => response.json())
    .then(data => {
      data.results.forEach(personaje => {
        const li = document.createElement("li");

        li.innerHTML = `
          <h3>${personaje.name}</h3>
          <img src="${personaje.image}" alt="${personaje.name}">
        `;

        lista.appendChild(li);
      });
    })
    .catch(error => {
      console.error("Error en la petición AJAX:", error);
    });
});

