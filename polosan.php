<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card-header {
            background-color: #007bff;
            color: white;
        }

        .form-label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container mt-4 mb-5 px-5">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h1 class="h4 mb-0">Form Penilaian Mahasiswa</h1>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Masukkan Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Agus">
                    </div>
                    <div class="mb-3">
                        <label for="nim" class="form-label">Masukkan NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" placeholder="202332xxx">
                    </div>
                    <div class="mb-3">
                        <label for="kehadiran" class="form-label">Nilai Kehadiran (10%)</label>
                        <input type="number" class="form-control" id="kehadiran" name="kehadiran"
                            placeholder="Untuk Lulus minimal 70%" min="0" max="100">
                    </div>
                    <div class="mb-3">
                        <label for="tugas" class="form-label">Nilai Tugas (20%)</label>
                        <input type="number" class="form-control" id="tugas" name="tugas" placeholder="0 - 100" min="0"
                            max="100">
                    </div>
                    <div class="mb-3">
                        <label for="uts" class="form-label">Nilai UTS (30%)</label>
                        <input type="number" class="form-control" id="uts" name="uts" placeholder="0 - 100" min="0"
                            max="100">
                    </div>
                    <div class="mb-3">
                        <label for="uas" class="form-label">Nilai UAS (40%)</label>
                        <input type="number" class="form-control" id="uas" name="uas" placeholder="0 - 100" min="0"
                            max="100">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="proses" class="btn btn-primary">Proses</button>
                    </div>
                </form>

                <?php
                if (isset($_POST['proses'])) {

                    if (empty($_POST['nama']) && empty($_POST['nim'])) {

                        echo '
        <div class="alert alert-warning mt-4 text-center fw-bold">
            Kolom Nama dan NIM harus diisi!
        </div>';

                    }
                    elseif (
                        empty($_POST['nama']) ||
                        empty($_POST['nim']) ||
                        $_POST['kehadiran'] === "" ||
                        $_POST['tugas'] === "" ||
                        $_POST['uts'] === "" ||
                        $_POST['uas'] === ""
                    ) {

                        echo '
        <div class="alert alert-warning mt-4 text-center fw-bold">
            Semua kolom harus diisi!
        </div>';

                    }
                    else {

                        $nama = $_POST['nama'];
                        $nim = $_POST['nim'];
                        $kehadiran = $_POST['kehadiran'];
                        $tugas = $_POST['tugas'];
                        $uts = $_POST['uts'];
                        $uas = $_POST['uas'];

                        $nilai_akhir =
                            ($kehadiran * 0.10) +
                            ($tugas * 0.20) +
                            ($uts * 0.30) +
                            ($uas * 0.40);

                        if ($nilai_akhir >= 85)
                            $grade = "A";
                        elseif ($nilai_akhir >= 70)
                            $grade = "B";
                        elseif ($nilai_akhir >= 55)
                            $grade = "C";
                        elseif ($nilai_akhir >= 40)
                            $grade = "D";
                        else
                            $grade = "E";

                        if (
                            $kehadiran >= 70 &&
                            $nilai_akhir >= 60 &&
                            $tugas >= 40 &&
                            $uts >= 40 &&
                            $uas >= 40
                        ) {
                            $status = "LULUS";
                            $warna = "success";
                        } else {
                            $status = "TIDAK LULUS";
                            $warna = "danger";
                        }
                        ?>
                        <div class="card mt-4 border-<?= $warna ?>">
                            <div class="card-header bg-<?= $warna ?> text-white">
                                Hasil Penilaian
                            </div>
                            <div class="card-body">
                                <p><strong>Nama:</strong> <?= $nama ?></p>
                                <p><strong>NIM:</strong> <?= $nim ?></p>
                                <p>Nilai Kehadiran: <?= $kehadiran ?>%</p>
                                <p>Nilai Tugas: <?= $tugas ?></p>
                                <p>Nilai UTS: <?= $uts ?></p>
                                <p>Nilai UAS: <?= $uas ?></p>
                                <p><strong>Nilai Akhir:</strong> <?= number_format($nilai_akhir, 2) ?></p>
                                <p><strong>Grade:</strong> <?= $grade ?></p>
                                <p><strong>Status:</strong>
                                    <span class="fw-bold text-<?= $warna ?>"><?= $status ?></span>
                                </p>
                            </div>
                            <div class="card-footer text-center bg-<?= $warna ?>">
                                <a href="" class="btn text-light">Selesai</a>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>


            </div>
        </div>
    </div>
</body>

</html>