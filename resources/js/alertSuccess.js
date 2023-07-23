Livewire.on('alert', (message) => {
    Swal.fire(
        '¡Excelente!',
        message,
        'success'
    )
});