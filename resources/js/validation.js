import './bootstrap';

// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})()

//MODAL JS

//Recupero tutti i pulsanti con la classe.
const deleteButtons = document.querySelectorAll('.confirm-delete-button[type="submit"]');

deleteButtons.forEach((button) => {
    button.addEventListener('click', function (event) {
        //Evito che il record sia eliminato subito dal database.
        event.preventDefault();
        //Recupero il titolo del comic.
        const apartmentTitle = button.getAttribute('data-title');
        //Recupero la modale creata attraverso l'id.
        const modal = document.getElementById('delete-apartment-modal');
        //Creo una nuova modale con i metodi di bootstrap a partire da quella realizzata nel file modal_delete.
        const bootstrapModal = new bootstrap.Modal(modal);
        //Mostro la modale.
        bootstrapModal.show();

        //Mostro il titolo del apartment nella modale.
        const modalContent = modal.querySelector('#modal-item-title');
        modalContent.textContent = apartmentTitle;
        //Recupero il pulsante di cancellazione del record;
        const deleteButton = modal.querySelector('#confirm-delete');
        //Metto in ascolto il pulsante per intercettare il click;
        deleteButton.addEventListener('click', () => {
            button.parentElement.submit();
        })
    })
})
