#!/usr/bin/env python3
"""
tarea6.py - Listín telefónico usando un diccionario

Menú:
 a) Listado por orden de inserción
 b) Listado por orden alfabético
 c) Añadir contacto
 d) Modificar teléfono
 e) Buscar por teléfono
 f) Eliminar contacto
 g) Borrar listín
 h) Salir

Las letras pueden introducirse en mayúscula o minúscula.
"""

import sys


# Comentarios generales:
# Este script implementa un listín telefónico en memoria usando un diccionario
# de Python (clave: nombre del contacto, valor: teléfono). Proporciona un
# menú interactivo con las operaciones solicitadas: listar, añadir, modificar,
# buscar, eliminar, limpiar y salir. Las funciones trabajan directamente sobre
# el diccionario recibido como argumento.


def mostrar_menu():
    # Muestra las opciones del menú al usuario
    print('\nMENÚ DE OPCIONES')
    print('a) Listado de teléfonos (orden de inserción)')
    print('b) Listado de teléfonos (orden alfabético)')
    print('c) Añadir un nuevo contacto')
    print('d) Modificar el teléfono de un contacto')
    print('e) Buscar un número de teléfono')
    print('f) Eliminar un contacto')
    print('g) Borrar el listín telefónico')
    print('h) Salir')


def listar_por_insercion(dAgenda):
    # Lista los contactos en el orden de inserción.
    # Desde Python 3.7 el orden de inserción de dict está garantizado, por lo
    # que iterar dAgenda.items() devuelve los elementos en ese orden.
    if not dAgenda:
        print('(Listín vacío)')
        return
    for sNombre, sTelefono in dAgenda.items():
        print(f'{sNombre} - {sTelefono}')


def listar_alfabetico(dAgenda):
    # Lista los contactos ordenados alfabéticamente por nombre (case-insensitive)
    if not dAgenda:
        print('(Listín vacío)')
        return
    for sNombre in sorted(dAgenda.keys(), key=lambda x: x.lower()):
        print(f'{sNombre} - {dAgenda[sNombre]}')


def anadir_contacto(dAgenda):
    # Añade un nuevo contacto al diccionario. Si ya existe el nombre pregunta
    # si se desea actualizar el teléfono. Los nombres vacíos se rechazan.
    sNombre = input('Nombre del contacto: ').strip()
    if not sNombre:
        print('Nombre vacío. Operación cancelada.')
        return
    sTelefono = input('Teléfono: ').strip()
    if sNombre in dAgenda:
        sResp = input('El contacto ya existe. ¿Actualizar teléfono? (s/n): ').strip().lower()
        if sResp == 's':
            dAgenda[sNombre] = sTelefono
            print('Teléfono actualizado.')
        else:
            print('No se ha actualizado.')
    else:
        dAgenda[sNombre] = sTelefono
        print('Contacto añadido.')


def modificar_telefono(dAgenda):
    # Modifica el teléfono de un contacto existente. Si no existe pregunta si
    # se desea insertar como nuevo contacto.
    sNombre = input('Nombre del contacto a modificar: ').strip()
    if sNombre in dAgenda:
        sNuevo = input('Introduce nuevo teléfono: ').strip()
        dAgenda[sNombre] = sNuevo
        print('Teléfono actualizado.')
    else:
        sResp = input('El contacto no existe. ¿Desea insertarlo? (s/n): ').strip().lower()
        if sResp == 's':
            sTelefono = input('Teléfono: ').strip()
            dAgenda[sNombre] = sTelefono
            print('Contacto añadido.')
        else:
            print('Operación cancelada.')


def buscar_por_telefono(dAgenda):
    # Busca por número de teléfono. Como el diccionario está indexado por
    # nombre, realizamos una búsqueda lineal comprobando los valores.
    sTel = input('Introduce el número de teléfono a buscar: ').strip()
    encontrados = [s for s, t in dAgenda.items() if t == sTel]
    if encontrados:
        for s in encontrados:
            print(f'Número {sTel} corresponde a: {s}')
    else:
        print('Número no encontrado en el listín.')


def eliminar_contacto(dAgenda):
    # Elimina un contacto por nombre si existe.
    sNombre = input('Nombre del contacto a eliminar: ').strip()
    if sNombre in dAgenda:
        del dAgenda[sNombre]
        print('Contacto eliminado.')
    else:
        print('Contacto no encontrado.')


def borrar_listin(dAgenda):
    # Elimina todos los contactos del listín tras pedir confirmación.
    sResp = input('¿Seguro que deseas borrar todo el listín? (s/n): ').strip().lower()
    if sResp == 's':
        dAgenda.clear()
        print('Listín borrado.')
    else:
        print('Operación cancelada.')


def pausa():
    # Pausa para que el usuario pueda leer la salida antes de continuar.
    input('\nPulsa ENTER para continuar...')


def main():
    # Diccionario principal en memoria: clave = nombre (string), valor = teléfono (string).
    # Se podría mejorar guardando/recuperando desde un fichero para persistencia.
    dAgenda = {}

    while True:
        mostrar_menu()
        sOpcion = input('\nElige una opción: ').strip().lower()
        # Validación de la opción: solo a-h válidas
        if sOpcion not in list('abcdefgh'):
            print('Opción incorrecta. Elija una letra entre a y h.')
            continue
        if sOpcion == 'a':
            listar_por_insercion(dAgenda)
            pausa()
        elif sOpcion == 'b':
            listar_alfabetico(dAgenda)
            pausa()
        elif sOpcion == 'c':
            anadir_contacto(dAgenda)
            pausa()
        elif sOpcion == 'd':
            modificar_telefono(dAgenda)
            pausa()
        elif sOpcion == 'e':
            buscar_por_telefono(dAgenda)
            pausa()
        elif sOpcion == 'f':
            eliminar_contacto(dAgenda)
            pausa()
        elif sOpcion == 'g':
            borrar_listin(dAgenda)
            pausa()
        elif sOpcion == 'h':
            print('Saliendo...')
            break


if __name__ == '__main__':
    try:
        main()
    except KeyboardInterrupt:
        print('\nInterrumpido por el usuario. Saliendo...')
        sys.exit(0)
