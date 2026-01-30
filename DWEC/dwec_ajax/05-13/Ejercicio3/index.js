var miXHR;

window.onload = function () {
    miXHR = new objetoXHR();
    enviarPOST();
};

function enviarPOST() {
    if (miXHR) {
        miXHR.open("POST", "procesar.php", true);

        // MUY IMPORTANTE EN POST
        miXHR.setRequestHeader(
            "Content-Type",
            "application/x-www-form-urlencoded"
        );

        miXHR.onreadystatechange = function () {
            if (miXHR.readyState == 4 && miXHR.status == 200) {
                document.getElementById("resultado").innerHTML =
                    miXHR.responseText;
            }
        };

        // Datos que enviamos
        miXHR.send("nombre=ALberto&apellidos=Garcia Quintana");
    }
}
