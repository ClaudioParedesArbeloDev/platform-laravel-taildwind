let enrollDay = document.getElementById('days');
let hiddenEnrollDay = document.getElementById('hidden_enroll_day');

if(enrollDay){

    enrollDay.addEventListener('change', function() {
        let daySelected = enrollDay.options[enrollDay.selectedIndex].value;
    
        hiddenEnrollDay.value = daySelected;

        console.log("Día seleccionado: " + hiddenEnrollDay.value);
    });
}