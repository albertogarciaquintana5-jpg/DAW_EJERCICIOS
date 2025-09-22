#
iNum_ejer = int(input("Introduzca el numero del ejercicio: "))

#1. Escriba un programa que recoja un valor por teclado y muestre de qué tipo es. 
if (iNum_ejer == 1): 
    xValor = input("Introduzca un valor: ")
    print("El tipo de dato es: ", type(xValor))

#2. Escribe un programa que recoja dos números enteros por teclado y muestre los siguientes resultados: suma, resta, multiplicación división real, división entera, resto de la división entera y potencia. 
if (iNum_ejer == 2):
    iNum1 = int(input("Introduzca el primer numero: "))
    iNum2 = int(input("Introduzca el segundo numero: "))
    print("Suma: ", iNum1 + iNum2)
    print("Resta: ", iNum1 - iNum2)
    print("Multiplicacion: ", iNum1 * iNum2)
    print("Division real: ", iNum1 / iNum2)
    print("Division entera: ", iNum1 // iNum2)
    print("Resto de la division entera: ", iNum1 % iNum2)
    print("Potencia: ", iNum1 ** iNum2)

#3. Escribe un programa que pida el nombre del usuario y le responda con un saludo. En el saludo deberá utilizarse el nombre que introdujo el usuario. 
if (iNum_ejer == 3):
    sNombre = input("Introduzca su nombre: ")
    print("Hola", sNombre, ",encantado de conocerte.")

#4. Escribe un programa que recoja tres números y calcule su media aritmética.
if (iNum_ejer == 4):
    iNum1 = float(input("Introduzca el primer numero: "))
    iNum2 = float(input("Introduzca el segundo numero: "))
    iNum3 = float(input("Introduzca el tercer numero: "))
    print("La media aritmetica es: ", (iNum1 + iNum2 + iNum3) / 3)

#5. Escribe un programa que recoja un número y muestre su valor absoluto.
if (iNum_ejer == 5):
    iNum = float(input("Introduzca un numero: "))
    print("El valor absoluto es: ", abs(iNum))

#6. Escribe un programa que recoja las notas de las tres evaluaciones de un alumno. A continuación debe calcular y mostrar la nota final, teniendo en cuenta que la primera evaluación cuenta un 20% de la nota final, la segunda evaluación un 35% y la tercera evaluación un 45%.
if (iNum_ejer == 6):
    fNota1 = float(input("Introduzca la nota de la primera evaluacion: "))
    fNota2 = float(input("Introduzca la nota de la segunda evaluacion: "))
    fNota3 = float(input("Introduzca la nota de la tercera evaluacion: "))
    fNotaFinal = (fNota1 * 0.2) + (fNota2 * 0.35) + (fNota3 * 0.45)
    print("La nota final es: ", fNotaFinal)

#7. Escribe un programa que recoja un número y muestre su representación en código binario. 
if (iNum_ejer == 7):
    iNum = int(input("Introduzca un numero: "))
    print("La representacion en codigo binario es: ", bin(iNum)[2:])

#8. Escribe un programa que recoja un texto y lo muestre cinco veces consecutivas en la misma línea. 
if (iNum_ejer == 8):
    sTexo = input("Introduzca un texto: ")
    print(sTexo * 5)

#9. Escribe un programa que recoja un texto y que muestre su longitud, 
if (iNum_ejer == 9):
    sTexto = input("Introduzca un texto: ")
    print("La longitud del texto es: ", len(sTexto))

#10.Escribe un programa que recoja la edad del usuario y muestre la edad que tendrá dentro de 5, 10 y 15 años.
if (iNum_ejer == 10):
    iEdad = int(input("Introduzca su edad: "))
    print("Dentro de 5 años tendras: ", iEdad + 5)
    print("Dentro de 10 años tendras: ", iEdad + 10)
    print("Dentro de 15 años tendras: ", iEdad + 15)