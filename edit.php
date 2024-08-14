<?php
session_start();

$page = 'Ubah Data';
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
            if (isset($_GET['nik'])) {
                $nik = $_GET['nik'];

                $sql = "SELECT * FROM penduduk WHERE nik='$nik'";
                $query = mysqli_query($koneksi, $sql);
                $result = mysqli_fetch_array($query);

                if (!$result) {
                    $_SESSION['warning'] = "NIK tidak ditemukan!";
                    echo "<script>window.location.href = 'show.php';</script>";
                    exit();
                }
            }

            $errors = [];

            $nama_lengkap = isset($_POST['nama_lengkap']) ? htmlspecialchars($_POST['nama_lengkap']) : $result['nama_lengkap'];
            $tempat_lahir = isset($_POST['tempat_lahir']) ? htmlspecialchars($_POST['tempat_lahir']) : $result['tempat_lahir'];
            $tanggal_lahir = isset($_POST['tanggal_lahir']) ? htmlspecialchars($_POST['tanggal_lahir']) : $result['tanggal_lahir'];
            $alamat = isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : $result['alamat'];
            $jenis_kelamin = isset($_POST['jenis_kelamin']) ? htmlspecialchars($_POST['jenis_kelamin']) : $result['jenis_kelamin'];
            $foto_lama = $result['foto'];

            if (isset($_POST['simpan'])) {
                // Validasi
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

                if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                    $foto = $_FILES['foto']['name'];
                    $ukuran_foto = $_FILES['foto']['size'];
                    $ekstensi_foto = pathinfo($foto, PATHINFO_EXTENSION);

                    if ($ukuran_foto > 1000000) {
                        $errors['foto'] = "Foto yang diunggah maksimal 1 MB";
                    } elseif (!in_array($ekstensi_foto, ['jpg', 'jpeg', 'png'])) {
                        $errors['foto'] = "Format tidak didukung";
                    }

                    if (empty($errors)) {
                        $tmp_foto = $_FILES['foto']['tmp_name'];
                        $random_nama_foto = uniqid() . '.' . $ekstensi_foto;

                        if (move_uploaded_file($tmp_foto, 'uploads/img/' . $random_nama_foto)) {
                            if ($foto_lama && file_exists('uploads/img/' . $foto_lama)) {
                                unlink('uploads/img/' . $foto_lama);
                            }

                            $foto = $random_nama_foto;
                        }
                    }
                } else {
                    $foto = $foto_lama;
                }

                if (empty($errors)) {
                    $sql = "UPDATE penduduk SET 
                            nama_lengkap='$nama_lengkap', 
                            tempat_lahir='$tempat_lahir', 
                            tanggal_lahir='$tanggal_lahir', 
                            alamat='$alamat', 
                            jenis_kelamin='$jenis_kelamin', 
                            foto='$foto' 
                            WHERE nik='$nik'";
                    $query = mysqli_query($koneksi, $sql);

                    if ($query) {
                        $_SESSION['success'] = "Data berhasil diubah!";
                    } else {
                        $_SESSION['error'] = "Data gagal diubah! " . mysqli_error($koneksi);
                    }

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
                            <label for="img_file" class="form-label">Foto</label>
                            <input type="file" id="img_file" name="foto" class="form-control <?= (isset($errors['foto'])) ? 'is-invalid' : ''; ?>" onchange="previewImage()">
                            <div class="invalid-feedback">
                                <?= isset($errors['foto']) ? $errors['foto'] : '' ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="img-wrapper">
                            <div class="ratio" style="--bs-aspect-ratio: 133.33%;">
                                <img src="uploads/img/<?= $result['foto']; ?>" alt="<?= $result['nama_lengkap']; ?>" id="img-file-preview" class="rounded-3 object-fit-cover">
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