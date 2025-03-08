# Proyecto de Fórmula 1

Este proyecto es una aplicación web que permite explorar información sobre equipos, pilotos y circuitos de la Fórmula 1. Incluye un sistema de autenticación de usuarios, un selector de idiomas (español e inglés) y una interfaz gráfica interactiva.

---

## Tecnologías utilizadas

- **Backend**:
  - PHP: Lenguaje de programación del lado del servidor.
  - Twig: Motor de plantillas para generar HTML dinámico.
  - MySQL: Base de datos para almacenar la información de usuarios, equipos, pilotos y circuitos.

- **Frontend**:
  - HTML5: Estructura de la página web.
  - CSS3: Estilos y diseño responsivo.
  - Bootstrap: Framework CSS para facilitar el diseño y la maquetación.
  - Chart.js: Librería para generar gráficos interactivos.

- **Otras herramientas**:
  - Composer: Gestor de dependencias para PHP.
  - Git: Control de versiones.

---


## Instalación y configuración

### Requisitos previos

1. **Servidor web**: Apache o Nginx.
2. **PHP**: Versión 7.4 o superior.
3. **MySQL**: Base de datos para almacenar la información.
4. **Composer**: Para gestionar las dependencias de PHP.

### Pasos para instalar el proyecto

1. **Clonar el repositorio**:
   ```bash
   git clone https://github.com/IvanBermejoHidalgo/WebScraping.git
   cd WebScraping
2. **Instalar dependencias**:
    ```bash
    composer install
3. **Configurar la base de datos**:
    - Crear una base de datos en MySQL.
    - Importar el archivo SQL proporcionado en schema.sql para crear las tablas y datos iniciales.
    - Configurar las credenciales de la base de datos en src/controller/DatabaseController.php
4. **Configurar el servidor web**:
    - Asegúrate de que el servidor web apunte a la carpeta WebScraping.
    - Configura las reglas de reescritura en .htaccess si es necesario.
5. **Ejecutar el proyecto**:
    - Abre tu navegador y visita http://localhost/WebScraping

---
## Contacto
- **Nombre:** Iván Bermejo Hidalgo
- **Email:** ibermejo@elpuig.xeill.net
- **GitHub:** [IvanBermejoHidalgo](https://github.com/IvanBermejoHidalgo)

---