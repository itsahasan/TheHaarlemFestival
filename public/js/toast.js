

// Function to display a toast notification
function showToast(type, message) {
    Toastify({
        text: message,
        duration: 3000,
        backgroundColor: type === 'success' ? 'green' : 'red', 
        close: true, 
        gravity: 'top', 
        position: 'right',
    }).showToast();
}

// Function to show toast based on session variables (error or success)
document.addEventListener('DOMContentLoaded', function () {
    const successMessage = sessionStorage.getItem('success');
    const errorMessage = sessionStorage.getItem('error');

    if (successMessage) {
        showToast('success', successMessage);
        sessionStorage.removeItem('success');
    }

    if (errorMessage) {
        showToast('error', errorMessage);
        sessionStorage.removeItem('error');
    }
});
