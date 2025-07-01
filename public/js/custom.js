//   if (window.location.pathname.includes('/karyawan')) {
//   Swal.fire({
//     title: 'Memuat data...',
//     html: 'Mohon tunggu sebentar',
//     allowOutsideClick: false,
//     showConfirmButton: false,
//     didOpen: () => {
//       Swal.showLoading();
//     }
//   });
// }
$(document).ready(function () {
  // ========================================
  // 1. INISIALISASI DATATABLES
  // ========================================
  let table = $('#example').DataTable({
    scrollX: true,
    responsive: true,
    deferRender: true,
    initComplete: function () {
        if (window.location.pathname.includes('/karyawan')) {
            setTimeout(() => {
                // Swal.close();
            }, 400);
        }
    }
  });
  table.columns.adjust().draw();

  // ========================================
  // 2. INISIALISASI SELECT2 + GEN OPTIONS
  // ========================================
  $('.select2').select2();

  $.ajax({
    url: BASE_URL + '/karyawan/getGenOptions',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      const $select = $('#filter_gen');
      $select.empty().append('<option value="">-- Pilih Gen --</option>');
      $.each(data, function (i, val) {
        $select.append(`<option value="${val}">${val}</option>`);
      });
      $select.trigger('change');
    }
  });

  // ========================================
  // 3. HANDLER FILTER (Usia + Gen + Section)
  // ========================================
  $('.filter-karyawan').on('change', function () {
    const dataFilter = {
      usia: $('#filter_usia').val(),
      gen: $('#filter_gen').val(),
      section: $('#filter_section').val()
    };

    $('#export_section').val($('#filter_section').val());
    $('#export_gen').val($('#filter_gen').val());
    $('#export_usia').val($('#filter_usia').val());

    $.ajax({
      url: BASE_URL + '/karyawan/filter',
      method: 'POST',
      data: dataFilter,
      success: function (res) {
          if (res.trim() === 'EMPTY_DATA_MARKER') {
            Swal.fire({
              icon: 'info',
              title: 'Tidak ada data',
              text: 'Data tidak ditemukan untuk filter yang kamu pilih.'
            });
            $('#example').find('tbody#karyawanResult').html('');
            return;
          }
        table.clear().draw();
        table.destroy();
        $('#example').find('tbody#karyawanResult').html(res);
        setTimeout(() => {
          table = $('#example').DataTable({
            scrollX: true,
            responsive: true
          });
        }, 50);
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Oops!',
          text: 'Gagal memuat data berdasarkan filter.'
        });
      }
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
});