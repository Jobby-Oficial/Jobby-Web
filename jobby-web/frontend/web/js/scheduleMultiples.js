var exampleModal = document.getElementById('exampleModal')
exampleModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var id = button.getAttribute('data-bs-id');
    var price = button.getAttribute('data-bs-price');
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalBodyInputId = exampleModal.querySelector('.service_id');
    var modalBodyInputPrice = exampleModal.querySelector('.service_price');

    modalBodyInputId.value = id;
    modalBodyInputPrice.value = price;
})