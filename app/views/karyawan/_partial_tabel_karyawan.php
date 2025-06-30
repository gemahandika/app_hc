<?php

if (!empty($karyawan)) : ?>
    <?php $no = 1;
    foreach ($karyawan as $karyawan) : ?>
        <tr>
            <td class="small text-center"><?= $no++ ?></td>
            <td class="d-flex p-2">
                <button
                    type="button"
                    class="btn btn-danger btn-sm openModalButton me-2"
                    data-id_karyawan="<?= $karyawan['id_karyawan']; ?>"
                    data-mode="resign"
                    data-bs-toggle="modal"
                    data-bs-target="#editModal">
                    <i class="fa fa-lock"></i> Resign
                </button>
                <button class="btn btn-success btn-sm btn-editKaryawan" data-id="<?= $karyawan['id_karyawan']; ?>">
                    <i class="fa fa-edit"></i> Edit
                </button>
            </td>
            <td class="small text-center"><?= $karyawan['nama_karyawan'] ?></td>
            <td class="small text-center"><?= $karyawan['kategori'] ?></td>
            <td class="small text-center"><?= $karyawan['branch'] ?></td>
            <td class="small text-center"><?= $karyawan['kcu_agen'] ?></td>
            <td class="small text-center"><?= $karyawan['nik_jne'] ?></td>
            <td class="small text-center"><?= $karyawan['nik_vendor'] ?></td>
            <td class="small text-center"><?= $karyawan['vendor'] ?></td>
            <td class="small text-center"><?= $karyawan['phone'] ?></td>
            <td class="small text-center"><?= $karyawan['id_finger'] ?></td>
            <td class="small text-center"><?= $karyawan['join_date'] ?></td>
            <td class="small text-center">
                <?php
                if (!empty($karyawan['join_date'])) {
                    $join = new DateTime($karyawan['join_date']);
                    $now = new DateTime();
                    $diff = $join->diff($now);
                    echo $diff->y . ' TAHUN ' . $diff->m . ' BULAN';
                } else {
                    echo '-';
                }
                ?>
            </td>
            <td class="small text-center"><?= $karyawan['status_karyawan'] ?></td>
            <td class="small text-center"><?= $karyawan['jabatan'] ?></td>
            <td class="small text-center"><?= $karyawan['posisi'] ?></td>
            <td class="small text-center"><?= $karyawan['unit'] ?></td>
            <td class="small text-center"><?= $karyawan['section'] ?></td>
            <td class="small text-center"><?= $karyawan['birth_date'] ?></td>
            <td class="small text-center"><?= isset($karyawan['usia']) ? $karyawan['usia'] . ' TAHUN' : '-' ?></td>
            <td class="small text-center"><?= $karyawan['gen'] ?></td>
            <td class="small text-center"><?= $karyawan['gender'] ?></td>
            <td class="small text-center"><?= $karyawan['lokasi_kerja'] ?></td>
            <td class="small text-center"><?= $karyawan['pendidikan_terakhir'] ?></td>
            <td class="small text-center"><?= $karyawan['jurusan'] ?></td>
            <td class="small text-center"><?= $karyawan['alamat'] ?></td>
            <td class="small text-center"><?= $karyawan['kecamatan'] ?></td>
            <td class="small text-center"><?= $karyawan['bpjs_kesehatan'] ?></td>
            <td class="small text-center"><?= $karyawan['bpjs_ketenagakerjaan'] ?></td>
            <td class="small text-center"><?= $karyawan['perusahaan_mitra'] ?></td>
            <td class="small text-center"><?= $karyawan['status_pekerjaan'] ?></td>
            <td class="small text-center"><?= $karyawan['status_pernikahan'] ?></td>
            <td class="small text-center"><?= $karyawan['ket_induction'] ?></td>
            <td class="small text-center"><?= $karyawan['service_byheart'] ?></td>
            <td class="small text-center"><?= $karyawan['code_ofconduct'] ?></td>
            <td class="small text-center"><?= $karyawan['visimisi_oflife'] ?></td>
            <td class="small text-center"><?= $karyawan['training_sco'] ?></td>
            <td class="small text-center"><?= $karyawan['training_sales'] ?></td>
            <td class="small text-center"><?= $karyawan['kurir_program'] ?></td>
            <td class="small text-center"><?= $karyawan['id_card'] ?></td>
            <td class="small text-center"><?= $karyawan['seragam'] ?></td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="42" class="text-center">Tidak ada data tersedia</td>
    </tr>
<?php endif; ?>