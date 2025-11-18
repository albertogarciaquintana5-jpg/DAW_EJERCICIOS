import sys
from dataclasses import dataclass


@dataclass
class Persona:
    nombre: str
    direccion: str
    telefono: str

    def __str__(self):
        return f'Nombre: {self.nombre} Dirección: {self.direccion} Teléfono: {self.telefono}'


def mostrar_menu():
    print('\nMENÚ DE OPCIONES')
    print('a) Listado de contactos por orden alfabético')
    print('b) Añadir un nuevo contacto')
    print('c) Modificar un contacto')
    print('d) Buscar un número de teléfono')
    print('e) Eliminar un contacto')
    print('f) Salir')


def listar_alfabetico(dAgenda):
    """Muestra el listado ordenado alfabéticamente.

    Formato por línea: Nombre: xxx Dirección: xxx Teléfono: xxx
    """
    if not dAgenda:
        print('(Listín vacío)')
        return
    # Las claves son nombres en mayúsculas; ordenamos por la representación
    # 'nombre' que conserva las mayúsculas/minúsculas originales.
    items = sorted(dAgenda.items(), key=lambda kv: kv[0].lower())
    for clave, persona in items:
        print(persona)


def anadir_contacto(dAgenda):
    nombre = input('Nombre del contacto: ').strip()
    if not nombre:
        print('Nombre vacío. Operación cancelada.')
        return
    clave = nombre.upper()
    direccion = input('Dirección: ').strip()
    telefono = input('Teléfono: ').strip()

    if clave in dAgenda:
        resp = input('El contacto ya existe. ¿Actualizar teléfono? (s/n): ').strip().lower()
        if resp == 's':
            dAgenda[clave].telefono = telefono
            # opcional: actualizar dirección también
            if direccion:
                dAgenda[clave].direccion = direccion
            print('Teléfono (y dirección si se indicó) actualizados.')
        else:
            print('No se ha actualizado el contacto.')
    else:
        dAgenda[clave] = Persona(nombre=nombre, direccion=direccion, telefono=telefono)
        print('Contacto añadido.')


def modificar_contacto(dAgenda):
    nombre = input('Nombre del contacto a modificar: ').strip()
    if not nombre:
        print('Nombre vacío. Operación cancelada.')
        return
    clave = nombre.upper()
    if clave not in dAgenda:
        resp = input('El contacto no existe. ¿Desea insertarlo? (s/n): ').strip().lower()
        if resp != 's':
            print('Operación cancelada.')
            return
        # insertar nuevo
        direccion = input('Dirección: ').strip()
        telefono = input('Teléfono: ').strip()
        dAgenda[clave] = Persona(nombre=nombre, direccion=direccion, telefono=telefono)
        print('Contacto insertado.')
    else:
        direccion = input('Nueva dirección (dejar en blanco para mantener): ').strip()
        telefono = input('Nuevo teléfono (dejar en blanco para mantener): ').strip()
        if direccion:
            dAgenda[clave].direccion = direccion
        if telefono:
            dAgenda[clave].telefono = telefono
        print('Contacto actualizado.')


def buscar_por_telefono(dAgenda):
    telefono = input('Introduce el número de teléfono a buscar: ').strip()
    encontrados = [p for p in dAgenda.values() if p.telefono == telefono]
    if encontrados:
        for p in encontrados:
            print(f'Número {telefono} corresponde a: {p.nombre}')
    else:
        print('Número no encontrado en el listín.')


def eliminar_contacto(dAgenda):
    nombre = input('Nombre del contacto a eliminar: ').strip()
    if not nombre:
        print('Nombre vacío. Operación cancelada.')
        return
    clave = nombre.upper()
    if clave in dAgenda:
        del dAgenda[clave]
        print('Contacto eliminado.')
    else:
        print('Contacto no encontrado.')


def pausa():
    input('\nPulsa ENTER para continuar...')


def main():
    dAgenda = {}

    # Datos de ejemplo (opcional)
    dAgenda['MARÍA'] = Persona(nombre='María', direccion='C/ Falsa 1', telefono='600111222')
    dAgenda['ÁLVARO'] = Persona(nombre='Álvaro', direccion='Plaza Mayor 3', telefono='600333444')
    dAgenda['ANA'] = Persona(nombre='ana', direccion='Av. Siempre Viva 5', telefono='600555666')

    while True:
        mostrar_menu()
        opcion = input('\nElige una opción: ').strip().lower()
        if opcion not in list('abcdef'):
            print('Opción incorrecta. Elija una letra entre a y f.')
            continue
        if opcion == 'a':
            listar_alfabetico(dAgenda)
            pausa()
        elif opcion == 'b':
            anadir_contacto(dAgenda)
            pausa()
        elif opcion == 'c':
            modificar_contacto(dAgenda)
            pausa()
        elif opcion == 'd':
            buscar_por_telefono(dAgenda)
            pausa()
        elif opcion == 'e':
            eliminar_contacto(dAgenda)
            pausa()
        elif opcion == 'f':
            print('Saliendo...')
            break


if __name__ == '__main__':
    try:
        main()
    except KeyboardInterrupt:
        print('\nInterrumpido por el usuario. Saliendo...')
        sys.exit(0)
