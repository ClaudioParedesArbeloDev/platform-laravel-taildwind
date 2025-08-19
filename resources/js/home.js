
document.addEventListener("DOMContentLoaded", function () {
    let courses = document.querySelectorAll(".courses");
    let currentIndex = 0;

    function showNextCourse() {
        // Ocultar todos los cursos
        courses.forEach(course => course.style.display = "none");
        
        // Mostrar el curso actual
        courses[currentIndex].style.display = "block";

        // Mover al siguiente curso (o reiniciar si llega al final)
        currentIndex = (currentIndex + 1) % courses.length;
    }


    showNextCourse();


    setInterval(showNextCourse, 5000);
}); 