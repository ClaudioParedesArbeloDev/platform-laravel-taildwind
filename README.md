<h1 align="center">Code & Lens · Plataforma educativa</h1>

<p align="center">
  Plataforma de cursos, blog y tienda de software de Code & Lens Solutions · Course platform, blog and software store for Code & Lens Solutions
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP_8.2-777BB4?style=for-the-badge&logo=php&logoColor=white" />
  <img src="https://img.shields.io/badge/Laravel_12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
  <img src="https://img.shields.io/badge/Livewire-FB70A9?style=for-the-badge&logo=livewire&logoColor=white" />
  <img src="https://img.shields.io/badge/Tailwind_CSS_4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" />
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" />
  <img src="https://img.shields.io/badge/Mercado_Pago-00B1EA?style=for-the-badge&logo=mercadopago&logoColor=white" />
  <img src="https://img.shields.io/badge/Auth0-EB5424?style=for-the-badge&logo=auth0&logoColor=white" />
</p>

<p align="center">
  <a href="https://www.claudioparedes.site"><b>🌐 Ver en producción / Live site</b></a> · <a href="#-español">Español</a> · <a href="#-english">English</a>
</p>

---

## 🇪🇸 Español

### Qué es

La plataforma principal de **Code & Lens Solutions**: un sitio donde se venden y dictan cursos de programación, fotografía y cine, con aula virtual para alumnos y docentes, blog con comunidad y una tienda donde se comercializan las apps de la empresa. Está en producción con alumnos reales.

### Funcionalidades

**Cursos y aula**
- Catálogo público de cursos y ficha de cada curso.
- Inscripción y pago con **Mercado Pago** (checkout + webhook).
- Clases por curso, entrega de trabajos y **registro de asistencia**.
- Panel del docente: alumnos por curso, estado de cada alumno, gestión de clases.
- "Mi camino": progreso del alumno.

**Comunidad**
- Blog con comentarios y "me gusta" en posts y comentarios.
- Perfiles con avatar (procesado con Intervention Image).

**Tienda de software**
- Catálogo de apps con add-ons opcionales, checkout con Mercado Pago y sección "Mis apps" con lo comprado.

**Administración**
- Dashboard de admin, usuarios, ventas.

**Otros**
- Login propio + **Auth0**, registro, verificación de email y recuperación de contraseña (Livewire).
- Sitio bilingüe **español / inglés** (cambio de idioma por cookie).
- Tema claro/oscuro.
- CI con GitHub Actions (tests y lint).

### Instalación

```bash
git clone https://github.com/ClaudioParedesArbeloDev/platform-laravel-taildwind.git
cd platform-laravel-taildwind
composer install
npm install
# crear .env (base de datos, Mercado Pago, Auth0)
php artisan key:generate
php artisan migrate --seed
composer run dev        # servidor, cola, logs y Vite
```

El repo no incluye `.env`: crearlo con la configuración estándar de Laravel más las credenciales de Mercado Pago y Auth0.

---

## 🇬🇧 English

### What it is

The main platform of **Code & Lens Solutions**: a site to sell and teach programming, photography and film courses, with a virtual classroom for students and teachers, a community blog, and a store for the company's own apps. It runs in production with real students.

### Features

- **Courses:** public catalogue, enrolment and payment via **Mercado Pago** (checkout + webhook), classes, homework submission and **attendance tracking**.
- **Teacher panel:** students per course, student status, class management; student progress page.
- **Community blog** with comments and likes; user profiles with avatars.
- **Software store:** apps with optional add-ons, Mercado Pago checkout and a "My apps" library.
- **Admin dashboard:** users and sales.
- **Auth:** email/password + **Auth0**, email verification and password reset (Livewire).
- **Bilingual** Spanish/English UI, light/dark theme, GitHub Actions CI.

### Setup

```bash
composer install && npm install
# create .env, then
php artisan key:generate
php artisan migrate --seed
composer run dev
```

The repo ships without `.env`: create one with the standard Laravel settings plus Mercado Pago and Auth0 credentials.

---

<p align="center">
  Hecho por / Built by <a href="https://github.com/ClaudioParedesArbeloDev"><b>Claudio Paredes Arbelo</b></a> · <a href="https://www.claudioparedes.site">Code & Lens Solutions</a>
</p>
