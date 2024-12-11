const flashData = $("#flash-data").data('flashdata');

if (flashData) {
    Swal.fire({
        icon: 'success',
        title: flashData,
        showConfirmButton: true,
    });
}

// button delete
$('.form-delete').on('click', function (e) {
    e.preventDefault();

    Swal.fire({
        title: 'Apakah Anda Yakin?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus'
    }).then((result) => {
        if (result.value) {
            return $(this).submit();
        }
    })
});
