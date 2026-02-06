// Enum
enum Roles { 
    Admin, 
    User
} // Admin = 0, User = 1

let user: Roles = Roles.Admin;
console.log("Usuario admin (valor numérico):", user);

/*Por defecto enum inicia el valor de sus propiedades en "0..." , pero se puede modificar, en el
anterior ejemplo Admin sería 0, pero probablemente quiero que sea 1, de igual manera se pueden
modificar todos lo demás.*/

// Roles modificado
enum Roles2 { 
    Admin = 1, 
    User
}
let user2: Roles2 = Roles2.Admin; // Ahora User será 2
console.log("Usuario admin (valor 1):", user2);
console.log("Usuario User (valor 2):", Roles2.User);

// Modificando todos
enum Roles3 { 
    Admin = 1, 
    User = 3, 
    Guest = 0 
}

// Ahora, si tenemos el valor del enum pero no sabemos a que corresponde, podemos ir de un valor
// numérico a un texto.
enum Roles4 { 
    Admin = 1, 
    User, 
    Guest 
}
let userName: string = Roles4[1] as string;
console.log("Nombre del rol con valor 1:", userName);
