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

## Estructura del proyecto
proyecto-f1/
├── assets/ # Archivos estáticos (CSS, imágenes, etc.)
├── src/ # Código fuente del backend
│ ├── controller/ # Controladores (lógica de negocio)
│ │ ├── DatabaseController.php
│ │ └── SessionController.php
│ └── model/ # Modelos (interacción con la base de datos)
├── views/ # Plantillas Twig
│ ├── home.php # Página principal
│ ├── scuderias.html # Página de equipos
│ ├── pilotos.html # Página de pilotos
│ ├── circuitos.html # Página de circuitos
│ ├── login.php # Página de inicio de sesión
│ └── signup.php # Página de registro
├── locale/ # Archivos de traducción (i18n)
│ ├── es/LC_MESSAGES/ # Traducciones en español
│ │ └── messages.mo
│ └── en/LC_MESSAGES/ # Traducciones en inglés
│ └── messages.mo
├── index.php # Punto de entrada de la aplicación
├── admin.php # Página de administración (si aplica)
├── composer.json # Configuración de Composer
├── README.md # Este archivo
└── .htaccess # Configuración del servidor (si aplica)


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
   git clone https://github.com/tu-usuario/proyecto-f1.git
   cd proyecto-f1