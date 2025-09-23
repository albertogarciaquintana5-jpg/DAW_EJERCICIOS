iNum_ejer = int(input("Introduzca el numero del ejercicio: "))

#1. Escribe un programa que recoja un número e indique si se trata de un número par o impar.
if (iNum_ejer == 1):
    iNum = int(input("Introduzca un numero: "))
    if (iNum % 2 == 0):
        print("El numero es par.")
    else:
        print("El numero es impar.")

#2. Escribe un programa que recoja un número por teclado y muestre el día de la semana que es (1 = Lunes, 2 = Martes...). En caso de introducir un número incorrecto, mostrará el mensaje “Día de la semana incorrecto”.
if (iNum_ejer == 2):
    iNum = int(input("Introduzca un numero: "))
    if (iNum == 1):
        print("Lunes")
    elif (iNum == 2):
        print("Martes")
    elif (iNum == 3):
        print("Miercoles")
    elif (iNum == 4):
        print("Jueves")
    elif (iNum == 5):
        print("Viernes")
    elif (iNum == 6):
        print("Sabado")
    elif (iNum == 7):
        print("Domingo")
    else:
        print("Dia de la semana incorrecto.")

#3. Escribe un programa que lea tres números y que muestre los números mayor y menor.
if (iNum_ejer == 3):
    iNum1 = float(input("Introduzca el primer numero: "))
    iNum2 = float(input("Introduzca el segundo numero: "))
    iNum3 = float(input("Introduzca el tercer numero: "))
    if (iNum1 >= iNum2) and (iNum1 >= iNum3):
        print("El numero mayor es: ", iNum1)
    elif (iNum2 >= iNum1) and (iNum2 >= iNum3):
        print("El numero mayor es: ", iNum2)
    else:
        print("El numero mayor es: ", iNum3)
    if (iNum1 <= iNum2) and (iNum1 <= iNum3):
        print("El numero menor es: ", iNum1)
    elif (iNum2 <= iNum1) and (iNum2 <= iNum3):
        print("El numero menor es: ", iNum2)
    else:
        print("El numero menor es: ", iNum3)

#4. Escribe un programa que recoja dividendo y divisor, y realice su división siempre que el divisor sea distinto de cero.
if (iNum_ejer == 4):
    iDividendo = float(input("Introduzca el dividendo: "))
    iDivisor = float(input("Introduzca el divisor: "))
    if (iDivisor != 0):
        print("El resultado de la division es: ", iDividendo / iDivisor)
    else:
        print("Error. No se puede dividir entre 0.")

#5. Escribe un programa que calcule el precio de entrada a un museo a partir de la edad del visitante, teniendo en cuenta que:
    #a. Menores de 5 años entran gratis.
    #b. Niños entre 5 años y 18 (sin llegar a los 18) pagan 3€.
    #c. Mayores de edad hasta los 65 (sin llegar a los 65) pagan 6€.
    #d. Jubilados entran gratis.
if (iNum_ejer == 5):
    iEdad = int(input("Introduzca su edad: "))
    if (iEdad < 5):
        print("La entrada es gratis.")
    elif (iEdad >= 5) and (iEdad < 18):
        print("El precio de la entrada es de 3€.")
    elif (iEdad >= 18) and (iEdad < 65):
        print("El precio de la entrada es de 6€.")
    else:
        print("La entrada es gratis.")

#6. Escribe un programa que muestre la nota final de un alumno a partir de su calificación numérica (valor decimal), teniendo en cuenta que:
    #a. Nota menor de 5 es suspenso.
    #b. Nota entre 5 y 6 (sin llegar) es suficiente.
    #c. Nota entre 6 y 7 (sin llegar) es bien.
    #d. Nota entre 7 y 9 (sin llegar) es notable.
    #e. Nota entre 9 y 10 (sin llegar) es sobresaliente.
    #f. Nota igual a 10 es matrícula de honor.
    #g. Cualquier otro valor numérico fuera de este rango es un error.
if (iNum_ejer == 6):
    fNota = float(input("Introduzca su nota: "))
    if (fNota < 5) and (fNota >= 0):
        print("Suspenso")
    elif (fNota >= 5) and (fNota < 6):
        print("Suficiente")
    elif (fNota >= 6) and (fNota < 7):
        print("Bien")
    elif (fNota >= 7) and (fNota < 9):
        print("Notable")
    elif (fNota >= 9) and (fNota < 10):
        print("Sobresaliente")
    elif (fNota == 10):
        print("Matricula de honor")
    else:
        print("Error. Nota incorrecta.")

#7. Escribe un programa que recoja la hora del día y devuelva un saludo, según las siguientes reglas:
#INTERVALO DE HORAS SALUDO
#[7,12) Buenos días
#[12, 20) Buenas tardes
#En otro caso Buenas noches
if (iNum_ejer == 7):
    iHora = int(input("Introduzca la hora del dia (formato 24h): "))
    if (iHora >= 7) and (iHora < 12):
        print("Buenos dias")
    elif (iHora >= 12) and (iHora < 20):
        print("Buenas tardes")
    else:
        print("Buenas noches")

#8. Escribe un programa que recoja un mes del año (en número) y devuelva el número de días que tiene el mes. En caso de indicar un mes incorrecto deberá mostrar un mensaje de error.
if (iNum_ejer == 8):
    iMes = int(input("Introduzca un mes del año (1-12): "))
    if (iMes == 1) or (iMes == 3) or (iMes == 5) or (iMes == 7) or (iMes == 8) or (iMes == 10) or (iMes == 12):
        print("El mes tiene 31 dias.")
    elif (iMes == 4) or (iMes == 6) or (iMes == 9) or (iMes == 11):
        print("El mes tiene 30 dias.")
    elif (iMes == 2):
        print("El mes tiene 28 o 29 dias.")
    else:
        print("Error. Mes incorrecto.")
#9. Escribe un programa que recoja un año e indique si se trata de un año bisiesto o no. Un año es bisiesto si cumple estas condiciones:
    #a. El año es divisible por 4.
    #b. Si además el año es divisible por 100, debe ser también divisible por 400.
#Ejemplos:
#- 1992 es bisiesto (cumple el caso a. Al no ser divisible por 100 no aplica el caso b)
#- 2023 no es bisiesto (no cumple ningún caso)
#- 2000 es bisiesto (cumple los casos a y b)
#- 1900 no es bisiesto (cumple el caso a, pero no el b porque es divisible por 100 y no por 400)
if (iNum_ejer == 9):
    iAño = int(input("Introduzca un año: "))
    if (iAño % 4 == 0):
        if (iAño % 100 == 0):
            if (iAño % 400 == 0):
                print("El año es bisiesto.")
            else:
                print("El año no es bisiesto.")
        else:
            print("El año es bisiesto.")
    else:
        print("El año no es bisiesto.")



#10.Escribe un programa que a partir de información de un donante determine si puede donar sangre. Las condiciones para donar son:
    #a. No se debe donar en ayunas.
    #b. Edad: Comprendida entre los 18 y 65 años.
    #c. Peso: Superior a 50kg.
    #d. Tensión arterial: dentro de límites adecuados para la extracción.
    #i. Tensión diastólica (baja): entre 50mm Hg y 100 mm Hg
    #ii. Tensión sistólica (alta): entre 90mm y 180mm Hg
    #e. Pulso (frecuencia cardiaca): entre 50 y 110 pulsaciones
    #f. Valores de hemoglobina:
    #i. En hombres: superior a 13,5 gramos por litro
    #ii. En mujeres: superior a 12,5 gramos por litro.
    #g. Plaquetas: más de 150.000 cc
    #h. Proteínas totales: más de 6 gr/dl.
if (iNum_ejer == 10):
    sAyuna = input("Esta usted")