const openModalButton = document.querySelectorAll('.seat');
const closeModalButton = document.querySelector('#close-modal');
const modal = document.querySelector('#modal');
const fade = document.querySelector('#fade');

const toggleModal = () => [modal, fade].forEach((el) => el.classList.toggle('hide'));

[closeModalButton, fade].forEach((el) => el.addEventListener('click', toggleModal));

openModalButton.forEach((seat) => seat.addEventListener('click', toggleModal));