// main.js
import { create, createReportList } from './modules/canvas.js';
import { name, draw, reportArea, reportPerimeter } from './modules/square.js';
import randomSquare from './modules/square.js';

let myCanvas = create('myCanvas', document.body, 480, 320);
let reportList = createReportList(myCanvas.id);

let square1 = draw(myCanvas.ctx, 50, 50, 100, 'blue');
reportArea(square1.length, reportList);
reportPerimeter(square1.length, reportList);

// Use the default
let square2 = randomSquare(myCanvas.ctx);

// Dibujar con color picker
document.getElementById('btnDraw').addEventListener('click', function() {
    let color = document.getElementById('colorPick').value;
    let x = Math.floor(Math.random() * 400);
    let y = Math.floor(Math.random() * 220);
    let length = Math.floor(Math.random() * 50) + 20;
    let square = draw(myCanvas.ctx, x, y, length, color);
    reportArea(square.length, reportList);
    reportPerimeter(square.length, reportList);
});