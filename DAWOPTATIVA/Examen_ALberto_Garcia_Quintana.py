"""
NOMBRE Y APELLIDO: ALberto García Quintana
"""
from typing import Dict, List

class Material:
	def __init__(self, id_: int, titulo: str, autor: str, año: int):
		self.id = id_
		self.titulo = titulo
		self.autor = autor
		self.año = año

	def detalles(self) -> str:
		return f"ID: {self.id} | Título: {self.titulo} | Autor: {self.autor} | Año: {self.año}"


class Libro(Material):
	GENEROS = ["Ficcion", "No Ficcion", "Terror", "Ciencia"]

	def __init__(self, id_: str, titulo: str, autor: str, año: int, genero: str, paginas: int):
		super().__init__(id_, titulo, autor, año)
		if genero not in Libro.GENEROS:
			raise ValueError(f"Género inválido. Opciones: {', '.join(Libro.GENEROS)}")
		if paginas <= 0:
			raise ValueError("El número de páginas debe ser mayor a 0.")
		self.genero = genero
		self.paginas = paginas

	def detalles(self) -> str:
		base = super().detalles()
		return f"{base} | Tipo: Libro | Género: {self.genero} | Páginas: {self.paginas}"


class Revista(Material):
	MESES = [
		"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
		"Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
	]

	def __init__(self, id_: str, titulo: str, autor: str, año: int, numero_edicion: int, mes_publicacion: str):
		super().__init__(id_, titulo, autor, año)
		if mes_publicacion not in Revista.MESES:
			raise ValueError(f"Mes inválido. Opciones: {', '.join(Revista.MESES)}. Importante las mayusculas")
		self.numero_edicion = numero_edicion
		self.mes_publicacion = mes_publicacion

	def detalles(self) -> str:
		base = super().detalles()
		return f"{base} | Tipo: Revista | Edición: {self.numero_edicion} | Mes: {self.mes_publicacion}"


materiales: Dict[str, Material] = {}
ids_existentes: List[str] = []


def leer_no_vacio(prompt: str) -> str:
	while True:
		v = input(prompt).strip()
		if v:
			return v
		print("Entrada vacía. Intente de nuevo.")


def agregar_material():
	print("Agregar Material. Elija tipo: 1) Libro  2) Revista")
	tipo = input("Tipo (1/2): ").strip()
	if tipo not in ("1", "2"):
		print("Opción inválida.")
		return

	
	try:
		id_ = int(leer_no_vacio("ID: "))
		if id_ <= 0:
			print("ID inválido")
			return
	except ValueError:
		print("ID inválido.")
		return
	
	if id_ in ids_existentes:
		print("Error: ID ya existe.")
		return

	titulo = leer_no_vacio("Título: ")
	autor = leer_no_vacio("Autor: ")
	try:
		año = int(leer_no_vacio("Año de publicación: "))
		if año <= 0:
			print("Año inválido")
			return
	except ValueError:
		print("Año inválido.")
		return

	try:
		if tipo == "1":
			print("Géneros disponibles:")
			for g in Libro.GENEROS:
				print("-", g)
			genero = leer_no_vacio("Género: ")
			paginas = int(leer_no_vacio("Número de páginas: "))
			libro = Libro(id_, titulo, autor, año, genero, paginas)
			materiales[id_] = libro
			ids_existentes.append(id_)
			print("Libro agregado correctamente.")
		else:
			numero_edicion = int(leer_no_vacio("Número de edición: "))
			print("Meses válidos:")
			for m in Revista.MESES:
				print("-", m)
			mes = leer_no_vacio("Mes de publicación: ")
			revista = Revista(id_, titulo, autor, año, numero_edicion, mes)
			materiales[id_] = revista
			ids_existentes.append(id_)
			print("Revista agregada correctamente.")
	except ValueError:
		print("Error al crear material, revise que respeta las mayusculas o los numero enteros mayores que 0.")


def listar_materiales():
	if not materiales:
		print("No hay materiales registrados.")
		return
	print("Listado de materiales:")
	for m in materiales.values():
		print("-", m.detalles())


def buscar_por_id():
	id_ = int(leer_no_vacio("ID a buscar: "))
	m = materiales.get(id_)
	if m:
		print("Material encontrado:")
		print(m.detalles())
	else:
		print("No existe material con ese ID.")


def eliminar_material():
	id_ = int(leer_no_vacio("ID a eliminar: "))
	if id_ in materiales:
		del materiales[id_]
		ids_existentes.remove(id_)
		print("Material eliminado.")
	else:
		print("ID no encontrado.")


def generar_estadisticas():
	total = len(materiales)
	num_libros = 0
	num_revistas = 0
	paginas_totales = 0
	for m in materiales.values():
		if isinstance(m, Libro):
			num_libros += 1
			paginas_totales += m.paginas
		elif isinstance(m, Revista):
			num_revistas += 1

	promedio_paginas = (paginas_totales / num_libros) if num_libros > 0 else 0
	print("--- Estadísticas ---")
	print("Total de materiales registrados:", total)
	print("Número de libros:", num_libros)
	print("Número de revistas:", num_revistas)
	if num_libros > 0:
		print(f"Promedio de páginas (libros): {promedio_paginas:.2f}")
	else:
		print("Promedio de páginas (libros): no hay paginas registradas.")


def contar_aparicion():
	palabra = leer_no_vacio("Introduce una palabra: ")
	palabra_minus = palabra.lower()
	conteo: Dict[str, int] = {}
	for ch in palabra_minus:
		conteo[ch] = conteo.get(ch, 0) + 1

	print("Conteo de caracteres (ordenado, ignorando mayúsculas):")
	for k in sorted(conteo.keys()):
		print(f"{k}: {conteo[k]}")

	if conteo:
		maxv = max(conteo.values())
		mas_repetidas = [k for k, v in conteo.items() if v == maxv]
		print("Caracteres que más se repiten:", ", ".join(mas_repetidas), f"({maxv} veces)")


def menu():
	opciones = {
		"a"or"A": (agregar_material, "Agregar Material."),
		"b"or"B": (listar_materiales, "Listar Materiales."),
		"c"or"C": (buscar_por_id, "Buscar Material por ID."),
		"d"or"D": (eliminar_material, "Eliminar Material."),
		"e"or"E": (generar_estadisticas, "Generar Estadísticas."),
		"f"or"F": (contar_aparicion, "Contar aparición"),
		"g"or"G": (None, "Salir.")
	}

	while True:
		print('\nFORMATO DEL MENÚ')
		print('a) Agregar Material.')
		print('b) Listar Materiales.')
		print('c) Buscar Material por ID.')
		print('d) Eliminar Material.')
		print('e) Generar Estadísticas.')
		print('f) Contar aparición')
		print('g) Salir.')
		elec = input('Elija una opción: ').strip().lower()
		if elec not in opciones:
			print('Opción no válida. Intente de nuevo.')
			continue
		if elec == 'g':
			print('Saliendo. ¡Hasta luego!')
			break
		func = opciones[elec][0]
		if func:
			func()


if __name__ == '__main__':
	menu()
