<?php
session_start();

$page = 'Login';
?>

<?php include('_top.php'); ?>

<div class="col-lg-4">
    <!-- Content -->
    <h3 class="fw-bold text-center mt-1 mb-4">MASUK</h3>

    <?php
    $errors = [];

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email)) {
            $errors['email'] = 'Email wajib diisi!';
        }

        if (empty($password)) {
            $errors['password'] = 'Kata sandi wajib diisi!';
        }

        if (empty($errors)) {
            $password_hash = md5($password);
            $sql = "SELECT * FROM user WHERE email='$email' AND password='$password_hash'";
            $query = mysqli_query($koneksi, $sql);
            $result = mysqli_fetch_array($query);

            if (mysqli_num_rows($query) > 0) {
                $_SESSION['email'] = $result['email'];
                $_SESSION['success'] = "Selamat Datang";
                header('Location: show.php');
                exit();
            } else {
                echo '';
                $_SESSION['error'] = "Email atau Kata Sandi salah";
                header('Location: login.php');
                exit();
            }
        }
    }
    ?>

    <?php if (isset($_SESSION['warning'])): ?>
        <div class="alert alert-warning text-center" role="alert">
            <i class="fa-solid fa-triangle-exclamation me-1"></i> <?= $_SESSION['warning']; ?>
        </div>
        <?php unset($_SESSION['warning']) ?>
    <?php endif ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger text-center" role="alert">
            <i class="fa-solid fa-xmark me-1"></i> <?= $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']) ?>
    <?php endif ?>

    <form action="" method="post" class="login">
        <div class="form-group mb-3">
            <input type="email" name="email" class="form-control form-control-lg <?= (isset($errors['email'])) ? 'is-invalid' : ''; ?>"
                placeholder="Email">
            <div class="invalid-feedback">
                <?= isset($errors['email']) ? $errors['email'] : '' ?>
            </div>
        </div>
        <div class="form-group mb-3">
            <input type="password" name="password" class="form-control form-control-lg <?= (isset($errors['password'])) ? 'is-invalid' : ''; ?>"
                placeholder="Kata Sandi">
            <div class="invalid-feedback">
                <?= isset($errors['password']) ? $errors['password'] : '' ?>
            </div>
        </div>

        <button type="submit" name="login" class="btn btn-lg btn-primary w-100">MASUK</button>

        <div class="text-center mt-3">
            <a href="index.php" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">Kembali ke Beranda</a>
        </div>
    </form>
    <!-- End of content -->
</div>

<?php include('_bottom.php'); ?>