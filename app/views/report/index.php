<main>
    <div class="container-fluid px-4">
        <h4 class="mt-4" style="border-bottom: solid 1px black;">Report</h4>
        <div class="alert alert-primary" role="alert">
            <b>Perhatian !!</b> Silahkan Pilih Range Tanggal Terlebih Dahulu Untuk Menampilkan Data dan Download.
        </div>
        <div class="card mb-4 mt-4">
            <div class="container d-flex gap-2 align-items-start flex-wrap">
                <!-- Form pertama (lebih lebar) -->
                <form method="post" class="row g-3 mt-2 flex-grow-1">
                    <div class="col-lg-3 col-md-6">
                        <label for="tgl_dari"><b>Date From : </b></label>
                        <input type="date" class="form-control" id="tgl_dari" name="tgl_dari"
                            value="<?= $data['tgl_dari'] ?>" max="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label for="tgl_dari"><b> Date Thru : </b></label>
                        <input type="date" class="form-control" id="tgl_ke" name="tgl_ke"
                            value="<?= $data['tgl_ke'] ?>" max="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="col-lg-6 col-md-4 d-flex justify-content-start gap-2 ">
                        <button type="submit" class="btn btn-primary mb-3 mt-4"><i class="fa fa-search"></i> Cari Data</button>
                        <a href="<?= BASE_URL; ?>/report/clear" class="btn btn-secondary mb-3 mt-4">
                            <i class="fa fa-refresh"></i> Refresh
                        </a>
                    </div>
                </form>

                <?php if (isset($_SESSION['tgl_dari'], $_SESSION['tgl_ke'])): ?>
                    <form action="<?= BASE_URL; ?>/report/download" method="post" class="mt-4">
                        <input type="hidden" name="tgl_dari" value="<?= $_SESSION['tgl_dari'] ?>">
                        <input type="hidden" name="tgl_ke" value="<?= $_SESSION['tgl_ke'] ?>">
                        <?php if ($userRole === 'agen'): ?>
                            <input type="hidden" name="user_id" value="<?= $_SESSION['user']['username'] ?>">
                        <?php endif; ?>
                        <button type="submit" class="btn btn-info mb-3 text-white mt-4">
                            <i class="fa fa-download"></i> Download
                        </button>
                    </form>
                <?php endif; ?>
            </div>
            <?php Flasher::flash();  ?>
            <div class="card-header mt-4">
                <i class="fas fa-table me-1"></i>
                Data Report Resi Cancel
            </div>
            <div class="card-body">
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th class="small text-center">NO</th>
                            <th class="small text-center">NOMOR RESI</th>
                            <th class="small text-center">KETERANGAN</th>
                            <th class="small text-center">NAMA AGEN</th>
                            <th class="small text-center">USER ID</th>
                            <th class="small text-center">TGL REQ CANCEL</th>
                            <th class="small text-center">TGL PROSES CANCEL</th>
                            <th class="small text-center">STATUS</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data['report'] as $report) :
                        ?>
                            <tr>
                                <td class="small text-center"><?= $no++; ?></td>
                                <td class="small text-center"><?= $report['no_resi']; ?></td>
                                <td class="small text-center"><?= $report['keterangan']; ?></td>
                                <td class="small text-center"><?= $report['nama_agen']; ?></td>
                                <td class="small text-center"><?= $report['user_id']; ?></td>
                                <td class="small text-center"><?= $report['tgl_req']; ?></td>
                                <td class="small text-center"><?= $report['tgl_proses']; ?></td>
                                <td class="small text-center"><?= $report['status']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<script>
    const tglDari = document.getElementById('tgl_dari');
    const tglKe = document.getElementById('tgl_ke');

    function validateTanggal() {
        const dari = new Date(tglDari.value);
        const ke = new Date(tglKe.value);

        if (tglDari.value && tglKe.value) {
            // 1. Cegah jika "ke" lebih kecil dari "dari"
            if (ke < dari) {
                alert('Date Thru Tidak Sesuai!');
                tglKe.value = '';
            }

            // 2. Cegah jika bulan berbeda
            if (dari.getMonth() !== ke.getMonth() || dari.getFullYear() !== ke.getFullYear()) {
                alert('Tanggal harus dalam bulan yang sama!');
                tglKe.value = '';
            }
        }
    }

    tglDari.addEventListener('change', validateTanggal);
    tglKe.addEventListener('change', validateTanggal);
</script>