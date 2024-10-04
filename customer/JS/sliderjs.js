let currentSlideIndex = 0;    
let autoSlideInterval;        

function displaySlide(slideIndex) {
    const slideContainer = document.querySelector('.slides2');     
    const totalSlides = document.querySelectorAll('.slide2').length; 
    const paginationDots = document.querySelectorAll('.tab');        

    if (slideIndex >= totalSlides) {
        currentSlideIndex = 0;
    } else if (slideIndex < 0) {
        currentSlideIndex = totalSlides - 1;
    } else {
        currentSlideIndex = slideIndex;
    }

    paginationDots.forEach((dot, i) => {
        dot.classList.toggle('active', i === currentSlideIndex);
    });

    const offset = -currentSlideIndex * 100;
    slideContainer.style.transform = `translateX(${offset}%)`;
}

function moveToNextSlide() {
    currentSlideIndex++;
    displaySlide(currentSlideIndex);  
}

function restartAutoSlide() {
    clearInterval(autoSlideInterval);  
    autoSlideInterval = setInterval(moveToNextSlide, 4000); 
}

function currentSlide(index) {
    displaySlide(index);    
    restartAutoSlide();     
}

window.onload = function () {
    displaySlide(0);  

    autoSlideInterval = setInterval(moveToNextSlide, 4000);
};
