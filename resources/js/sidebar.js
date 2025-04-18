document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const openSidebarButton = document.getElementById('open-sidebar');
    const sidebarTexts = document.querySelectorAll('.sidebar-text');
    const lang = document.querySelectorAll('.lang');

    function applySidebarState() {
        // En mobile (<1024px), forzar estado colapsado
        if (window.innerWidth < 1024) {
            sidebar.classList.remove('w-50');
            sidebar.classList.add('w-20');
            sidebarTexts.forEach(text => text.classList.add('hidden'));
            lang.forEach(text => text.classList.add('hidden'));
        } else {
            // En desktop, respetar localStorage
            const isExpanded = localStorage.getItem('sidebarExpanded') === 'true';
            sidebar.classList.toggle('w-50', isExpanded);
            sidebar.classList.toggle('w-20', !isExpanded);
            sidebarTexts.forEach(text => text.classList.toggle('hidden', !isExpanded));
            lang.forEach(text => text.classList.toggle('hidden', !isExpanded));
        }
    }

    openSidebarButton.addEventListener('click', (e) => {
        e.stopPropagation();

        // Solo permitir expandir/colapsar en pantallas lg y superiores (≥1024px)
        if (window.innerWidth >= 1024) {
            const isExpanded = sidebar.classList.contains('w-50');
            const newState = !isExpanded;

            localStorage.setItem('sidebarExpanded', newState);

            sidebar.classList.toggle('w-50', newState);
            sidebar.classList.toggle('w-20', !newState);

            sidebarTexts.forEach(text => text.classList.toggle('hidden', !newState));
            lang.forEach(text => text.classList.toggle('hidden', !newState));
        }
    });

    // Aplicar estado inicial
    applySidebarState();

    // Reaplicar estado al cambiar el tamaño de la ventana
    window.addEventListener('resize', applySidebarState);
});