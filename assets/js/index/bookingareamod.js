const formBookingArea = document.querySelector('.booking-area form');

function clickFunction() {
    window.location.href = 'pages/reservar_passagem/reservar_passagem.html';
}

if (window.screen.width < 668) {
    formBookingArea.addEventListener('click', clickFunction);
}

window.addEventListener('resize', () => {
    if (window.screen.width < 668) {
        formBookingArea.addEventListener('click', clickFunction);
    } else {
        formBookingArea.removeEventListener('click', clickFunction);
    }
});