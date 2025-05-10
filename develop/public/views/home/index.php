<?php
session_name("hc_session");
session_start();
include '../../header.php';
include '../../../app/models/karyawan_models.php';
$date = date('Y-m-d');
$time = date("H:i");
?>

<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4 mb-4" style="border-bottom: 1px solid black;">Dashboard</h3>

        <?php
        $branches = [];
        $query_branch = mysqli_query($koneksi, "SELECT DISTINCT nama_cabang FROM tb_cabang WHERE nama_cabang IS NOT NULL AND nama_cabang != '' ORDER BY id_cabang");
        while ($row = mysqli_fetch_assoc($query_branch)) {
            $branches[] = $row['nama_cabang'];
        }
        ?>

        <!-- Filter Tanggal -->
        <form method="GET" action="" class="row g-3 mb-4">
            <div class="col-md-3">
                <label for="start_date" class="form-label">Dari Tanggal</label>
                <input type="date" class="form-control" id="start_date" name="start_date"
                    value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : '' ?>">
            </div>

            <div class="col-md-3">
                <label for="end_date" class="form-label">Sampai Tanggal</label>
                <input type="date" class="form-control" id="end_date" name="end_date"
                    value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : '' ?>">
            </div>

            <div class="col-md-3">
                <label for="branch" class="form-label">Branch</label>
                <select class="form-select" id="branch" name="branch">
                    <option value="">-- Semua Branch --</option>
                    <?php foreach ($branches as $branch): ?>
                        <option value="<?= $branch ?>" <?= (isset($_GET['branch']) && $_GET['branch'] == $branch) ? 'selected' : '' ?>>
                            <?= $branch ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-3 align-self-end">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="index.php" class="btn btn-secondary">Reset</a>
            </div>
        </form>


        <?php
        $start_date = $_GET['start_date'] ?? '';
        $end_date = $_GET['end_date'] ?? '';
        $branch = $_GET['branch'] ?? '';

        // Link ke halaman detail berbeda (atau bisa satu halaman dengan tipe yang berbeda)
        $link_total_karyawan = "../karyawan/detail_karyawan.php?start_date=$start_date&end_date=$end_date&branch=$branch";
        $link_karyawan_kcu = "../karyawan/detail_karyawan.php?start_date=$start_date&end_date=$end_date&branch=$branch&type=kcu";
        $link_karyawan_agen = "../karyawan/detail_karyawan.php?start_date=$start_date&end_date=$end_date&branch=$branch&type=agen";
        $link_karyawan_mitra = "../karyawan/detail_karyawan.php?start_date=$start_date&end_date=$end_date&branch=$branch&type=mitra";
        $link_karyawan_resign = "../karyawan_resign/detail_karyawan.php?start_date=$start_date&end_date=$end_date&branch=$branch&resign=YES";
        ?>

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <a href="<?= $link_total_karyawan ?>" class="text-decoration-none">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Total Karyawan</div>
                        <div class="card-footer d-flex justify-content-between align-items-center px-4">
                            <i class="fas fa-users fa-2x"></i>
                            <h1 class="mb-0"><?= $total_karyawan; ?></h1>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6">
                <a href="<?= $link_karyawan_kcu ?>" class="text-decoration-none">
                    <div class="card bg-info text-white mb-4">
                        <div class="card-body">Karyawan Kcu</div>
                        <div class="card-footer d-flex justify-content-between align-items-center px-4">
                            <i class="fas fa-users fa-2x"></i>
                            <h1 class="mb-0"><?= $total_kcu; ?></h1>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6">
                <a href="<?= $link_karyawan_agen ?>" class="text-decoration-none">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Karyawan Agen</div>
                        <div class="card-footer d-flex justify-content-between align-items-center px-4">
                            <i class="fas fa-users fa-2x"></i>
                            <h1 class="mb-0"><?= $total_agen; ?></h1>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6">
                <a href="<?= $link_karyawan_mitra ?>" class="text-decoration-none">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Karyawan Mitra</div>
                        <div class="card-footer d-flex justify-content-between align-items-center px-4">
                            <i class="fas fa-users fa-2x"></i>
                            <h1 class="mb-0"><?= $total_mitra; ?></h1>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6">
                <a href="<?= $link_karyawan_resign ?>" class="text-decoration-none">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Karyawan Resign</div>
                        <div class="card-footer d-flex justify-content-between align-items-center px-4">
                            <i class="fas fa-users fa-2x"></i>
                            <h1 class="mb-0"><?= $total_resign; ?></h1>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-pie me-1"></i>
                        <span class="fw-bold">Karyawan KCU dan AGEN </span>
                    </div>
                    <div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
                    <div class="card-footer small text-muted">Updated <?= $date ?></div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header text-danger fw-bold">
                        <i class="fas fa-chart-line me-1"></i>
                        <span class="fw-bold">Karyawan Resign 2 Tahun Terakhir</span>
                    </div>
                    <div class="card-body"><canvas id="resignChart" width="100%" height="50"></canvas></div>
                    <div class="card-footer small text-muted">Updated <?= $date ?></div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header text-primary">
                        <i class="fas fa-chart-bar me-1"></i>
                        <span class="fw-bold">Karyawan Join 2 Tahun terkahir</span>
                    </div>
                    <div class="card-body" style="overflow-x: auto"><canvas id="joinChart" width="100%" height="25"></canvas></div>
                    <div class="card-footer small text-muted">Updated <?= $date ?></div>
                </div>
            </div>


        </div>

    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const totalKcu = <?= $total_kcu ?>;
        const totalAgen = <?= $total_agen ?>;
        const totalMitra = <?= $total_mitra ?>;


        const values = [totalKcu, totalAgen, totalMitra];
        const total = values.reduce((a, b) => a + b, 0);

        const labels = [
            `KARYAWAN KCU (${totalKcu}) - ${((totalKcu / total) * 100).toFixed(1)}%`,
            `KARYAWAN AGEN (${totalAgen}) - ${((totalAgen / total) * 100).toFixed(1)}%`,
            `KARYAWAN MITRA (${totalMitra}) - ${((totalMitra / total) * 100).toFixed(1)}%`

        ];

        const ctx = document.getElementById("myPieChart").getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: ['#17a2b8 ', '#28a745', '#ffc107'],
                    hoverBackgroundColor: ['#0b8fa1 ', '#1e7e34', '#e0a800'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    });
</script>

<script>
    const startInput = document.getElementById('start_date');
    const endInput = document.getElementById('end_date');

    // Set min value untuk end_date saat start_date berubah
    startInput.addEventListener('change', function() {
        endInput.min = this.value;

        // Jika end_date sudah terisi dan kurang dari start_date, kosongkan
        if (endInput.value < this.value) {
            endInput.value = '';
        }
    });

    // Jika page reload dengan data, set min secara langsung
    window.addEventListener('DOMContentLoaded', () => {
        if (startInput.value) {
            endInput.min = startInput.value;
        }
    });
</script>

<script>
    const joinLabels = <?php echo json_encode($joinLabels); ?>;
    const joinData = <?php echo json_encode($joinData); ?>;

    const resignLabels = <?php echo json_encode($resignLabels); ?>;
    const resignData = <?php echo json_encode($resignData); ?>;

    // Bar Chart untuk Join
    const joinChart = new Chart(document.getElementById('joinChart'), {
        type: 'bar',
        data: {
            labels: joinLabels,
            datasets: [{
                label: 'Karyawan Masuk',
                data: joinData,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Bulan'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Jumlah Karyawan'
                    }
                }
            }
        }
    });

    // Line Chart untuk Resign
    const resignChart = new Chart(document.getElementById('resignChart'), {
        type: 'line',
        data: {
            labels: resignLabels,
            datasets: [{
                label: 'Karyawan Resign',
                data: resignData,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                fill: false,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Bulan'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Jumlah Karyawan'
                    }
                }
            }
        }
    });
</script>

<?php
include '../../footer.php';
?>