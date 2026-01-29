crearEvento(window, "load", iniciar);

function iniciar() {
    miXHR = new objetoXHR();
    cargarAsync("fecha.php");
}

function cargarAsync(url) {
    if (miXHR) {
        document.getElementById("indicador").innerHTML =
            "<img src='ajax-loader.gif'>";

        miXHR.open("GET", url, true);
        miXHR.onreadystatechange = estadoPeticion;
        miXHR.send(null);
    }
}

function estadoPeticion() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("indicador").innerHTML = "";
        textoDIV(document.getElementById("resultados"), this.responseText);
    }
}
