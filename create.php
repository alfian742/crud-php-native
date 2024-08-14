<?php
session_start();

$page = 'Tambah Data';
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
            <h5 class="my-auto"><?= ucfirst($page) . ' Penduduk'; ?></h5>
        </div>
        <div class="card-body border border-top-0 rounded-bottom-3">
            <?php
            $errors = [];

            $nik = isset($_POST['nik']) ? htmlspecialchars($_POST['nik']) : '';
            $nama_lengkap = isset($_POST['nama_lengkap']) ? htmlspecialchars($_POST['nama_lengkap']) : '';
            $tempat_lahir = isset($_POST['tempat_lahir']) ? htmlspecialchars($_POST['tempat_lahir']) : '';
            $tanggal_lahir = isset($_POST['tanggal_lahir']) ? htmlspecialchars($_POST['tanggal_lahir']) : '';
            $alamat = isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : '';
            $jenis_kelamin = isset($_POST['jenis_kelamin']) ? htmlspecialchars($_POST['jenis_kelamin']) : '';

            if (isset($_POST['simpan'])) {
                // Validasi
                if (empty($nik)) {
                    $errors['nik'] = "NIK wajib diisi";
                } elseif (!is_numeric($nik)) {
                    $errors['nik'] = "NIK harus berupa angka";
                } elseif (strlen($nik) != 16) {
                    $errors['nik'] = "NIK harus 16 karakter";
                } else {
                    $cek_nik = mysqli_query($koneksi, "SELECT nik FROM penduduk WHERE nik='$nik'");

                    if (mysqli_num_rows($cek_nik) > 0) {
                        $errors['nik'] = "NIK sudah terdaftar";
                    }
                }

                if (empty($nama_lengkap)) {
                    $errors['nama_lengkap'] = "Nama lengkap wajib diisi";
                }

                if (empty($tempat_lahir)) {
                    $errors['tempat_lahir'] = "Tempat lahir wajib diisi";
                }

                if (empty($tanggal_lahir)) {
                    $errors['tanggal_lahir'] = "Tanggal lahir wajib diisi";
                }

                if (empty($alamat)) {
                    $errors['alamat'] = "Alamat wajib diisi";
                }

                if (empty($jenis_kelamin)) {
                    $errors['jenis_kelamin'] = "Jenis kelamin wajib dipilih";
                }

                if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
                    $errors['foto'] = "Foto wajib diunggah";
                } else {
                    $foto = $_FILES['foto']['name'];
                    $ukuran_foto = $_FILES['foto']['size'];
                    $ekstensi_foto = pathinfo($foto, PATHINFO_EXTENSION);

                    if ($ukuran_foto > 1000000) {
                        $errors['foto'] = "Foto yang diunggah maksimal 1 MB";
                    } elseif (!in_array($ekstensi_foto, ['jpg', 'jpeg', 'png'])) {
                        $errors['foto'] = "Format tidak didukung";
                    }
                }

                if (empty($errors)) {
                    $tmp_foto = $_FILES['foto']['tmp_name'];

                    $random_nama_foto = uniqid() . '.' . $ekstensi_foto;

                    if (move_uploaded_file($tmp_foto, 'uploads/img/' . $random_nama_foto)) {
                        $foto = $random_nama_foto;
                    }

                    $sql = "INSERT INTO penduduk VALUES ('$nik', '$nama_lengkap', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$jenis_kelamin', '$foto')";
                    $query = mysqli_query($koneksi, $sql);

                    if ($query) {
                        $_SESSION['success'] = "Data berhasil ditambahkan!";
                    } else {
                        $_SESSION['error'] = "Data gagal ditambahkan! " . mysqli_error($koneksi);
                    }

                    // header('Location: show.php');
                    echo "<script>window.location.href = 'show.php';</script>";
                    exit();
                }
            }
            ?>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="row g-4 mb-3">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nik" class="form-label">Nomor Induk Keluarga (NIK) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= (isset($errors['nik'])) ? 'is-invalid' : ''; ?>" id="nik" name="nik" value="<?= $nik; ?>" placeholder="contoh: 1234567890098765">
                            <div class="invalid-feedback">
                                <?= isset($errors['nik']) ? $errors['nik'] : '' ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= (isset($errors['nama_lengkap'])) ? 'is-invalid' : ''; ?>" id="nama_lengkap" name="nama_lengkap" value="<?= $nama_lengkap; ?>" placeholder="contoh: Jhon Doe">
                            <div class="invalid-feedback">
                                <?= isset($errors['nama_lengkap']) ? $errors['nama_lengkap'] : '' ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= (isset($errors['tempat_lahir'])) ? 'is-invalid' : ''; ?>" id="tempat_lahir" name="tempat_lahir" value="<?= $tempat_lahir; ?>" placeholder="contoh: Jakarta">
                            <div class="invalid-feedback">
                                <?= isset($errors['tempat_lahir']) ? $errors['tempat_lahir'] : '' ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" class="form-control <?= (isset($errors['tanggal_lahir'])) ? 'is-invalid' : ''; ?>" id="tanggal_lahir" name="tanggal_lahir" value="<?= $tanggal_lahir; ?>">
                            <div class="invalid-feedback">
                                <?= isset($errors['tanggal_lahir']) ? $errors['tanggal_lahir'] : '' ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control <?= (isset($errors['alamat'])) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" rows="5" placeholder="contoh: Jl. ABCD, No. 123"><?= $alamat; ?></textarea>
                            <div class="invalid-feedback">
                                <?= isset($errors['alamat']) ? $errors['alamat'] : '' ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-select <?= isset($errors['jenis_kelamin']) ? 'is-invalid' : ''; ?>" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="" <?= empty($jenis_kelamin) ? 'selected' : ''; ?> disabled>-- Pilih Jenis Kelamin --</option>
                                <option value="L" <?= $jenis_kelamin == "L" ? 'selected' : ''; ?>>Laki-Laki</option>
                                <option value="P" <?= $jenis_kelamin == "P" ? 'selected' : ''; ?>>Perempuan</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= isset($errors['jenis_kelamin']) ? $errors['jenis_kelamin'] : '' ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="img_file" class="form-label">Foto <span class="text-danger">*</span></label>
                            <input type="file" id="img_file" name="foto" class="form-control <?= (isset($errors['foto'])) ? 'is-invalid' : ''; ?>" onchange="previewImage()">
                            <div class="invalid-feedback">
                                <?= isset($errors['foto']) ? $errors['foto'] : '' ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="img-wrapper">
                            <div class="ratio" style="--bs-aspect-ratio: 133.33%;">
                                <img src="assets/img/image-placeholder.png" alt="Unggah Foto" id="img-file-preview" class="rounded-3 object-fit-cover">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center justify-content-lg-start gap-2">
                    <a href="show.php" class="btn btn-outline-warning">Kembali</a>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End of content -->
</div>

<?php include('_bottom.php'); ?>