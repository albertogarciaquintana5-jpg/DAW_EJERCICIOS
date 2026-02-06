// 2 - definición de variables
var position;
var playerName;
var finishedGame;
var ranking;
var hallOfFame = [];
// 3 - crea un ranking
position = 1;
playerName = "Bruno Krebs";
finishedGame = true;
ranking = [position, playerName, finishedGame];
hallOfFame.push(ranking);
// 4 - crea otro ranking
position = 2;
playerName = "Maria Helena";
finishedGame = true;
ranking = [position, playerName, finishedGame];
hallOfFame.push(ranking);
// 5 - define una funcion que recorre todos los rankings
function printRankings(rankings) {
    for (var _i = 0, rankings_1 = rankings; _i < rankings_1.length; _i++) {
        var ranking_1 = rankings_1[_i];
        console.log(ranking_1);
    }
}
// 6 - llama a la función
printRankings(hallOfFame);
