Livewire.on('deletePost', (postId) => {
    Swal.fire({
        title: '¿Estas seguro que deseas eliminar el registro?',
        text: "No podras revertir esta acción",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        Livewire.emitTo('posts', 'delete', postId);
        if (result.isConfirmed) {
            Swal.fire(
                'Registro eliminado!!',
                {
                    confirmButtonText: 'Continuar',
                }
            )
        }
    })
})
