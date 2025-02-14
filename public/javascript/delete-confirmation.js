function confirmDelete(id) {
    // Show the confirmation modal
    document.getElementById('custom-confirmation-modal-' + id).style.display = 'block';
}

function deleteRecord(id) {
    // Submit the delete form
    document.getElementById('delete-form-' + id).submit();
}

function hideModal(id) {
    // Hide the confirmation modal
    document.getElementById('custom-confirmation-modal-' + id).style.display = 'none';
}
