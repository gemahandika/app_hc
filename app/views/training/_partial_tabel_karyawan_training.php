<?php

if (!empty($karyawan)) : ?>
    <?php $no = 1;
    foreach ($karyawan as $karyawan) : ?>
        <tr>
            <td class="small text-center"><?= $no++ ?></td>
            <td class="d-flex p-2">
                <button class="btn btn-secondary btn-sm btn-editTraining" data-id="<?= $karyawan['id_karyawan']; ?>">
                    <i class="fa fa-edit"></i> Edit
                </button>
            </td>
            <td class="small text-center"><?= $karyawan['nama_karyawan'] ?></td>
            <td class="small text-center"><?= $karyawan['nik_jne'] ?></td>
            <td class="small text-center"><?= $karyawan['ket_induction'] ?></td>
            <td class="small text-center"><?= $karyawan['service_byheart'] ?></td>
            <td class="small text-center"><?= $karyawan['code_ofconduct'] ?></td>
            <td class="small text-center"><?= $karyawan['visimisi_oflife'] ?></td>
            <td class="small text-center"><?= $karyawan['training_sco'] ?></td>
            <td class="small text-center"><?= $karyawan['training_sales'] ?></td>
            <td class="small text-center"><?= $karyawan['kurir_program'] ?></td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="17" class="text-center">Tidak ada data tersedia</td>
    </tr>
<?php endif; ?>