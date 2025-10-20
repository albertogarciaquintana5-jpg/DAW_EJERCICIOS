iNumEjer = int(input("introduce el ejercicio que quiera revisar: "))


# 1. Definir una función que, al recibir una cadena de texto, cuente cuántas vocales hay y devuelva dicho valor.
if (iNumEjer == 1):
    sTexto = input("introduzca una cadena de texto: ")
    iTotalVocales = sTexto.count("a")+sTexto.count("e")+sTexto.count("i")+sTexto.count("o")+sTexto.count("u")

    print(sTexto," tiene un total de ",iTotalVocales," vocales")

# 2. Definir una función que, al recibir una cadena de texto, cuente cuántas palabras hay y devuelva dicho valor.
if (iNumEjer == 2):
    sTexto2 = input("introduzca una cadena de texto: ")
    print(sTexto2.split(" "))

# 3. Definir una función que devuelva la suma dos números. Utilizar esa función para sumar tres números.
if (iNumEjer == 3):
     sTexto2 = input("introduzca una cadena de texto")

# 4. Definir la función rota : (int, List[A]) -> List[A]
# tal que rota(n, xs) es la lista obtenida poniendo los n primeros
# elementos de xs al final de la lista. Por ejemplo,
# rota(1, [3, 2, 5, 7]) == [2, 5, 7, 3]
# rota(2, [3, 2, 5, 7]) == [5, 7, 3, 2]
# rota(3, [3, 2, 5, 7]) == [7, 3, 2, 5]
# ---------------------------------------------------------------------
if (iNumEjer == 4):
     sTexto2 = input("introduzca una cadena de texto")

# 5. Definir la función
# rango : (List[int]) -> List[int]
# tal que rango(xs) es la lista formada por el menor y mayor elemento
# de xs.
# rango([3, 2, 7, 5]) == [2, 7]
# ---------------------------------------------------------------------
if (iNumEjer == 5):
     sTexto2 = input("introduzca una cadena de texto")

# 6. Definir la función
# interior : (list[A]) -> list[A]
# tal que interior(xs) es la lista obtenida eliminando los extremos de
# la lista xs. Por ejemplo,
# interior([2, 5, 3, 7, 3]) == [5, 3, 7]
# ---------------------------------------------------------------------
if (iNumEjer == 6):
     sTexto2 = input("introduzca una cadena de texto")

# 7. Definir la función
# finales : (int, list[A]) -> list[A]
# tal que finales(n, xs) es la lista formada por los n finales
# elementos de xs. Por ejemplo,
# finales(3, [2, 5, 4, 7, 9, 6]) == [7, 9, 6]
# ---------------------------------------------------------------------
if (iNumEjer == 7):
     sTexto2 = input("introduzca una cadena de texto")

# 8. Ejercicio 13. Definir la función
# segmento : (int, int, list[A]) -> list[A]
# tal que segmento(m, n, xs) es la lista de los elementos de xs
# comprendidos entre las posiciones m y n. Por ejemplo,
# segmento(3, 4, [3, 4, 1, 2, 7, 9, 0]) == [1, 2]
# segmento(3, 5, [3, 4, 1, 2, 7, 9, 0]) == [1, 2, 7]
# segmento(5, 3, [3, 4, 1, 2, 7, 9, 0]) == []
# ---------------------------------------------------------------------
if (iNumEjer == 8):
     sTexto2 = input("introduzca una cadena de texto")

# 9. Definir la función
# extremos : (int, list[A]) -> list[A]
# tal que extremos(n, xs) es la lista formada por los n primeros
# elementos de xs y los n finales elementos de xs. Por ejemplo,
# extremos(3, [2, 6, 7, 1, 2, 4, 5, 8, 9, 2, 3]) == [2, 6, 7, 9, 2, 3]
if (iNumEjer == 9):
     sTexto2 = input("introduzca una cadena de texto")

# 10. Las dimensiones de los rectángulos puede representarse
# por pares; por ejemplo, (5,3) representa a un rectángulo de base 5 y
# altura 3.
#
# Definir la función
# mayorRectangulo : (tuple[float, float], tuple[float, float])
# -> tuple[float, float]
# tal que mayorRectangulo(r1, r2) es el rectángulo de mayor área entre
# r1 y r2. Por ejemplo,
# mayorRectangulo((4, 6), (3, 7)) == (4, 6)
# mayorRectangulo((4, 6), (3, 8)) == (4, 6)
# mayorRectangulo((4, 6), (3, 9)) == (3, 9)
# ---------------------------------------------------------------------
if (iNumEjer == 10):
     sTexto2 = input("introduzca una cadena de texto")

# 11. Definir la función
# intercambia : (tuple[A, B]) -> tuple[B, A]
# tal que intercambia(p) es el punto obtenido intercambiando las
# coordenadas del punto p. Por ejemplo,
# intercambia((2,5)) == (5,2)
# intercambia((5,2)) == (2,5)
if (iNumEjer == 11):
     sTexto2 = input("introduzca una cadena de texto")


iNumEjer2 = int(input("introduce el ejercicio que quiera revisar del segundo pdf de ejercicios"))

#1. Escribe un programa que recoja números de teclado hasta que se introduce un cero Luegodebemostrar la secuencia de números de tres modos:
#a. En el orden en que se introdujeron.
#b. En orden creciente.
#c. En orden decreciente.
if (iNumEjer2 == 1):
     sTexto2 = input("introduzca una cadena de texto")
#Ejemplo: si se introduce 4 3 5 2 0, debe mostrarse:
#- 4 3 5 2
#- 2 3 4 5
#- 5 4 3 2


#2. Repite el ejercicio anterior, pero ahora lo que se leen son textos. La condiciónde finalización será la cadena vacía.
if (iNumEjer2 == 2):
     sTexto2 = input("introduzca una cadena de texto")
#3. Escribe un programa lea un texto y determine si es un palíndromo. Procura crear una función palindromo(s) -> Bool.
# NOTA: una cadena es palíndromo si se lee igual de izquierda a derecha que de derecha a izquierda. Por ejemplo, la palabra OSO es un palíndromo.
if (iNumEjer2 == 3):
     sTexto2 = input("introduzca una cadena de texto")
#4. Escribe un programa que lea dos textos y compruebe si una es palíndromo de la otra. El programa debe preguntar si se desea comprobar teniendo en cuenta mayúsculas/minúsculas o no.
if (iNumEjer2 == 4):
     sTexto2 = input("introduzca una cadena de texto")     
