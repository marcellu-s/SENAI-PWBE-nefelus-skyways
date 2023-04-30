const btnToTop = document.querySelector('.to-top-btn');

if (window.scrollY > 100) {
        
    btnToTop.style.opacity = '1';
    btnToTop.style.visibility = 'visible';
} else {
    btnToTop.style.opacity = '0';
    btnToTop.style.visibility = 'hidden';
}

btnToTop.addEventListener('click', () => {

    window.scrollTo({
        top: 0,
        left: 0,
        behavior: 'smooth'
    })
});

window.addEventListener('scroll', () => {

    if (window.scrollY > 100) {
        
        btnToTop.style.opacity = '1';
        btnToTop.style.visibility = 'visible';
    } else {
        btnToTop.style.opacity = '0';
        btnToTop.style.visibility = 'hidden';
    }
});