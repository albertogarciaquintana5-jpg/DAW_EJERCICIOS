"""
tarea5.py
Colección de funciones pequeñas para practicar manipulación de cadenas,
listas y operaciones básicas. Selecciona el ejercicio que quieras ejecutar
mediante la variable `iNumEjer`.

Comentarios incluidos para explicar qué hace cada función y cuáles son
sus parámetros/retornos, útiles como apuntes para examen.
"""

iNumEjer = int(input("introduce el ejercicio que quiera revisar: "))


# 1. Definir una función que, al recibir una cadena de texto, cuente cuántas vocales hay y devuelva dicho valor.
def cuenta_vocales(s: str) -> int:
     s = s.lower()
     return sum(s.count(v) for v in "aeiou")

if (iNumEjer == 1):
     sTexto = input("introduzca una cadena de texto: ")
     print(f"{sTexto} tiene un total de {cuenta_vocales(sTexto)} vocales")


# 2. Definir una función que, al recibir una cadena de texto, cuente cuántas palabras hay y devuelva dicho valor.
def cuenta_palabras(s: str) -> int:
     words = s.split()
     return len(words)

if (iNumEjer == 2):
     sTexto2 = input("introduzca una cadena de texto: ")
     print("Tu frase tiene", cuenta_palabras(sTexto2), "palabras")
    

# 3. Definir una función que devuelva la suma dos números. Utilizar esa función para sumar tres números.
def suma_dos(a: float, b: float) -> float:
     return a + b

if (iNumEjer == 3):
     a = float(input("introduce el primer número: "))
     b = float(input("introduce el segundo número: "))
     c = float(input("introduce el tercer número: "))
     s = suma_dos(suma_dos(a, b), c)
     print(f"La suma de {a}, {b} y {c} es {s}")


# 4. rota : (int, List[A]) -> List[A]
def rota(n: int, xs: list) -> list:
     if not xs:
          return []
     n = n % len(xs)
     return xs[n:] + xs[:n]

# Explicación: `rota` desplaza la lista hacia la izquierda n posiciones.
# Si n es mayor que la longitud, se usa el módulo para normalizar.

if (iNumEjer == 4):
     raw = input("introduce una lista de elementos separados por espacios: ")
     xs = raw.split()
     n = int(input("introduce n (número de posiciones a rotar): "))
     print(rota(n, xs))


# 5. rango : (List[int]) -> List[int]
def rango(xs: list) -> list:
     if not xs:
          return []
     return [min(xs), max(xs)]

# 6. interior : devuelve la lista sin el primer ni el último elemento.

if (iNumEjer == 5):
     raw = input("introduce una lista de números separados por espacios: ")
     xs = [int(x) for x in raw.split() if x]
     print(rango(xs))


# 6. interior : (list[A]) -> list[A]
def interior(xs: list) -> list:
     if len(xs) <= 2:
          return []
     return xs[1:-1]

if (iNumEjer == 6):
     raw = input("introduce una lista de elementos separados por espacios: ")
     xs = raw.split()
     print(interior(xs))


# 7. finales : (int, list[A]) -> list[A]
def finales(n: int, xs: list) -> list:
     if n <= 0:
          return []
     return xs[-n:] if n <= len(xs) else xs[:]

if (iNumEjer == 7):
     raw = input("introduce una lista de elementos separados por espacios: ")
     xs = raw.split()
     n = int(input("introduce n (número de elementos finales): "))
     print(finales(n, xs))


# 8. segmento : (int, int, list[A]) -> list[A]
def segmento(m: int, n: int, xs: list) -> list:
     # posiciones m..n inclusive, índices 1-based
     if m > n:
          return []
     # convert to 0-based
     start = max(0, m-1)
     end = min(len(xs), n)
     return xs[start:end]

# 9. extremos : devuelve los primeros n y últimos n elementos concatenados.

if (iNumEjer == 8):
     raw = input("introduce una lista de elementos separados por espacios: ")
     xs = raw.split()
     m = int(input("introduce m (inicio, 1-based): "))
     n = int(input("introduce n (fin, 1-based): "))
     print(segmento(m, n, xs))


# 9. extremos : (int, list[A]) -> list[A]
def extremos(n: int, xs: list) -> list:
     if n <= 0:
          return []
     first = xs[:n]
     last = xs[-n:] if n <= len(xs) else xs[:]
     return first + last

if (iNumEjer == 9):
     raw = input("introduce una lista de elementos separados por espacios: ")
     xs = raw.split()
     n = int(input("introduce n: "))
     print(extremos(n, xs))


# 10. mayorRectangulo : (tuple[float, float], tuple[float, float]) -> tuple[float, float]
def mayorRectangulo(r1: tuple, r2: tuple) -> tuple:
     a1 = r1[0] * r1[1]
     a2 = r2[0] * r2[1]
     return r1 if a1 >= a2 else r2

# 11. intercambia : swaps a tuple (x, y) -> (y, x). Levanta error si la tupla no tiene 2 elementos.

if (iNumEjer == 10):
     b1 = float(input("rect1 base: "))
     h1 = float(input("rect1 altura: "))
     b2 = float(input("rect2 base: "))
     h2 = float(input("rect2 altura: "))
     print(mayorRectangulo((b1, h1), (b2, h2)))


# 11. intercambia : (tuple[A, B]) -> tuple[B, A]
def intercambia(p: tuple) -> tuple:
     if len(p) != 2:
          raise ValueError("El punto debe tener dos coordenadas")
     return (p[1], p[0])

if (iNumEjer == 11):
     x = input("introduce dos valores separados por espacio (x y y): ").split()
     if len(x) < 2:
          print("Introduce dos valores")
     else:
          p = (x[0], x[1])
          print(intercambia(p))


# ----------------- Segundo PDF de ejercicios -----------------
# Continuación: más ejercicios (listado, palíndromos, ordenaciones...)
iNumEjer2 = int(input("introduce el ejercicio que quiera revisar del segundo pdf de ejercicios: "))

# 1. leer números hasta cero y mostrar en 3 modos
if (iNumEjer2 == 1):
     nums = []
     while True:
          v = int(input("introduce un entero (0 para terminar): "))
          if v == 0:
               break
          nums.append(v)
     print("En el orden introducido:", nums)
     print("En orden creciente:", sorted(nums))
     print("En orden decreciente:", sorted(nums, reverse=True))


# 2. repetir pero con textos hasta cadena vacía
if (iNumEjer2 == 2):
     texts = []
     while True:
          s = input("introduce un texto (enter solo para terminar): ")
          if s == "":
               break
          texts.append(s)
     print("En el orden introducido:", texts)
     print("En orden creciente:", sorted(texts))
     print("En orden decreciente:", sorted(texts, reverse=True))


# 3. palíndromo
def es_palindromo(s: str) -> bool:
     import re
     s_clean = re.sub(r"[^A-Za-z0-9]", "", s).lower()
     return s_clean == s_clean[::-1]

if (iNumEjer2 == 3):
     s = input("introduce un texto para comprobar si es palíndromo: ")
     print(es_palindromo(s))


# 4. comprobar si una es palíndromo de la otra (preguntar caso)
if (iNumEjer2 == 4):
     a = input("introduce la primera cadena: ")
     b = input("introduce la segunda cadena: ")
     opcion = input("¿Ignorar mayúsculas/minúsculas? (s/n): ")
     if opcion.lower().startswith('s'):
          a2 = a.lower()
          b2 = b.lower()
     else:
          a2 = a
          b2 = b
     # b es palíndromo de a si b == reverse(a)
     print(b2 == a2[::-1])

