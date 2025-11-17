import sys
import math
import random


    
def Ejercicioa():
    sTexto = input("introduzca una cadena de texto: ")
    sTextonuevo = ""
    for i in range(len(sTexto)):
         match sTexto[i]:
            case "a"|"e"|"i"|"o"|"u"|"á"|"é"|"í"|"ó"|"ú"|"A"|"E"|"I"|"O"|"U"|"Á"|"É"|"Í"|"Ó"|"Ú":
                sTextonuevo+= "*"
            case _:
                sTextonuevo+= sTexto[i]
    print("Tu texto pero sin vocales: "+sTextonuevo)

def Ejerciciob():
     iCantnumeros = int(input("cuantos numeros desea meter: "))
     iNum =[]
     iveces = 0
     while True:
        if iveces == iCantnumeros:
          iNum = int(input("Introduzca un numero: "))
          i = -1
          while True:
               i+=1
               o = i-1
               iNum2 = iNum[o]
               if iNum < iNum2:
                    print("Este numero es inferior al otro")
               else:
                    print(f', "{iNum[1]}"')
        iveces+=1
                
                    

def Ejercicioe():
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
     
def Ejerciciod():
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
			i = int(random.randrange(0,100))
		print(' '.join(fila))
	

#El ejercicio f se comprueba pulsando la f cuando pide una letra
     

def mostrar_menu():
    print("ELIGE UNA OPCION")
    print("a) Reemplazar vocales de una frase")
    print("b) Mensaje cuando el numero introducido no sea mayor que el primero")
    print("c) Encontrar la primera palabra más larga")
    print("d) Mostrar rectángulo con números impares entre 0 y 100 ")
    print("e) Contar la aparición de cada carácter en una palabra. Mostrar diccionario y el carácter con más apariciones.")
    print("f) Salir")

def pausar():
    """Pausa la ejecución hasta que se presione una tecla"""
    input("\nPresiona Enter para continuar...")

def pausa():
    # Pausa para que el usuario pueda leer la salida antes de continuar.
    input('\nPulsa ENTER para continuar...')

def main():
    while True:
        mostrar_menu()
        sOpcion = input('\nElige una opción: ').strip().lower()
        # Validación de la opción: solo a-h válidas
        if sOpcion not in list('abcdef'):
            print('Opción incorrecta. Elija una letra entre a y f.')
            continue
        if sOpcion == 'a':
            Ejercicioa()

        elif sOpcion == 'b':
            Ejerciciob()

        #elif sOpcion == 'c':
            
        elif sOpcion == 'd':
            Ejerciciod()

        elif sOpcion == 'e':
            Ejercicioe()

        elif sOpcion == 'f':

            print('Saliendo...')
            break


if __name__ == '__main__':
    try:
        main()
    except KeyboardInterrupt:
        print('\nInterrumpido por el usuario. Saliendo...')
        sys.exit(0)

     