document.addEventListener('DOMContentLoaded', function() {
    gsap.registerPlugin(ScrollToPlugin);

    // Add smooth scroll for all links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            var target = document.querySelector(this.getAttribute('href'));
            if(target) {
                gsap.to(window, {duration: 1.5, scrollTo: target});
            }
        });
    });
});
