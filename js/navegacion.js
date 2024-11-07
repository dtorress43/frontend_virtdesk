document.addEventListener('DOMContentLoaded', () => {
    const navMobile = document.querySelector('.nav-mobile');
    const navLinks = document.querySelector('.nav-links');

    navMobile.addEventListener('click', () => {
        navMobile.classList.toggle('active');
        navLinks.classList.toggle('open');
    });
});
