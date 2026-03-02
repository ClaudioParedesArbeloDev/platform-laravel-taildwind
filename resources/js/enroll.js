document.addEventListener('DOMContentLoaded', () => {
    const daysSelect = document.getElementById('days');
    const hiddenEnrollDay = document.getElementById('hidden_enroll_day');
    const enrollForm = document.getElementById('enrollForm');
    const enrollBtn = document.getElementById('enrollBtn');

    if (!daysSelect || !hiddenEnrollDay) return;

    function updateHiddenDay() {
        hiddenEnrollDay.value = daysSelect.value;
    }

    function showError(message) {
        let error = document.getElementById('days-error');
        if (error) error.remove();
        
        if (message) {
            error = document.createElement('span');
            error.id = 'days-error';
            error.className = 'text-red-600 text-sm block mt-1';
            error.textContent = message;
            daysSelect.parentNode.insertBefore(error, daysSelect.nextSibling);
        }
    }

    function toggleButton() {
        if (enrollBtn) {
            const isValid = !!daysSelect.value;
            enrollBtn.disabled = !isValid;
            enrollBtn.classList.toggle('opacity-50', !isValid);
            enrollBtn.classList.toggle('cursor-not-allowed', !isValid);
        }
    }

    
    daysSelect.addEventListener('change', () => {
        updateHiddenDay();
        showError(''); 
        toggleButton();
    });

   
    updateHiddenDay();
    toggleButton();

    
    if (enrollForm) {
        enrollForm.addEventListener('submit', (e) => {
            if (!daysSelect.value) {
                e.preventDefault();
                showError('⚠️ Debes seleccionar un horario');
                daysSelect.focus();
            }
        });
    }
});