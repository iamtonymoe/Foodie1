document.addEventListener("DOMContentLoaded", function() {
    const navLinks = document.querySelectorAll('.unique-nav-link');
    const tabPanes = document.querySelectorAll('.unique-tab-pane');

    navLinks.forEach((link) => {
        link.addEventListener('click', (e) => {
            e.preventDefault();

            // Remove 'active' class from all nav links
            navLinks.forEach((nav) => nav.classList.remove('active'));
            // Add 'active' class to the clicked nav link
            link.classList.add('active');

            // Get the target tab content
            const target = link.getAttribute('href').substring(1);

            // Hide all tab panes with smooth transition
            tabPanes.forEach((pane) => {
                pane.style.opacity = '0'; // Start fading out
                setTimeout(() => {
                    pane.classList.remove('active');
                }, 400); // Wait for transition to complete before hiding
            });

            // Show the target tab pane after a slight delay
            setTimeout(() => {
                const targetPane = document.getElementById(target);
                if (targetPane) {
                    targetPane.classList.add('active');
                    targetPane.style.opacity = '1'; // Fade in
                }
            }, 400); // Wait for other panes to finish hiding
        });
    });
});
