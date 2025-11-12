// Alerts module - loaded on demand
export async function showAlert(options = {}) {
    const module = await import('sweetalert2');
    const Swal = module.default;
    
    return Swal.fire(options);
}

export async function showSuccess(message, title = 'Success!') {
    const module = await import('sweetalert2');
    const Swal = module.default;
    
    return Swal.fire({
        title,
        text: message,
        icon: 'success',
        confirmButtonText: 'OK'
    });
}

export async function showError(message, title = 'Error!') {
    const module = await import('sweetalert2');
    const Swal = module.default;
    
    return Swal.fire({
        title,
        text: message,
        icon: 'error',
        confirmButtonText: 'OK'
    });
}

export async function showConfirm(message, title = 'Are you sure?') {
    const module = await import('sweetalert2');
    const Swal = module.default;
    
    return Swal.fire({
        title,
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    });
}
