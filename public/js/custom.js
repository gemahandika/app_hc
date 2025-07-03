if (window.location.pathname.includes('/karyawan')) {
  Swal.fire({
    title: 'Memuat data...',
    html: 'Mohon tunggu sebentar',
    allowOutsideClick: false,
    showConfirmButton: false,
    didOpen: () => {
      Swal.showLoading();
    }
  });
}

$(document).ready(function () {
  // ========================================
  // 1. INISIALISASI DATATABLES
  // ========================================
  let table = $('#example').DataTable({
    scrollX: true,
    scrollCollapse: true,
    paging: true,
    fixedColumns: {
        leftColumns: 2 // Kolom "Action" di sebelah kiri akan dibekukan
    },
    initComplete: function () {
        if (window.location.pathname.includes('/karyawan')) {
            setTimeout(() => {
                Swal.close();
            }, 400);
        }
    }
  });
  table.columns.adjust().draw();

  // ========================================
  // 2. INISIALISASI SELECT2
  // ========================================
  $('.select2').select2();

  // ========================================
  // 3. HANDLER FILTER (Modular untuk Aktif & Resign)
  // ========================================
  function handleKaryawanFilter({
    statusResign = 'NO',
    usiaSelector,
    genSelector,
    sectionSelector,
    exportPrefix,
    tableId,
    resultContainer,
    endpoint = '/karyawan/filter'
  })
  {
    const dataFilter = {
      usia: $(usiaSelector).val(),
      gen: $(genSelector).val(),
      section: $(sectionSelector).val(),
      status_resign: statusResign
    };
  // Export
    $(`#${exportPrefix}_section`).val(dataFilter.section);
    $(`#${exportPrefix}_gen`).val(dataFilter.gen);
    $(`#${exportPrefix}_usia`).val(dataFilter.usia);

    $.ajax({
      url: BASE_URL + endpoint,
      method: 'POST',
      data: dataFilter,
      success: function (res) {
        if (res.trim() === 'EMPTY_DATA_MARKER') {
          Swal.fire({
            icon: 'info',
            title: 'Tidak ada data',
            text: 'Data tidak ditemukan untuk filter yang kamu pilih.'
          });
          $(`#${tableId}`).find(`tbody#${resultContainer}`).html('');
          return;
        }

        let dt = $(`#${tableId}`).DataTable();
        dt?.clear().draw();
        dt?.destroy();

        $(`#${tableId}`).find(`tbody#${resultContainer}`).html(res);

        setTimeout(() => {
          $(`#${tableId}`).DataTable({
            scrollX: true,
            scrollCollapse: true,
            paging: true,
            fixedColumns: { leftColumns: 2 }
          });
        }, 0);
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Oops!',
          text: 'Gagal memuat data berdasarkan filter.'
        });
      }
    });
  }

  // ========================================
  // EVENT untuk halaman AKTIF
  // ========================================
  $('.filter-karyawan').on('change', function () {
    handleKaryawanFilter({
      statusResign: 'NO',
      usiaSelector: '#filter_usia',
      genSelector: '#filter_gen',
      sectionSelector: '#filter_section',
      exportPrefix: 'export',
      tableId: 'example',
      resultContainer: 'karyawanResult',
      endpoint: '/karyawan/filter'
    });
  });

  // ========================================
  // EVENT untuk halaman RESIGN
  // ========================================
  $('.filter-karyawan-resign').on('change', function () {
    handleKaryawanFilter({
      statusResign: 'YES',
      usiaSelector: '#filter_usia_resign',
      genSelector: '#filter_gen_resign',
      sectionSelector: '#filter_section_resign',
      exportPrefix: 'export_resign',
      tableId: 'example',
      resultContainer: 'karyawanResult',
      endpoint: '/karyawan_resign/filter'
    });
  });

  // ========================================
  // 4. MODAL EDIT KARYAWAN
  // ========================================
  $(document).on('click', '.btn-editKaryawan', function () {
    const id = $(this).data('id');
    $.ajax({
      url: BASE_URL + '/karyawan/getKaryawanById',
      method: 'POST',
      data: { id_karyawan: id },
      dataType: 'json',
      success: function (data) {
        $('#edit-idKaryawan').val(data.id_karyawan);
        $('#edit-kategori').val(data.kategori);
        $('#edit-branch').val(data.branch.trim()).trigger('change');
        $('#edit-kcu').val(data.kcu_agen.trim()).trigger('change');
        $('#edit-nikJne').val(data.nik_jne);
        $('#edit-nikVendor').val(data.nik_vendor);
        $('#edit-nama').val(data.nama_karyawan);
        $('#edit-vendor').val(data.vendor);
        $('#edit-phone').val(data.phone);
        $('#edit-finger').val(data.id_finger);
        $('#edit-join').val(data.join_date);
        $('#edit-statusKaryawan').val(data.status_karyawan.trim()).trigger('change');
        $('#edit-jabatan').val(data.jabatan.trim()).trigger('change');
        $('#edit-posisi').val(data.posisi);
        $('#edit-unit').val(data.unit);
        $('#edit-section').val(data.section);
        $('#edit-birthdate').val(data.birth_date);
        $('#edit-gen').val(data.gen);
        $('#edit-gender').val(data.gender);
        $('#edit-lokasi_kerja').val(data.lokasi_kerja);
        $('#edit-pendidikan_terakhir').val(data.pendidikan_terakhir);
        $('#edit-jurusan').val(data.jurusan);
        $('#edit-alamat').val(data.alamat);
        $('#edit-kecamatan').val(data.kecamatan);
        $('#edit-bpjs_kesehatan').val(data.bpjs_kesehatan);
        $('#edit-bpjs_ketenagakerjaan').val(data.bpjs_ketenagakerjaan);
        $('#edit-perusahaan_mitra').val(data.perusahaan_mitra);
        $('#edit-status_pekerjaan').val(data.status_pekerjaan);
        $('#edit-status_pernikahan').val(data.status_pernikahan);

        const modal = new bootstrap.Modal(document.getElementById('modalEditKaryawan'));
        modal.show();

        $('#modalEditKaryawan').on('shown.bs.modal', function () {
          $('#edit-branch, #edit-kcu, #edit-statusKaryawan, #edit-jabatan').select2({
            dropdownParent: $('#modalEditKaryawan'),
            width: '100%'
          });
        });
      },
      error: function (xhr, status, error) {
        console.error("Gagal ambil data:", error);
      }
    });
  });

  // ========================================
  // 5. SUBMIT EDIT KARYAWAN
  // ========================================
  $(document).on('submit', '#formEditKaryawan', function (e) {
    e.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
      url: BASE_URL + '/karyawan/edit',
      method: 'POST',
      data: formData,
      success: function () {
        $('#modalEditKaryawan').modal('hide');
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: 'Data karyawan berhasil diperbarui!'
        }).then(() => location.reload());
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: 'Terjadi kesalahan saat mengupdate data.'
        });
      }
    });
  });

  // ========================================
  // 6. MODAL TAMBAH KARYAWAN
  // ========================================
  $('#modalTambahKaryawan').on('shown.bs.modal', function () {
    $('#tambah-branch, #tambah-kcu, #tambah-statusKaryawan, #tambah-jabatan').select2({
      dropdownParent: $('#modalTambahKaryawan'),
      width: '100%'
    });
  });

  // ========================================
  // 7. SUBMIT TAMBAH KARYAWAN
  // ========================================
  $(document).on('submit', '#formTambahKaryawan', function (e) {
    e.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
      url: BASE_URL + '/karyawan/tambah',
      method: 'POST',
      data: formData,
      success: function (response) {
        try {
          const res = typeof response === 'string' ? JSON.parse(response) : response;
          if (res.status === 'success') {
            $('#modalTambahKaryawan').modal('hide');
            Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: res.message
            }).then(() => location.reload());
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Gagal',
              text: res.message || 'Gagal menyimpan data.'
            });
          }
        } catch (err) {
          console.error('Respon tidak valid JSON:', err);
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Respon dari server tidak dapat dibaca.'
          });
        }
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Server Error',
          text: 'Terjadi kesalahan saat mengirim data.'
        });
      }
    });
  });

   // ========================================
  // 8. MODAL RESIGN KARYAWAN
  // ========================================
  $(document).on('click', '.btn-resignKaryawan', function () {
    const id = $(this).data('id');
    $.ajax({
      url: BASE_URL + '/karyawan/getKaryawanById',
      method: 'POST',
      data: { id_karyawan: id },
      dataType: 'json',
      success: function (data) {
        $('#resign-idKaryawan').val(data.id_karyawan);
        $('#resign-nikJne').val(data.nik_jne);
        $('#resign-nama').val(data.nama_karyawan);

        const modal = new bootstrap.Modal(document.getElementById('modalResignKaryawan'));
        modal.show();

        $('#modalResignKaryawan').on('shown.bs.modal', function () {
          $('#resign-branch, #resign-kcu, #resign-statusKaryawan, #resign-jabatan').select2({
            dropdownParent: $('#modalResignKaryawan'),
            width: '100%'
          });
        });
      },
      error: function (xhr, status, error) {
        console.error("Gagal ambil data:", error);
      }
    });
  });
  // ========================================
  // 5. SUBMIT RESIGN KARYAWAN
  // ========================================
  $(document).on('submit', '#formResignKaryawan', function (e) {
    e.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
      url: BASE_URL + '/karyawan/resign',
      method: 'POST',
      data: formData,
      success: function () {
        $('#modalResignKaryawan').modal('hide');
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: 'Karyawan Resign Berhasil di Tambah'
        }).then(() => location.reload());
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: 'Terjadi kesalahan saat mengupdate data.'
        });
      }
    });
  });

  // ========================================
  // 4. MODAL EDIT KARYAWAN RESIGN
  // ========================================
  $(document).on('click', '.btn-editKaryawanResign', function () {
    const id = $(this).data('id');
    $.ajax({
      url: BASE_URL + '/karyawan_resign/getKaryawanResignById',
      method: 'POST',
      data: { id_karyawan: id },
      dataType: 'json',
      success: function (data) {
        $('#editResign-idKaryawan').val(data.id_karyawan);
        $('#editResign-nama').val(data.nama_karyawan);
        $('#editResign-tgl').val(data.tgl_resign);
        $('#editResign-ket').val(data.ket_resign);
        $('#editResign-status').val(data.status_resign);

        const modal = new bootstrap.Modal(document.getElementById('modalEditKaryawanResign'));
        modal.show();
      },
      error: function (xhr, status, error) {
        console.error("Gagal ambil data:", error);
      }
    });
  });

  // ========================================
  // 5. SUBMIT EDIT KARYAWAN RESIGN
  // ========================================
  $(document).on('submit', '#formEditKaryawanResign', function (e) {
    e.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
      url: BASE_URL + '/karyawan_resign/editResign',
      method: 'POST',
      data: formData,
      success: function () {
        $('#modalEditKaryawanResign').modal('hide');
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: 'Data karyawan berhasil diperbarui!'
        }).then(() => location.reload());
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: 'Terjadi kesalahan saat mengupdate data.'
        });
      }
    });
  });


});