// Generar SVG aleatorio
export function svgAleatorio() {
    let color = 'rgb(' + Math.floor(Math.random()*256) + ',' + Math.floor(Math.random()*256) + ',' + Math.floor(Math.random()*256) + ')';
    return '<svg width="100" height="100"><circle cx="50" cy="50" r="40" fill="' + color + '"></circle></svg>';
}