// area.ts
function area(forma: string, ancho: number, alto: number) {
    var area = (forma == "triangulo") ? ancho * alto / 2 : ancho * alto;
    return "soy un " + forma + " con un area de " + area + " cm2.";
}

document.body.innerHTML += area("rectangulo", 30, 15);
