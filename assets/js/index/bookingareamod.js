const formBookingArea = document.querySelector('.booking-area form');

function clickFunction() {
    window.location.href = 'https://www.google.com';
}


window.addEventListener('resize', () => {
    if (window.screen.width < 668) {
        formBookingArea.addEventListener('click', clickFunction);
    } else {
        formBookingArea.removeEventListener('click', clickFunction);
    }
});