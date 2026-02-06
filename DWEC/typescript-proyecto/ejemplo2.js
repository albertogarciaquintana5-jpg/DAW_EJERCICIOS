// For...in y For...of
var list = [4, 5, 6];
console.log("For...in (indices):");
for (var i in list) {
    console.log(i); // "0", "1", "2",
}
console.log("\nFor...of (valores):");
for (var _i = 0, list_1 = list; _i < list_1.length; _i++) {
    var i = list_1[_i];
    console.log(i); // "4", "5", "6"
}
