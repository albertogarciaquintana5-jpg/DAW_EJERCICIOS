import math

# Menú principal: el usuario elige una letra para ejecutar la opción
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
    # Muestra un rombo de asteriscos cuya altura debe ser un número impar.
    print("Mostrando un rombo...")
    try:
        # Convertimos a entero y validamos impar
        iNum = int(input("Introduzca la altura del rombo (número impar): "))
    except ValueError:
        print("Error. Debes introducir un número entero.")
        return
    if iNum % 2 == 0:
        print("Error. El número debe ser impar.")
        return
    # Construcción del rombo: primera mitad (creciente) y segunda mitad (decreciente)
    for i in range(iNum // 2 + 1):
        print(" " * (iNum // 2 - i) + "*" * (2 * i + 1))
    for i in range(iNum // 2 - 1, -1, -1):
        print(" " * (iNum // 2 - i) + "*" * (2 * i + 1))
        
           

def AdivinarNum():
    # Juego: el programa genera un número aleatorio y el usuario intenta adivinarlo.
    import random

    iNumRandom = int(random.randrange(1, 101))  # rango 1..100 inclusive
    iNum = int(input("Adivine el numero del 1 al 100: "))

    # Bucle que termina cuando el usuario acierta
    while iNumRandom != iNum:
        if iNum > iNumRandom:
            print(iNum, "es mayor que el numero secreto")
        elif iNum < iNumRandom:
            print(iNum, "es menor que el numero secreto")
        # Pedimos otra entrada
        iNum = int(input("Adivine el numero del 1 al 100: "))

    # Cuando sale del bucle, el usuario ha acertado
    print("FELICIDADES LO ACERTASTE, ES EL NUMERO:", iNumRandom)


def Ecuacion2º():
    # Resolver ecuación cuadrática ax^2 + bx + c = 0 usando la fórmula general
    try:
        iNuma = float(input("ponga el numero que sustituye la 'a' (no 0): "))
        iNumb = float(input("ponga el numero que sustituye la 'b': "))
        iNumc = float(input("ponga el numero que sustituye la 'c': "))
    except ValueError:
        print("Entrada no válida")
        return

    if iNuma == 0:
        print("El coeficiente 'a' no puede ser 0 en una ecuación de segundo grado.")
        return

    # Calculamos el discriminante
    discriminante = iNumb ** 2 - 4 * iNuma * iNumc
    if discriminante < 0:
        print("No hay raíces reales (discriminante < 0).")
        return

    # Fórmula correcta: (-b ± sqrt(discriminante)) / (2*a)
    raiz = math.sqrt(discriminante)
    x1 = (-iNumb + raiz) / (2 * iNuma)
    x2 = (-iNumb - raiz) / (2 * iNuma)
    print("Soluciones reales:", x1, "y", x2)

#def TablaNumero():



match sEjercicio:
    case "a":
        CrearRombo()

    case "b":
        AdivinarNum()

    case "c":
        Ecuacion2º()

    case "d":
        # TablaNumero() no implementada aún
        print("Opción D no implementada todavía")

    case "e":
        print("Opción E no implementada todavía")

    case "f":
        print("Opción F no implementada todavía")

    case "g":
        print("Opción G no implementada todavía")

    case "h":
        print("Saliendo del programa...")
        exit()

    case _:
        print("Opcion incorrecta. Saliendo del programa...")
        exit()

