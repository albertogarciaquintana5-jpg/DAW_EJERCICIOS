// For...in y For...of
let list = [4, 5, 6];

console.log("For...in (indices):");
for (let i in list) {
    console.log(i); // "0", "1", "2",
}

console.log("\nFor...of (valores):");
for (let i of list) {
    console.log(i); // "4", "5", "6"
}
