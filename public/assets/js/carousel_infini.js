const slides = document.getElementById("slides");

const slide1 = document.getElementById("slide1");
const clone1 = document.getElementById("slide1clone");
const slide4 = document.getElementById("slide4");
const clone4 = document.getElementById("slide4clone");

clone1.addEventListener('change', function() {
    if (clone1.checked) {
        setTimeout(() => {
            slides.style.transition = "none";
            slide1.checked = true;
            slides.offsetHeight;
            slides.style.transition = "all 0.5s ease";
        }, 500);
    }
});

clone4.addEventListener('change', function() {
    if (clone4.checked) {
        setTimeout(() => {
            slides.style.transition = "none";
            slide4.checked = true;
            slides.offsetHeight;
            slides.style.transition = "all 0.5s ease";
        }, 500);
    }
});