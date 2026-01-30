function objetoXHR() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
}

var crearEvento = function () {
    return function (elemento, evento, funcion) {
        elemento.addEventListener(evento, funcion, false);
    };
}();

function textoDIV(nodo, texto) {
    nodo.innerHTML = texto;
}
