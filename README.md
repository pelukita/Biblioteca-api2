# API de Gestión de Biblioteca

Elias Manuel Nuñez - tzanu007@gmail.com

API REST para la gestión de libros y fichas de préstamos en una biblioteca. La API proporciona operaciones CRUD completas para administrar el catálogo de libros y el registro de préstamos, incluyendo funcionalidades de ordenamiento.

## Endpoints

La URL base para todas las peticiones es `http://localhost/biblioteca/api/`

### Libros

| Verbo HTTP | Endpoint | ¿Qué hace? |
|------------|----------|-------------|
| GET | `/libros` | Devuelve todos los libros con opción de ordenamiento |
| GET | `/libros/:id` | Devuelve los detalles de un libro específico por su ID |
| POST | `/libros` | Permite crear un nuevo libro (requiere JSON Body) |
| PUT | `/libros/:id` | Actualiza un libro existente por su ID (requiere JSON Body) |
| DELETE | `/libros/:id` | Elimina un libro específico por su ID |

### Fichas 

| Verbo HTTP | Endpoint | ¿Qué hace? |
|------------|----------|-------------|
| GET | `/fichas` | Devuelve todas las fichas de préstamos |
| GET | `/fichas/:id` | Devuelve los detalles de una ficha específica por su ID |
| POST | `/fichas` | Permite crear una nueva ficha de préstamo (requiere JSON Body) |
| PUT | `/fichas/:id` | Actualiza una ficha existente por su ID (requiere JSON Body) |
| DELETE | `/fichas/:id` | Elimina una ficha específica por su ID |

## Ordenamiento (Solo funciona en Libros)

Los libros se pueden ordenar por varios campos clave:

| Campo de Ordenamiento (orderBy) | Se ordena por |
|---------------------------------|---------------|
| titulo | El título del libro |
| autor | El autor del libro |
| fecha_publicacion | El año de publicación |
| genero | El género literario |

**Ejemplos de Ordenamiento:**  
- `/libros?orderBy=titulo&order=ASC` (Orden alfabético A-Z)  
- `/libros?orderBy=autor&order=DESC` (Orden alfabético Z-A)  
- `/libros?orderBy=fecha_publicacion&order=ASC` (Del más antiguo al más reciente)


Todas las pruebas se pueden realizar utilizando Postman o cualquier cliente HTTP.


## Ejemplos de Uso con JSON Body

### Crear Libro (POST /libros)

{
    "titulo": "El Principito",
    
    "autor": "Antoine de Saint-Exupéry",
    
    "fecha_publicacion": 1943,
    
    "genero": "Literatura infantil",
    
    "stock": 5
    
}

### Crear Ficha (POST /fichas)

{
    "usuario_id": 123,
    
    "libro_id": 1,
    
    "fecha_prestamo": "2024-01-15",
    
    "fecha_devolucion": "2024-01-30",
    
    "estado": "Prestado"
    
}
