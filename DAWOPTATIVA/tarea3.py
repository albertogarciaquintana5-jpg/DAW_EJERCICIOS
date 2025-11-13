#!/usr/bin/env python3
"""
tarea3.py
Soluciones a 10 ejercicios de práctica (entradas por teclado).

Cada función corresponde a un ejercicio. Al ejecutar el script se muestra
un menú para elegir qué ejercicio probar.
"""

def ejercicio1():
	# Ejercicio 1:
	# Lee un texto desde la entrada estándar y escribe cada letra en una línea
	# Ej: entrada "hola" -> salida:
	# h
	# o
	# l
	# a
	sTexto = input('Introduce un texto: ')
	for ch in sTexto:
		print(ch)


def ejercicio2():
	# Ejercicio 2:
	# Lee un número entero no negativo e imprime su factorial.
	# Maneja entradas no válidas y casos negativos mostrando mensajes.
	try:
		iN = int(input('Introduce un número entero (>=0) para calcular su factorial: '))
	except ValueError:
		print('Entrada no válida')
		return
	if iN < 0:
		print('Número negativo, factorial no definido')
		return
	iFact = 1
	for i in range(1, iN+1):
		iFact *= i
	print(f'Factorial de {iN} = {iFact}')


def ejercicio3():
	# Ejercicio 3:
	# Lee números hasta que el usuario introduzca 0. Luego muestra:
	# - número de valores introducidos (sin contar el 0)
	# - valor mínimo
	# - valor máximo
	# - suma de valores
	# - media aritmética
	# Las entradas no numéricas se ignoran con aviso.
	print('Introduce números (0 para terminar):')
	iCuenta = 0
	iMin = None
	iMax = None
	iSuma = 0
	while True:
		try:
			iVal = int(input())
		except ValueError:
			print('Entrada no válida, ignoro')
			continue
		if iVal == 0:
			break
		iCuenta += 1
		iSuma += iVal
		if iMin is None or iVal < iMin:
			iMin = iVal
		if iMax is None or iVal > iMax:
			iMax = iVal
	if iCuenta == 0:
		print('No se introdujeron valores (excepto 0)')
		return
	fMedia = iSuma / iCuenta
	print(f'Valores introducidos: {iCuenta}')
	print(f'Mínimo: {iMin}, Máximo: {iMax}, Suma: {iSuma}, Media: {fMedia}')


def ejercicio4():
	# Ejercicio 4:
	# Dado un número n, muestra un triángulo de altura n con asteriscos,
	# donde la i-ésima fila contiene i asteriscos.
	try:
		iN = int(input('Introduce un número (altura del triángulo): '))
	except ValueError:
		print('Entrada no válida')
		return
	for i in range(1, iN+1):
		print('*' * i)


def ejercicio5():
	# Ejercicio 5:
	# Muestra los cuadrados de 1 hasta n en una línea separados por espacios.
	try:
		iN = int(input('Introduce un número (mostrar cuadrados desde 1 hasta n): '))
	except ValueError:
		print('Entrada no válida')
		return
	l = [str(i*i) for i in range(1, iN+1)]
	print(' '.join(l))


def ejercicio6():
	# Ejercicio 6:
	# Muestra una tabla con r filas y c columnas numerando las celdas
	# de izquierda a derecha y de arriba a abajo.
	try:
		iFilas = int(input('Número de filas: '))
		iCols = int(input('Número de columnas: '))
	except ValueError:
		print('Entrada no válida')
		return
	i = 1
	for r in range(iFilas):
		fila = []
		for c in range(iCols):
			fila.append(str(i))
			i += 1
		print(' '.join(fila))


def ejercicio7():
	# Ejercicio 7:
	# Lee un texto y una letra, cuenta cuántas veces aparece esa letra en el texto.
	sTexto = input('Introduce un texto: ')
	sLetra = input('Introduce la letra a buscar: ')
	if len(sLetra) == 0:
		print('No se indicó letra')
		return
	sLetra = sLetra[0]
	iCuenta = 0
	for ch in sTexto:
		if ch == sLetra:
			iCuenta += 1
	print(f'La letra "{sLetra}" aparece {iCuenta} veces en el texto')


def ejercicio8():
	# Ejercicio 8:
	# Comprueba si un número es primo (mayor que 1 y sin divisores propios).
	try:
		iN = int(input('Introduce un número para comprobar si es primo: '))
	except ValueError:
		print('Entrada no válida')
		return
	if iN <= 1:
		print('No es primo')
		return
	import math
	bPrimo = True
	for d in range(2, int(math.sqrt(iN)) + 1):
		if iN % d == 0:
			bPrimo = False
			break
	print('Es primo' if bPrimo else 'No es primo')


def ejercicio9():
	# Ejercicio 9:
	# Pide un número impar (repite hasta obtener uno impar) y muestra una pirámide
	# de asteriscos cuya base tiene ese número de asteriscos.
	while True:
		try:
			iN = int(input('Introduce un número impar (base de la pirámide): '))
		except ValueError:
			print('Entrada no válida')
			continue
		if iN % 2 == 0:
			print('El número no es impar, pídelo de nuevo')
			continue
		break
	# Imprimimos la pirámide: filas con 1,3,5,... hasta iN
	for i in range(1, iN+1, 2):
		print('*' * i)


def ejercicio10():
	# Ejercicio 10:
	# Muestra un triángulo de secuencias decrecientes de números impares.
	# Si iN=5 se muestran 5 filas, la k-ésima fila contiene k impares terminando en 1,
	# por ejemplo fila 3 -> "5 3 1".
	try:
		iN = int(input('Introduce un número (numero de filas, ejemplo 5): '))
	except ValueError:
		print('Entrada no válida')
		return
	# Cada fila k tiene k números impares empezando por (2*k-1) y decreciendo hasta 1
	for k in range(1, iN+1):
		fila = [str(2*j-1) for j in range(k, 0, -1)]
		print(' '.join(fila))


def menu():
	acciones = {
		'1': ejercicio1,
		'2': ejercicio2,
		'3': ejercicio3,
		'4': ejercicio4,
		'5': ejercicio5,
		'6': ejercicio6,
		'7': ejercicio7,
		'8': ejercicio8,
		'9': ejercicio9,
		'10': ejercicio10,
	}
	while True:
		print('\nElige ejercicio (1-10) o Q para salir:')
		sOpcion = input('> ').strip()
		if sOpcion.lower() == 'q':
			break
		if sOpcion in acciones:
			acciones[sOpcion]()
		else:
			print('Opción no válida')


if __name__ == '__main__':
	menu()

