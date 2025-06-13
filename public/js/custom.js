document.addEventListener('DOMContentLoaded', function () {
    // Inisialisasi Select2 Tambah
    const selectTambah = document.querySelector('#cabang');
    if (selectTambah) {
        $('#cabang').select2({
            dropdownParent: $('#modalTambahUser'),
            width: '100%'
        });
    }

    // Inisialisasi Select2 Edit
    if ($('#cabang-edit').length) {
        $('#cabang-edit').select2({
            dropdownParent: $('#modalEdit'),
            width: '100%'
        });
    }

    // Tombol Edit Resi
    $(document).on('click', '.btn-editResi', function () {
        $('.modal').modal('hide'); // tutup modal lain

        const id = $(this).data('id');
        const resi = $(this).data('resi');
        const keterangan = $(this).data('keterangan');

        $('#edit-idResi').val(id);
        $('#edit-resi').val(resi);
        $('#edit-keterangan').val(keterangan);

        // Panggil modal di sini (DIPASTIKAN modalEditResi sudah ada)
        const modal = new bootstrap.Modal(document.getElementById('modalEditResi'));
        modal.show();
    });

    // Tombol Edit User
    $(document).on('click', '.btn-editUser', function () {
        $('.modal').modal('hide');

        const id = $(this).data('id');
        const username = $(this).data('user');
        const name = $(this).data('name');
        const cabang = $(this).data('cabang');
        const custid = $(this).data('custid');
        const role = $(this).data('role');
        const status = $(this).data('status');

        $('#edit-id').val(id);
        $('#edit-username').val(username);
        $('#edit-name').val(name);
        $('#edit-custid').val(custid);
        $('#edit-role').val(role);
        $('#edit-status').val(status);
        $('#cabang-edit').val(cabang).trigger('change');

        const modal = new bootstrap.Modal(document.getElementById('modalEdit'));
        modal.show();
    });


    $(document).on('click', '.btn-editPass', function () {
        $('.modal').modal('hide');

        const id = $(this).data('id');
        const username = $(this).data('username');
        // const pass = $(this).data('pass');

        $('#edit-id-pass').val(id);
        $('#usernamePass').val(username);
        $('#edit-pass').val(''); // (lihat catatan keamanan di bawah)

        const modal = new bootstrap.Modal(document.getElementById('modalEditPass'));
        modal.show();
    });

});
