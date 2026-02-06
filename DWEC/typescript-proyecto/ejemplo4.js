// Enum
var Roles;
(function (Roles) {
    Roles[Roles["Admin"] = 0] = "Admin";
    Roles[Roles["User"] = 1] = "User";
})(Roles || (Roles = {})); // Admin = 0, User = 1
var user = Roles.Admin;
console.log("Usuario admin (valor numérico):", user);
/*Por defecto enum inicia el valor de sus propiedades en "0..." , pero se puede modificar, en el
anterior ejemplo Admin sería 0, pero probablemente quiero que sea 1, de igual manera se pueden
modificar todos lo demás.*/
// Roles modificado
var Roles2;
(function (Roles2) {
    Roles2[Roles2["Admin"] = 1] = "Admin";
    Roles2[Roles2["User"] = 2] = "User";
})(Roles2 || (Roles2 = {}));
var user2 = Roles2.Admin; // Ahora User será 2
console.log("Usuario admin (valor 1):", user2);
console.log("Usuario User (valor 2):", Roles2.User);
// Modificando todos
var Roles3;
(function (Roles3) {
    Roles3[Roles3["Admin"] = 1] = "Admin";
    Roles3[Roles3["User"] = 3] = "User";
    Roles3[Roles3["Guest"] = 0] = "Guest";
})(Roles3 || (Roles3 = {}));
// Ahora, si tenemos el valor del enum pero no sabemos a que corresponde, podemos ir de un valor
// numérico a un texto.
var Roles4;
(function (Roles4) {
    Roles4[Roles4["Admin"] = 1] = "Admin";
    Roles4[Roles4["User"] = 2] = "User";
    Roles4[Roles4["Guest"] = 3] = "Guest";
})(Roles4 || (Roles4 = {}));
var userName = Roles4[1];
console.log("Nombre del rol con valor 1:", userName);
