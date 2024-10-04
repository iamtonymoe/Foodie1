document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('modal');
    var closeBtn = document.querySelector('.close-btn');
    var mainContent = document.getElementById('main-content');
    var slides = document.querySelectorAll('.slide');
    var nextBtn = document.querySelector('.next-btn');
    var skipBtn = document.querySelector('.skip-btn');
    var currentSlide = 0;

    // Show the modal
    modal.style.display = 'block';
    mainContent.classList.add('blur');

    // Function to show the next slide
    function showNextSlide() {
        if (currentSlide < slides.length - 1) {
            slides[currentSlide].classList.remove('active');
            currentSlide++;
            slides[currentSlide].classList.add('active');
            document.querySelector('.slides').style.transform = `translateX(-${currentSlide * 100}%)`;
        } else {
            // Last slide reached, redirect to a new page
            window.location.href = 'customer/signup.php'; // Replace with your desired URL
        }
    }

    // Function to skip the slides and redirect
    function skipSlides() {
        window.location.href = 'customer/signup.php'; // Replace with your desired URL
    }

    // When the user clicks on the close button, close the modal
    closeBtn.onclick = function() {
        modal.style.display = 'none';
        mainContent.classList.remove('blur');
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
            mainContent.classList.remove('blur');
        }
    };

    // When the user clicks on the next button, show the next slide
    nextBtn.onclick = showNextSlide;

    // When the user clicks on the skip button, skip the slides and redirect
    skipBtn.onclick = skipSlides;
});



