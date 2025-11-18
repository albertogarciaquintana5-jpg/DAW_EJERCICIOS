import sys
from dataclasses import dataclass


@dataclass
class Persona:
    def __init__(self, nombre="", apellidos="", dni="", edad=0):
        """
        Constructor de la clase Persona
        """
        self._nombre = nombre.upper() if nombre else ""
        self._apellidos = apellidos.upper() if apellidos else ""
        self._dni = dni.upper() if dni else ""
        self._edad = edad if edad >= 0 else 0
    
    # Setters con validación
    def set_nombre(self, nombre):
        """
        Setter para el nombre con validación
        """
        if nombre and isinstance(nombre, str):
            self._nombre = nombre.upper()
        else:
            raise ValueError("El nombre no puede estar vacío")
    
    def set_apellidos(self, apellidos):
        """
        Setter para los apellidos con validación
        """
        if apellidos and isinstance(apellidos, str):
            self._apellidos = apellidos.upper()
        else:
            raise ValueError("Los apellidos no pueden estar vacíos")
    
    def set_dni(self, dni):
        """
        Setter para el DNI con validación
        """
        if dni and isinstance(dni, str):
            self._dni = dni.upper()
        else:
            raise ValueError("El DNI no puede estar vacío")
    
    def set_edad(self, edad):
        """
        Setter para la edad con validación
        """
        if isinstance(edad, int) and edad >= 0:
            self._edad = edad
        else:
            raise ValueError("La edad debe ser un entero positivo")
    
    # Getters
    def get_nombre(self):
        """
        Getter para el nombre
        """
        return self._nombre
    
    def get_apellidos(self):
        """
        Getter para los apellidos
        """
        return self._apellidos
    
    def get_dni(self):
        """
        Getter para el DNI
        """
        return self._dni
    
    def get_edad(self):
        """
        Getter para la edad
        """
        return self._edad
    
    # Métodos adicionales
    def mostrar(self):
        """
        Muestra los datos de la persona
        """
        print(f"Nombre: {self._nombre}")
        print(f"Apellidos: {self._apellidos}")
        print(f"DNI: {self._dni}")
        print(f"Edad: {self._edad}")
    
    def mayor_de_edad(self):
        """
        Indica si la persona es mayor de edad
        """
        return self._edad >= 18
    
    def __str__(self):
        """
        Representación en string de la persona
        """
        return f"{self._nombre} {self._apellidos} (DNI: {self._dni}, Edad: {self._edad})"


# Ejemplo de uso y pruebas
if __name__ == "__main__":
    # Crear una persona con datos iniciales
    persona1 = Persona("Juan", "Pérez García", "12345678A", 25)
    
    print("=== Persona 1 ===")
    persona1.mostrar()
    print(f"¿Es mayor de edad? {persona1.mayor_de_edad()}")
    print()
    
    # Crear una persona con datos vacíos y luego asignarlos
    persona2 = Persona()
    
    # Usando setters
    try:
        persona2.set_nombre("María")
        persona2.set_apellidos("López Martínez")
        persona2.set_dni("87654321B")
        persona2.set_edad(16)
    except ValueError as e:
        print(f"Error: {e}")
    
    print("=== Persona 2 ===")
    persona2.mostrar()
    print(f"¿Es mayor de edad? {persona2.mayor_de_edad()}")
    print()
    
    # Probando validaciones
    persona3 = Persona()
    
    try:
        persona3.set_nombre("")  # Esto debería lanzar una excepción
    except ValueError as e:
        print(f"Error al establecer nombre: {e}")
    
    try:
        persona3.set_edad(-5)  # Esto debería lanzar una excepción
    except ValueError as e:
        print(f"Error al establecer edad: {e}")
    
    # Usando getters
    print("\n=== Usando Getters ===")
    print(f"Nombre: {persona1.get_nombre()}")
    print(f"Apellidos: {persona1.get_apellidos()}")
    print(f"DNI: {persona1.get_dni()}")
    print(f"Edad: {persona1.get_edad()}")
