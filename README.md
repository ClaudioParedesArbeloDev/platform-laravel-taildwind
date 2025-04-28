Plataforma Laravel Tailwind
Plataforma web desarrollada con Laravel y Tailwind CSS, diseñada para ofrecer una experiencia de usuario moderna y eficiente. Este proyecto incluye funcionalidades como autenticación de usuarios, paneles de administración, y módulos personalizados para la gestión de contenido (por ejemplo, calendario o recursos educativos).
Tabla de Contenidos

Requisitos
Instalación
Uso
Estructura del Proyecto
Contribución
Licencia

Requisitos

PHP >= 8.1
Composer
Node.js >= 18.x & npm
MySQL o cualquier base de datos compatible con Laravel
Git

Instalación
Sigue estos pasos para configurar el proyecto en tu máquina local:

Clona el repositorio:
git clone https://github.com/ClaudioParedesArbeloDev/platform-laravel-taildwind.git
cd platform-laravel-taildwind


Instala las dependencias de PHP:
composer install


Configura el archivo de entorno:
cp .env.example .env


Genera la clave de la aplicación:
php artisan key:generate


Configura la base de datos:

Crea una base de datos en MySQL (o tu motor preferido).
Actualiza las credenciales en el archivo .env:DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña




Ejecuta las migraciones:
php artisan migrate


Instala las dependencias de frontend:
npm install
npm run dev


Inicia el servidor:
php artisan serve

La aplicación estará disponible en http://localhost:8000.


Uso

Acceso: Abre http://localhost:8000 en tu navegador.
Autenticación: Regístrate o inicia sesión para acceder a las funcionalidades de la plataforma.
Panel de administración: Los usuarios con rol de administrador pueden gestionar contenido y usuarios.
API (si aplica): Los endpoints están disponibles en /api/*. Consulta la documentación en /docs/api (si está configurada).

Para desarrollo, usa npm run dev para compilar los estilos de Tailwind CSS en tiempo real.
Estructura del Proyecto
platform-laravel-taildwind/
├── app/                    # Lógica de la aplicación (Modelos, Controladores, etc.)
│   ├── Http/
│   │   ├── Controllers/    # Controladores para manejar solicitudes HTTP
│   │   ├── Middleware/     # Middleware personalizado
│   ├── Models/             # Modelos Eloquent para la base de datos
├── config/                 # Archivos de configuración
├── database/               # Migraciones, seeders y factories
├── public/                 # Archivos públicos (CSS, JS, imágenes)
├── resources/              # Vistas Blade, CSS, JS y assets
│   ├── css/                # Estilos Tailwind CSS
│   ├── js/                 # Scripts JavaScript
│   ├── views/              # Plantillas Blade
├── routes/                 # Definición de rutas (web.php, api.php)
├── .env.example            # Ejemplo de configuración de entorno
├── composer.json           # Dependencias de PHP
├── package.json            # Dependencias de Node.js
└── README.md               # Este archivo

Contribución
¡Gracias por considerar contribuir a este proyecto! Sigue estos pasos:

Haz un fork del repositorio.
Crea una rama para tu funcionalidad: git checkout -b feature/nueva-funcionalidad.
Realiza tus cambios y haz commit: git commit -m "Agrega nueva funcionalidad".
Sube tus cambios: git push origin feature/nueva-funcionalidad.
Abre un Pull Request en GitHub.

Por favor, sigue las convenciones de código de Laravel y asegúrate de que los tests pasen (si están configurados).
Licencia
Este proyecto está licenciado bajo la Licencia MIT.
