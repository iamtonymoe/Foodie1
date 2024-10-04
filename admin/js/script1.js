document.getElementById("navButton").addEventListener("click", function() {
    var navbar = document.getElementById("navbar");
    if (navbar.style.left === "-200px") {
        navbar.style.left = "0"; // Slide the navbar in from the left
    } else {
        navbar.style.left = "-200px"; // Slide the navbar back out
    }
});
