document.addEventListener('DOMContentLoaded', () => {
    // IntersectionObserver létrehozása a becsúszó elemekhez
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('active')) {
                entry.target.classList.add('active');
            }
        });
    }, {
        threshold: 0.1,
    });

    // Becsúszó elemek
    const slideInElements = document.querySelectorAll('.slide-in, .slide-in-right, .slide-in-left, .slide-in-bottom');
    slideInElements.forEach(element => observer.observe(element));

    // Navbar toggler
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarNav = document.querySelector('#navbarNav');
    const navLinks = document.querySelectorAll('.nav-link');

    navbarToggler.addEventListener('click', () => {
        navbarNav.classList.toggle('collapse');
        navbarNav.classList.toggle('show');
    });

    // Klikk outside navbar kezelés
    document.addEventListener('click', (event) => {
        if (!event.target.closest('.navbar-nav, .navbar-toggler')) {
            navbarNav.classList.remove('show');
            navbarNav.classList.add('collapse');
        }
    });

    // Navbar linkek klikk események, ha mobil nézetben van
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 992) {
                navbarNav.classList.remove('show');
                navbarNav.classList.add('collapse');
            }
        });
    });
});

// Scroll események a becsúszó elemekhez
document.addEventListener('scroll', () => {
    const elements = document.querySelectorAll('.slide-in-right, .slide-in-left');
    elements.forEach(el => {
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom >= 0 && !el.classList.contains('active')) {
            el.classList.add('active');
        }
    });
});
