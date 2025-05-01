function showThisModal(orderId) {
    const modal = document.getElementById(`deny-confirmation-modal-${orderId}`);
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function hideThisModal(orderId) {
    const modal = document.getElementById(`deny-confirmation-modal-${orderId}`);
    if (!modal) {
        console.error(`Modal for order ${orderId} not found.`);
        return;
    }
    modal.classList.remove('flex');
    modal.classList.add('hidden');
}

function submitThisDeny(orderId) {
    const note = document.getElementById(`deny-note-${orderId}`).value;
    document.getElementById(`deny-note-input-${orderId}`).value = note;
    document.getElementById(`deny-form-${orderId}`).submit();
}
