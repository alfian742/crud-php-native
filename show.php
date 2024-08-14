<?php
session_start();

$page = 'Data';
?>

<?php
if (!isset($_SESSION['email'])) {
    $_SESSION['warning'] = "Halaman tidak dapat diakses. Silahkan masuk!";
    header('Location: login.php');
    exit();
}
?>

<?php include('_top.php'); ?>

<div class="col-lg-10">
    <!-- Content -->
    <div class="card rounded-3 border-0">
        <div class="card-header border-0 text-bg-primary rounded-top-3 fw-semibold py-3">
            <div class="d-flex justify-content-between align-items-center gap-2">
                <h5 class="my-auto"><?= ucfirst($page) . ' Penduduk'; ?></h5>
                <a href="create.php" class="btn btn-sm btn-light"><i class="fa-solid fa-plus me-0 me-lg-1"></i>
                    <span class="d-none d-lg-inline">Tambah</span></a>
            </div>
        </div>
        <div class="card-body border border-top-0 rounded-bottom-3">
            <!-- Alerts -->
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    <strong><i class="fa-solid fa-circle-check me-1"></i> <?= $_SESSION['success']; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
                <?php unset($_SESSION['success']) ?>
            <?php endif ?>

            <?php if (isset($_SESSION['warning'])): ?>
                <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert">
                    <strong><i class="fa-solid fa-triangle-exclamation me-1"></i> <?= $_SESSION['warning']; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
                <?php unset($_SESSION['warning']) ?>
            <?php endif ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                    <strong><i class="fa-solid fa-xmark me-1"></i> <?= $_SESSION['error']; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
                <?php unset($_SESSION['error']) ?>
            <?php endif ?>

            <!-- Data -->
            <div class="table-responsive mb-2">
                <table id="myTable" class="table table-hover table-nowrap w-100">
                    <thead class="table-light">
                        <tr class="align-middle">
                            <th class="text-start">No.</th>
                            <th class="text-start">NIK</th>
                            <th class="text-start">Nama</th>
                            <th class="text-start">Tempat Lahir</th>
                            <th class="text-start">Tanggal Lahir</th>
                            <th class="text-start">L/P</th>
                            <th class="text-start">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = "SELECT * FROM penduduk ORDER BY nama_lengkap ASC";
                        $query = mysqli_query($koneksi, $sql);
                        while ($result = mysqli_fetch_array($query)):
                        ?>
                            <tr class="align-middle">
                                <td><?= $no++ . '.' ?></td>
                                <td><?= $result['nik']; ?></td>
                                <td><?= $result['nama_lengkap']; ?></td>
                                <td><?= $result['tempat_lahir']; ?></td>
                                <td><?= date('d-m-Y', strtotime($result['tanggal_lahir'])); ?></td>
                                <td><?= $result['jenis_kelamin']; ?></td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- Detail button -->
                                        <button class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#detailModal<?= $result['nik']; ?>">
                                            <i class="fa-solid fa-info-circle"></i>
                                        </button>

                                        <!-- Edit button -->
                                        <a href="edit.php?nik=<?= $result['nik']; ?>" class="btn btn-sm btn-primary"><i
                                                class="fa-solid fa-edit"></i></a>

                                        <!-- Delete button -->
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal<?= $result['nik']; ?>">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Detail modal -->
                                    <div class="modal modal-lg fade" id="detailModal<?= $result['nik']; ?>" tabindex="-1"
                                        aria-labelledby="detailModal<?= $result['nik']; ?>Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="detailModal<?= $result['nik']; ?>Label">Detail</h1>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-lg-4">
                                                            <div class="ratio" style="--bs-aspect-ratio: 133.33%;">
                                                                <img src="uploads/img/<?= $result['foto']; ?>" alt="<?= $result['nama_lengkap']; ?>" class="rounded-3 object-fit-cover" loading="lazy">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="mt-3 mt-lg-0 mb-3">
                                                                <small>Nomor Induk Keluarga (NIK)</small>
                                                                <h5><?= $result['nik']; ?></h5>
                                                            </div>
                                                            <div class="mb-3">
                                                                <small>Nama</small>
                                                                <h5><?= $result['nama_lengkap']; ?></h5>
                                                            </div>
                                                            <div class="mb-3">
                                                                <small>Tempat/Tanggal Lahir</small>
                                                                <h5><?= $result['tempat_lahir'] . ', ' . date('d F Y', strtotime($result['tanggal_lahir'])); ?></h5>
                                                            </div>
                                                            <div class="mb-3">
                                                                <small>Jenis Kelamin</small>
                                                                <h5><?= ($result['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan'; ?></h5>
                                                            </div>
                                                            <div>
                                                                <small>Alamat</small>
                                                                <h5><?= $result['alamat']; ?></h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete modal -->
                                    <div class="modal fade" id="deleteModal<?= $result['nik']; ?>" tabindex="-1"
                                        aria-labelledby="deleteModal<?= $result['nik']; ?>Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="deleteModal<?= $result['nik']; ?>Label">Hapus
                                                        Data</h1>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda ingin menghapus data <br>
                                                    <span class="fw-semibold">"<?= $result['nama_lengkap']; ?>"</span>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <a href="delete.php?nik=<?= $result['nik']; ?>" class="btn btn-danger">Ya, Hapus!</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End of content -->
</div>

<?php include('_bottom.php'); ?>