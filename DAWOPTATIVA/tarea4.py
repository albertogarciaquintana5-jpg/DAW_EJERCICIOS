import math

#1 MENU DE OPCIONES DE a A LA h
print("ELIGE UNA OPCION")
print("a) Mostrar un rombo.")
print("b) Adivinar un número.")
print("c) Resolver una ecuación de segundo grado.")
print("d) Tabla de números.")
print("e) Cálculo del número factorial de un número.")
print("f) Cálculo de un número de la sucesión de Fibonacci.")
print("g) Tabla de multiplicar")
print("h) Salir")
sEjercicio = input("Inserte una opcion poniendo su letra correspondiente: ")

def CrearRombo():
 print("Mostrando un rombo...")
        
 iNum = input("Introduzca la altura del rombo (número impar): ")
                 
 if (iNum % 2 == 0 or iNum.isnumeric == False):
    print("Error. El número debe ser impar.")
 else:
    for i in range(iNum//2 + 1):
        print(" " * (iNum//2 - i) + "*" * (2*i + 1))
    for i in range(iNum//2 - 1, -1, -1):
        print(" " * (iNum//2 - i) + "*" * (2*i + 1))
        
           

def AdivinarNum():
 import random

 iNumRandom = int(random.randrange(1,100)) 
 iNum = int(input("Adivine el numero del 1 al 100: "))
 

 while(iNumRandom != iNum):
    
    if (iNum > iNumRandom):
        print(iNum,"Es mayor que el numero secreto")
        iNum = int(input("Adivine el numero del 1 al 100: "))
    elif(iNum < iNumRandom):
        print(iNum,"Es menor que el numero secreto")
        iNum = int(input("Adivine el numero del 1 al 100: "))
    
 if(iNum == iNumRandom):
    print("FELICIDADES LO ACERTASTE, ES EL NUMERO: ",iNumRandom)


def Ecuacion2º():
    iNuma = int(input("ponga el numero que sustituye la 'a': "))
    iNumb = int(input("ponga el numero que sustituye la 'b': "))
    iNumc = int(input("ponga el numero que sustituye la 'c': "))

    if iNuma == 0 or iNumb == 0 or iNumc == 0:
        print("!NO PUEDES PONER SOLO EL NUMERO 0¡")
        Ecuacion2º()
            
    iCalcElevado = iNumb ** 2 - 4 * iNuma * iNumc
    iFormula2º = 2 * iNuma / (iNumb - math.sqrt(iCalcElevado))

    print ("Resultado de la operacion de 2 grado: ", iFormula2º)

#def TablaNumero():



match sEjercicio:

    case "a":
        CrearRombo()
 
    case "b":
        AdivinarNum()

    case "c":
        Ecuacion2º()

    case "d": 
        TablaNumero()   
    case "e":
        print ("")
    case "f":
        print ("")
    case "g":
        print ("")
    case "h":
        print("Saliendo del programa...")
        exit()
    case _:
        print("Opcion incorrecta. Saliendo del programa...")
        exit()

