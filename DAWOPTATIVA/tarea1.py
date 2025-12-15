iNum_ejer = int(input("Introduzca el numero del ejercicio: "))
# Programa de ejercicios básicos en Python.
# Selecciona el número del ejercicio (1-10) y se ejecutará la sección correspondiente.
# Incluye operaciones de entrada/salida, conversiones y uso de funciones básicas.

iNum_ejer = int(input("Introduzca el numero del ejercicio: "))

# 1. Leer un valor y mostrar su tipo con la función builtin `type()`.
if (iNum_ejer == 1):
    xValor = input("Introduzca un valor: ")
    # `input` siempre devuelve una cadena, por eso el tipo será `str` salvo conversión.
    print("El tipo de dato es: ", type(xValor))

# 2. Operaciones aritméticas básicas entre dos enteros.
#    Convertimos la entrada a `int` y aplicamos operadores aritméticos:
#    + suma (+), resta (-), multiplicación (*), división real (/)
#    + división entera (//), resto (%) y potencia (**)
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

# 3. Saludo personalizado: leer el nombre y concatenarlo en el mensaje.
if (iNum_ejer == 3):
    sNombre = input("Introduzca su nombre: ")
    # `print` puede recibir varios argumentos separados por comas
    print("Hola", sNombre, ",encantado de conocerte.")

# 4. Calcular la media aritmética de tres números (convertimos a float para
#    permitir decimales y evitar divisiones enteras no deseadas).
if (iNum_ejer == 4):
    iNum1 = float(input("Introduzca el primer numero: "))
    iNum2 = float(input("Introduzca el segundo numero: "))
    iNum3 = float(input("Introduzca el tercer numero: "))
    print("La media aritmetica es: ", (iNum1 + iNum2 + iNum3) / 3)

# 5. Mostrar el valor absoluto con la función `abs()`.
if (iNum_ejer == 5):
    iNum = float(input("Introduzca un numero: "))
    print("El valor absoluto es: ", abs(iNum))

# 6. Calcular la nota final ponderada usando porcentajes dados para cada evaluación.
if (iNum_ejer == 6):
    fNota1 = float(input("Introduzca la nota de la primera evaluacion: "))
    fNota2 = float(input("Introduzca la nota de la segunda evaluacion: "))
    fNota3 = float(input("Introduzca la nota de la tercera evaluacion: "))
    fNotaFinal = (fNota1 * 0.2) + (fNota2 * 0.35) + (fNota3 * 0.45)
    print("La nota final es: ", fNotaFinal)

# 7. Representación binaria: usar `bin()` y quitar el prefijo '0b' con slicing.
if (iNum_ejer == 7):
    iNum = int(input("Introduzca un numero: "))
    print("La representacion en codigo binario es: ", bin(iNum)[2:])

# 8. Repetir un texto cinco veces (la multiplicación de cadenas repite la cadena).
if (iNum_ejer == 8):
    sTexo = input("Introduzca un texto: ")
    print(sTexo * 5)

# 9. Longitud de una cadena: usar `len()` para conocer el número de caracteres.
if (iNum_ejer == 9):
    sTexto = input("Introduzca un texto: ")
    print("La longitud del texto es: ", len(sTexto))

# 10. Calcular edades futuras sumando al año actual los incrementos pedidos.
if (iNum_ejer == 10):
    iEdad = int(input("Introduzca su edad: "))
    print("Dentro de 5 años tendras: ", iEdad + 5)
    print("Dentro de 10 años tendras: ", iEdad + 10)
    print("Dentro de 15 años tendras: ", iEdad + 15)