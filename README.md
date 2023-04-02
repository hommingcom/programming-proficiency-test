#  🇬🇧 Programming Proficiency Test

This project is a programming proficiency test that includes a simple API for converting Arabic numbers to Roman numerals and a Bakery Controller for calculating the number of cakes that can be made with a given recipe and available ingredients.

## Getting Started

These instructions will help you get the project up and running on your local machine for development and testing purposes.

### Prerequisites

- Docker
- Docker Compose
- Git

### Installation

1. Clone the repository:

```bash
git clone https://github.com/joseantoniopino/programming-proficiency-test.git
```

2. Change to the project directory:

```bash
cd programming-proficiency-test
```

3. Build and start the Docker container:

```bash
chmod +x start.sh 
```

```bash
./start.sh
```

The application will be available at http://localhost:8080.

## Project Structure

The project follows a hexagonal architecture and includes the following main components:

- **Numbers**: A module for converting Arabic numbers to Roman numerals, which includes a Domain layer, an Application layer, and an Infrastructure layer.
- **Bakery**: A module for calculating the number of cakes that can be made with a given recipe and available ingredients, which includes a Domain layer, an Application layer, and an Infrastructure layer.


#  🇪🇸 Examen de habilidades de programación

Este proyecto es un examen de habilidades de programación que incluye una API simple para convertir números arábigos a números romanos y un controlador de panadería para calcular la cantidad de pasteles que se pueden hacer con una receta dada y los ingredientes disponibles.

## Comenzando

Estas instrucciones le ayudarán a poner en marcha el proyecto en su máquina local para fines de desarrollo y pruebas.

### Prerrequisitos

- Docker
- Docker Compose
- Git

### Instalación

1. Clonar el repositorio:

```bash
git clone https://github.com/joseantoniopino/programming-proficiency-test.git
```

2. Cambiar al directorio del proyecto:

```bash
cd programming-proficiency-test
```

3. Construir e iniciar el contenedor Docker:

```bash
chmod +x start.sh 
```

```bash
./start.sh
```

La aplicación estará disponible en http://localhost:8080.

## Estructura del proyecto

El proyecto sigue una arquitectura hexagonal e incluye los siguientes componentes principales:

- **Numbers**: Un módulo para convertir números arábigos a números romanos, que incluye una capa de Dominio, una capa de Aplicación y una capa de Infraestructura.
- **Bakery**: Un módulo para calcular la cantidad de pasteles que se pueden hacer con una receta dada y los ingredientes disponibles, que incluye una capa de Dominio, una capa de Aplicación y una capa de Infraestructura.
