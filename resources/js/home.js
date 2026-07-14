
document.addEventListener("DOMContentLoaded", function () {
    let courses = document.querySelectorAll(".courses");
    let currentIndex = 0;

    function showNextCourse() {
       
        courses.forEach(course => course.style.display = "none");
        
       
        courses[currentIndex].style.display = "block";

        
        currentIndex = (currentIndex + 1) % courses.length;
    }


    showNextCourse();


    setInterval(showNextCourse, 5000);
}); 