const genderChoiceDiv = document.querySelector('.input-control .gender-choice')
const genderChoiceSpan = document.querySelectorAll('.input-control .gender-choice span');
const inputGender = document.querySelector('.input-control #gender');
const genderSpan = document.querySelector('.input-control #gender-span');

genderSpan.addEventListener('click', () => {
    genderChoiceDiv.classList.toggle('open');
})

genderChoiceSpan.forEach((el) => {
    el.addEventListener('click', (e) => {
        inputGender.value = e.target.textContent;
        genderSpan.textContent = e.target.textContent;
        genderSpan.innerHTML += '<i class="bi bi-caret-down"></i>';
    })
});