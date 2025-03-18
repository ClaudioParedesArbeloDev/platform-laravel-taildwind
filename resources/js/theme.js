document.addEventListener('DOMContentLoaded', function () {
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    const html = document.documentElement;
    const darkModeKey = "theme";
  
    // Verificar que los elementos existan
    if (!themeToggle || !themeIcon) {
      console.error('No se encontraron los elementos:', { themeToggle, themeIcon });
      return;
    }
  
    // Aplicar el tema inicial desde localStorage
    if (localStorage.getItem(darkModeKey) === "dark") {
      html.classList.add('dark');
      themeToggle.classList.remove('bg-color-accent-500', 'hover:bg-color-accent-700');
      themeToggle.classList.add('bg-color-accent1-500', 'hover:bg-color-accent1-700');
      themeIcon.textContent = 'light_mode'; // Sol en modo oscuro
    } else {
      html.classList.remove('dark');
      themeToggle.classList.remove('bg-color-accent1-500', 'hover:bg-color-accent1-700');
      themeToggle.classList.add('bg-color-accent-500', 'hover:bg-color-accent-700');
      themeIcon.textContent = 'dark_mode'; // Luna en modo claro
    }
  
    // Evento para cambiar el tema al hacer clic
    themeToggle.addEventListener('click', function () {
      if (html.classList.contains('dark')) {
        html.classList.remove('dark');
        localStorage.setItem(darkModeKey, "light");
        themeToggle.classList.remove('bg-color-accent1-500', 'hover:bg-color-accent1-700');
        themeToggle.classList.add('bg-color-accent-500', 'hover:bg-color-accent-700');
        themeIcon.textContent = 'dark_mode'; // Mostrar luna
      } else {
        html.classList.add('dark');
        localStorage.setItem(darkModeKey, "dark");
        themeToggle.classList.remove('bg-color-accent-500', 'hover:bg-color-accent-700');
        themeToggle.classList.add('bg-color-accent1-500', 'hover:bg-color-accent1-700');
        themeIcon.textContent = 'light_mode'; // Mostrar sol
      }
    });
  });