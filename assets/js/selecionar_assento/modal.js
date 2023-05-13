const openModalButton = document.querySelectorAll('.seat');
const closeModalButton = document.querySelector('#close-modal');
const btnConfirm = document.querySelector('.btn-confirm button')
const modal = document.querySelector('#modal');
const fade = document.querySelector('#fade');

const toggleModal = () => [modal, fade].forEach((el) => { el.classList.toggle('hide') });

[closeModalButton, fade].forEach((el) => el.addEventListener('click', function () {
    assento.toggleClass('selected');
    toggleModal()
}));
[btnConfirm, fade].forEach((el) => el.addEventListener('click', toggleModal));


function letterToNumber(letter) {
    return letter.toLowerCase().charCodeAt(0) - 96;
  }

openModalButton.forEach((seat) => {
    seat.addEventListener('click', function() {

        assento = this.id;

        if (!this.classList.contains('unavailable')) {

            if (!this.classList.contains('selected')) {
                    if (qntSelecionados < totalAssentos) {
                        // $('.seat-occupant').innerHTML = $;
                        $('.seat-id').html(assento[0] + '-' + assento[1]);
                        if (letterToNumber(assento[0]) < 8) {
                            $('.seat-type').html('Premium');
                            $('.seat-price').html(precoAssentos.premium);
                        } else {
                            $('.seat-type').html('Comercial');
                            $('.seat-price').html(precoAssentos.economico);
                        }
                        
                        toggleModal();
                    } else {
                        alert('Todos os assentos já foram selecionados');
                    }
            } else {
                    assentosSelecionados = assentosSelecionados.filter(item => item !== (assento[0] + '-' + assento[1]));
                    $(('#seat-' + qntSelecionados)).val('');

                    qntSelecionados -= 1;
                    spanInfo.innerHTML = `(${qntSelecionados}/${totalAssentos} - ${qntSelecionados >= totalAssentos ? 'Todos selecionados' : document.querySelector(('#first-name-passenger-' + qntSelecionados)).value})`;
            }
        } else {
            alert('Assento já ocupado.');
        }
    });
});