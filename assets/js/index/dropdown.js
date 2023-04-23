// DROPDOWN

const dropdownTriggers = document.querySelectorAll('.booking-area .trigger-button');

dropdownTriggers.forEach((trigger) => {
    trigger.addEventListener('click', () => {
        trigger.parentElement.classList.toggle('open');
    });
});