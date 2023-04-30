const formBookingArea = document.querySelector('.booking-area form');

function clickFunction() {
    window.location.href = '';
}


window.addEventListener('resize', () => {
    if (window.screen.width < 668) {
        formBookingArea.addEventListener('click', clickFunction);
    } else {
        formBookingArea.removeEventListener('click', clickFunction);
    }
});