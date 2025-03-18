const sidebar = document.getElementById('sidebar');
            const openSidebarButton = document.getElementById('open-sidebar');
            const sidebarTexts = document.querySelectorAll('.sidebar-text');
            const lang = document.querySelectorAll('.lang');

            openSidebarButton.addEventListener('click', (e) => {
                e.stopPropagation();
                
                sidebar.classList.toggle('w-16');
                sidebar.classList.toggle('w-50');
                sidebarTexts.forEach(text => text.classList.toggle('hidden'));
                lang.forEach(text => text.classList.toggle('hidden'));
            });