# Programa interactivo con varios ejercicios cortos de práctica en Python.
# Cada ejercicio está numerado del 1 al 10. Se pide al usuario que indique
# el número del ejercicio que quiere ejecutar y, según su elección, se
# solicita la información pertinente y se muestra el resultado.
#
# Comentarios: Uso de condicionales (if/elif/else), conversiones de tipo
# (int/float), manejo básico de errores con try/except y listas para
# acumular motivos en ejercicios más complejos.

iNum_ejer = int(input("Introduzca el numero del ejercicio: "))

# 1. Determinar si un número es par o impar: comprobamos el resto (%)
#    de la división entera entre 2.
if (iNum_ejer == 1):
    iNum = int(input("Introduzca un numero: "))
    if (iNum % 2 == 0):
        print("El numero es par.")
    else:
        print("El numero es impar.")

# 2. Mostrar el día de la semana según un número (1..7).
#    Se usa una serie de condicionales para mapear el número a nombre.
#    Si el número no está en el rango 1-7, mostramos un mensaje de error.
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

# 3. Leer tres números y mostrar el mayor y el menor.
#    Se comparan los tres valores para determinar el máximo y mínimo.
if (iNum_ejer == 3):
    iNum1 = float(input("Introduzca el primer numero: "))
    iNum2 = float(input("Introduzca el segundo numero: "))
    iNum3 = float(input("Introduzca el tercer numero: "))
    # Determinar el mayor
    if (iNum1 >= iNum2) and (iNum1 >= iNum3):
        print("El numero mayor es: ", iNum1)
    elif (iNum2 >= iNum1) and (iNum2 >= iNum3):
        print("El numero mayor es: ", iNum2)
    else:
        print("El numero mayor es: ", iNum3)
    # Determinar el menor
    if (iNum1 <= iNum2) and (iNum1 <= iNum3):
        print("El numero menor es: ", iNum1)
    elif (iNum2 <= iNum1) and (iNum2 <= iNum3):
        print("El numero menor es: ", iNum2)
    else:
        print("El numero menor es: ", iNum3)

# 4. División segura: pedir dividendo y divisor y controlar división por cero.
if (iNum_ejer == 4):
    iDividendo = float(input("Introduzca el dividendo: "))
    iDivisor = float(input("Introduzca el divisor: "))
    # Comprobamos que el divisor no sea cero antes de dividir
    if (iDivisor != 0):
        print("El resultado de la division es: ", iDividendo / iDivisor)
    else:
        print("Error. No se puede dividir entre 0.")

# 5. Precio de entrada según la edad:
#    - Menores de 5 años: gratis
#    - 5 <= edad < 18: 3€
#    - 18 <= edad < 65: 6€
#    - >=65: gratis (jubilados)
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

# 6. Convertir calificación numérica a calificación cualitativa
#    - Se controla también el rango válido (0 a 10) y valores extremos.
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

# 7. Saludo según la hora del día (horario 24h):
#    - [7,12): Buenos días
#    - [12,20): Buenas tardes
#    - resto: Buenas noches
if (iNum_ejer == 7):
    iHora = int(input("Introduzca la hora del dia (formato 24h): "))
    if (iHora >= 7) and (iHora < 12):
        print("Buenos dias")
    elif (iHora >= 12) and (iHora < 20):
        print("Buenas tardes")
    else:
        print("Buenas noches")

# 8. Determinar el número de días de un mes dado (1-12).
#    Se atiende la excepción de febrero (28 o 29 días) y se valida el rango.
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
# 9. Saber si un año es bisiesto:
#    - Un año es bisiesto si es divisible por 4.
#    - Si además es divisible por 100, debe ser divisible por 400 para ser bisiesto.
#    Este bloque muestra claramente la lógica en cascada.
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
# 10. Evaluación para donación de sangre.
#     Este ejercicio recoge múltiples parámetros del donante y valida cada
#     campo introducido. En caso de incumplimiento se añaden mensajes a la
#     lista 'razones' que explican por qué no debería donar.
if (iNum_ejer == 10):
    # Recogida de datos
    # 'sAyuna' indica si la persona está en ayunas (no recomendable para donar)
    sAyuna = input("¿Está en ayunas? (s/n): ").strip().lower()
    razones = []  # lista donde se almacenan las razones por las que no puede donar

    # Edad: debe estar entre 18 y 65 (incluidos)
    try:
        iEdad = int(input("Introduzca su edad: "))
        if not (18 <= iEdad <= 65):
            razones.append("Edad fuera del rango 18-65")
    except Exception:
        razones.append("Edad no válida")

    # Peso: debe ser mayor de 50 kg
    try:
        fPeso = float(input("Introduzca su peso en kg: "))
        if not (fPeso > 50):
            razones.append("Peso insuficiente (<= 50 kg)")
    except Exception:
        razones.append("Peso no válido")

    # Tensión arterial: comprobamos sistólica y diastólica dentro de rangos seguros
    try:
        iSistolica = int(input("Tensión sistólica (mm Hg) - valor alto: "))
        iDiastolica = int(input("Tensión diastólica (mm Hg) - valor bajo: "))
        if not (90 <= iSistolica <= 180):
            razones.append("Tensión sistólica fuera de 90-180 mm Hg")
        if not (50 <= iDiastolica <= 100):
            razones.append("Tensión diastólica fuera de 50-100 mm Hg")
    except Exception:
        razones.append("Valores de tensión no válidos")

    # Pulso: frecuencia cardíaca entre 50 y 110
    try:
        iPulso = int(input("Pulso (pulsaciones por minuto): "))
        if not (50 <= iPulso <= 110):
            razones.append("Pulso fuera de 50-110 pulsaciones")
    except Exception:
        razones.append("Pulso no válido")

    # Sexo y hemoglobina: los umbrales son distintos para hombres y mujeres
    sSexo = input("Sexo (H para hombre / M para mujer): ").strip().upper()
    try:
        fHemo = float(input("Valor de hemoglobina (g/L): "))
        if sSexo == 'H':
            if not (fHemo > 13.5):
                razones.append("Hemoglobina insuficiente para hombre (<= 13.5 g/L)")
        elif sSexo == 'M':
            if not (fHemo > 12.5):
                razones.append("Hemoglobina insuficiente para mujer (<= 12.5 g/L)")
        else:
            razones.append("Sexo no válido")
    except Exception:
        razones.append("Valor de hemoglobina no válido")

    # Plaquetas: más de 150.000 por cc
    try:
        iPlaquetas = int(input("Plaquetas (por cc): "))
        if not (iPlaquetas > 150000):
            razones.append("Plaquetas insuficientes (<= 150000 cc)")
    except Exception:
        razones.append("Valor de plaquetas no válido")

    # Proteínas totales: más de 6 gr/dl
    try:
        fProteinas = float(input("Proteínas totales (gr/dl): "))
        if not (fProteinas > 6.0):
            razones.append("Proteínas totales insuficientes (<= 6.0 gr/dl)")
    except Exception:
        razones.append("Valor de proteínas no válido")

    # No donar en ayunas: si la respuesta es afirmativa, lo añadimos como motivo
    if sAyuna in ('s', 'si'):
        razones.insert(0, "No debe donar en ayunas")

    # Resultado final: si no hay razones, el donante es apto
    if len(razones) == 0:
        print("Puede donar sangre. Todos los parámetros cumplen los requisitos.")
    else:
        print("No puede donar sangre por las siguientes razones:")
        for r in razones:
            print(" - ", r)